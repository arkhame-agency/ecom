<?php

namespace Modules\Shipping\Gateway;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\Order;
use Modules\Order\Mail\OrderShipmentLabelCreated;
use Modules\Shipping\GatewayInterface;
use Illuminate\Support\Facades\Cache;
use Shippo_CustomsDeclaration;
use Shippo_Object;
use Shippo_Shipment;
use Shippo_Transaction;

class Shippo implements GatewayInterface
{
    public string $shippo_api_url = 'https://api.goshippo.com';
    public Client $client;
    public array $from_address;
    public array $to_address;
    public array $parcels;
    public Shippo_Object $customs_declaration;
    public array $customs_items;

    /**
     *
     */
    public function __construct()
    {
        \Shippo::setApiKey(setting('shippo_shipping_api_key'));
        $this->client = new Client(['verify' => false]);
    }

    /**
     * @param Request $request
     * @return Shippo_CustomsDeclaration
     */
    public function createCustomsDeclaration(Request $request)
    {
        $this->setCustomsItems($request);

        return Shippo_CustomsDeclaration::create(
            array(
                'contents_type' => 'MERCHANDISE',
                'contents_explanation' => 'Electronic components or speakers or capacitors or inductors or resistors',
                'non_delivery_option' => 'RETURN',
                'certify_signer' => config('app.name'),
                'certify' => 'true',
                'items' => $this->customs_items
            ));
    }

    public function getRates(Request $request): Shippo_Object
    {
        //Clear cache key shippo_shipping_rates
        Cache::forget('shippo_shipping_rates');

        $this->setToAddress($request);

        $this->setParcels($request);

        // If outside of Canada, create a Customs declaration.
        if (setting('store_country') !== $this->getToAddress()['country']) {
           $this->customs_declaration = $this->createCustomsDeclaration($request);
        }

        return Shippo_Shipment::create(
            array(
                'address_from' => $this->getFromAddress(),
                'address_to' => $this->getToAddress(),
                'parcels' => $this->getParcels(),
                'customs_declaration' => $this->customs_declaration->object_id ?? null,
                'async' => false,
            ));
    }

    /**
     * @param $order Order is object_id on rate array
     */
    public function createShipmentLabel(Order $order)
    {
        $transaction = Shippo_Transaction::create(array(
            'rate' => $order->getShipmentRateId(),
            'label_file_type' => 'PDF',
            'async' => false));

        if ($transaction['status'] === 'SUCCESS') {
            Mail::to($order->customer_email)->send(new OrderShipmentLabelCreated($order, $transaction));
            $order->update(['shipment_label_id' => $transaction['object_id'], 'status' => 'processing']);
//            event(new OrderStatusChanged($order));
            return $transaction;
        }

        return response()->json(['message' => $transaction['messages'][0]->text], 500);
    }

    public function getShipmentRate($shipment_rate_id)
    {
        try {
            $response = $this->client->get($this->shippo_api_url . '/rates/' . $shipment_rate_id,
                [
                    'headers' => [
                        'Authorization' => 'ShippoToken ' . setting('shippo_shipping_api_key'),
                    ]
                ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            return $responseBody;
        } catch (GuzzleException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            return $responseBody;
        }
    }

    public function getShipmentLabel($shipment_label_id)
    {
        try {
            $response = $this->client->get($this->shippo_api_url . '/transactions/' . $shipment_label_id,
                [
                    'headers' => [
                        'Authorization' => 'ShippoToken ' . setting('shippo_shipping_api_key'),
                    ]
                ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            return $responseBody;
        } catch (GuzzleException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);
            return $responseBody;
        }
    }

    public static function reset_shipping_rates()
    {
        if (setting('shippo_shipping_enabled') && Cache::get('shippo_shipping_rates')) {
            Cache::forget('shippo_shipping_rates');
        }
    }

    private function getFirstNLastName($request)
    {
        if (isset($request->shipping['first_name'], $request->shipping['last_name'])) {
            return $request->shipping['first_name'] . ' ' . $request->shipping['last_name'];
        }
        return "";
    }

    private function isValidToAddress()
    {
        return in_array($this->to_address, ['zip', 'state', 'country']);
    }

    /**
     * @return array
     */
    public function getFromAddress(): array
    {
        return [
            'name' => config('app.name'),
            'company' => config('app.name'),
            'street1' => setting('store_address_1'),
            'street2' => setting('store_address_2') ?? "",
            'city' => setting('store_city'),
            'zip' => setting('store_zip'),
            'state' => setting('store_state'),
            'country' => setting('store_country'),
            'phone' => setting('store_phone'),
            'email' => setting('store_email'),
            'is_residential' => false,
        ];
    }

    /**
     * @return array
     */
    public function getToAddress(): array
    {
        return $this->to_address;
    }

    /**
     * @param Request $request
     */
    public function setToAddress(Request $request): void
    {
        $this->to_address = [
            'name' => $this->getFirstNLastName($request),
            'street1' => $request->shipping['address_1'] ?? "",
            'street2' => $request->shipping['address_2'] ?? "",
            'city' => $request->shipping['city'] ?? "",
            'zip' => $request->shipping['zip'] ?? "",
            'state' => $request->shipping['state'] ?? "",
            'country' => $request->shipping['country'] ?? "",
            'phone' => $request->customer_phone ?? "",
            'email' => $request->customer_email ?? "",
        ];
    }

    /**
     * @return array
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param Request $request
     */
    public function setParcels(Request $request): void
    {
        $weight = 0;
        foreach ($request->cartItems as $cartItem) {
            $weight += $cartItem['product']['weight'] * $cartItem['qty'];
        }

        $this->parcels = [
            'length' => 18+$weight,
            'width' => 18+$weight,
            'height' => 18+$weight,
            'distance_unit' => 'cm',
            'weight' => $weight,
            'mass_unit' => 'kg',
        ];
    }

    /**
     * @param Request $request
     */
    public function setCustomsItems(Request $request)
    {
        foreach ($request->cartItems as $cartItem) {
            $this->customs_items[] = [
                'description' => $cartItem['product']['name'],
                'quantity' => $cartItem['qty'],
                'net_weight' => $cartItem['product']['weight'] * $cartItem['qty'],
                'mass_unit' => 'kg',
                'value_amount' => number_format($cartItem['product']['selling_price']['amount'] * $cartItem['qty'], 2, '.', ''),
                'value_currency' => $cartItem['product']['selling_price']['currency'],
                'origin_country' => setting('store_country'),
            ];
        }
    }
}
