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
use Shippo_Object;
use Shippo_Shipment;
use Shippo_Transaction;

class Shippo implements GatewayInterface
{
    public string $shippo_api_url = 'https://api.goshippo.com';
    public array $fromAddress;
    public array $toAddress;
    public array $parcels;
    public Client $client;

    /**
     *
     */
    public function __construct()
    {
        \Shippo::setApiKey(setting('shippo_shipping_api_key'));
        $this->client = new Client(['verify' => false]);
    }

    /**
     * @return array
     */
    public function getFromAddress(): array
    {
        return $this->fromAddress;
    }

    /**
     * @param array $fromAddress
     */
    public function setFromAddress(array $fromAddress): void
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * @return array
     */
    public function getToAddress(): array
    {
        return $this->toAddress;
    }

    /**
     * @param array $toAddress
     */
    public function setToAddress(array $toAddress): void
    {
        $this->toAddress = $toAddress;
    }

    /**
     * @return array
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param array $parcels
     */
    public function setParcels(array $parcels): void
    {
        $this->parcels = $parcels;
    }

    public function getRates(Request $request): Shippo_Object
    {
        Cache::forget('shippo_shipping_rates');

        $this->mergeShippingAddress($request);

        $this->setFromAddress([
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
        ]);

        $this->setToAddress([
            'name' => $this->getFirstNLastName($request),
            'street1' => $request->shipping['address_1'] ?? "",
            'street2' => $request->shipping['address_2'] ?? "",
            'city' => $request->shipping['city'] ?? "",
            'zip' => $request->shipping['zip'] ?? "",
            'state' => $request->shipping['state'] ?? "",
            'country' => $request->shipping['country'] ?? "",
            'phone' => $request->customer_phone ?? "",
            'email' => $request->customer_email ?? "",
        ]);

        foreach ($request->cartItems as $cartItem) {
            $this->parcels[] = [
                "length" => $cartItem['product']['length'],
                "width" => $cartItem['product']['width'],
                "height" => $cartItem['product']['height'],
                'distance_unit' => 'cm',
                "weight" => $cartItem['product']['weight'] * $cartItem['qty'],
                'mass_unit' => 'kg',
            ];
        }

        return Shippo_Shipment::create(
            array(
                'address_from' => $this->getFromAddress(),
                'address_to' => $this->getToAddress(),
                'parcels' => $this->getParcels(),
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
            'label_file_type' => "PDF",
            'async' => false));

        if ($transaction["status"] === "SUCCESS") {
            Mail::to($order->customer_email)->send(new OrderShipmentLabelCreated($order, $transaction));
            $order->update(['shipment_label_id' => $transaction['object_id'], 'status' => 'processing']);
//            event(new OrderStatusChanged($order));
            return $transaction;
        }

        return response()->json(['message' => $transaction["messages"][0]->text], 500);
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

    public function available()
    {
        return true;
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
            return $request->shipping['first_name'] . " " . $request->shipping['last_name'];
        }
        return "";
    }

    private function mergeShippingAddress($request)
    {
        $request->merge([
            'shipping' => $request->ship_to_a_different_address || !$request->billing ? $request->shipping : $request->billing,
        ]);
    }

    private function isValidToAddress()
    {
        return in_array($this->toAddress, ['zip', 'state', 'country']);
    }
}
