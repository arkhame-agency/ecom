<?php

namespace Modules\Noviship;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderProduct;

class Noviship
{
    /**
     * @var string
     */
    private $api_key;
    private $api_version;
    private $api_base_url;

    /**
     * Noviship constructor.
     */
    public function __construct()
    {
        $this->api_key = config('services.noviship.key');
        $this->api_version = 'v1';
        $this->api_base_url = config('services.noviship.base_uri');
    }

    public function getApiBaseUrl()
    {
        return $this->api_base_url . "/" . $this->api_version;
    }

    public function call(array $body)
    {
        try {
            $client = new Client();
            $response = $client->post($this->getApiBaseUrl(), [
                'json' => $body
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

    public function buildArray(array $filters = [])
    {
        $queryFilters = [];
        foreach ($filters as $key => $value) {
            $queryFilters[] = "$key:$value";
        }
        return $queryFilters;
    }

    private function buildPackagesArray(Order $order)
    {
        /**
         * @var $orderProduct OrderProduct
         */

        $packages = [];
        foreach ($order->products()->getResults() as $orderProduct) {
            $packages [] = [
                "qty" => 1,
                "description" => "BOX",
                "weight" => $orderProduct->getWeightAttribute(),
                "width" => $orderProduct->getWidthAttribute(),
                "length" => $orderProduct->getLengthAttribute(),
                "height" => $orderProduct->getHeightAttribute(),
                "insvalue" => "0"
            ];
        }
        return $packages;
    }

    /**
     * @return string
     */
    public function CreateShipment(Order $order)
    {
        $createShipment = [
            'CreateShipment' => [
                'key' => $this->api_key,
                'shipment' => [
                    'shipper' => [
                        'attn' => config('app.name'),
                        'street1' => setting('store_address_1'),
                        'orgname' => config('app.name'),
                        'city' => setting('store_city'),
                        'province' => setting('store_state'),
                        'postalcode' => setting('store_zip'),
                        'country' => setting('store_country'),
                        'tel' => setting('store_phone'),
                        'email' => setting('store_email'),
                        'residential' => 0,
                        'tax_id' => "",
                        'ext' => ""
                    ],
                    'destination' => [
                        'attn' => $order->getShippingFullNameAttribute(),
                        'street1' => $order->getShippingAddress1(),
                        'street2' => $order->getShippingAddress2(),
                        'orgname' => 'CLIENT',
                        'city' => $order->getShippingCity(),
                        'province' => $order->getShippingStateCode(),
                        'postalcode' => $order->getShippingPostalCode(),
                        'country' => $order->getShippingCountryCode(),
                        'tel' => $order->getCustomerTelephone(),
                        'email' => $order->getCustomerEmail(),
                        'residential' => 0,
                        'tax_id' => "",
                        'ext' => ""
                    ],
                    'shipmentdate' => Carbon::now()->addDays(3)->format('Y-m-d'),
                    'dimensionunit' => 'CM',
                    'weightunit' => 'KG',
                    'currency' => 'CAD',
                    'pkgtype' => 'CUST',
                    'documentsonly' => '0',
                    'custrefcode' => "WEBORDER-" . $order->getOrderId(),
                    'options' => [
                        [
                            'code' => 'signature_required',
                            'params' => [
                                [
                                    'name' => 'option',
                                    'value' => '1'
                                ]
                            ]
                        ],
                    ],
                    'packages' => $this->buildPackagesArray($order),
                ],
            ]
        ];
        $novishipResponse = $this->call($createShipment);
        Order::where('id', $order->getOrderId())->update(['noviship_id' => $novishipResponse['id']]);
    }
}
