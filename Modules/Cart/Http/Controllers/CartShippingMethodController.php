<?php

namespace Modules\Cart\Http\Controllers;

use Geocoder\Provider\GoogleMaps\Model\GoogleAddress;
use Illuminate\Support\Facades\Cache;
use Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Shipping\Facades\ShippingMethod;
use Modules\Shipping\Gateway\Shippo;
use Modules\Shipping\Method;
use Modules\Support\Money;

class CartShippingMethodController
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (Cache::get('shippo_shipping_rates')) {
            $shippingMethod = Cache::get('shippo_shipping_rates')->get(request('shipping_method'));
        } else if (Cache::get('free_shipping')) {
            $shippingMethod = Cache::get('free_shipping')->get(request('shipping_method'));
        } else {
            $shippingMethod = ShippingMethod::get(request('shipping_method'));
        }

        Cart::addShippingMethod($shippingMethod);

        return Cart::instance();
    }

    private function getAddressShipping($request)
    {
        return $request->shipping['state'] . ', ' . $request->shipping['zip'];
    }

    public function isInRadiusFreeShipping($request)
    {
        if ($this->isFreeShippingRadiusEnabled()) {
            /**
             * @var $google GoogleAddress
             */
            $google = app('geocoder')->geocode($this->getAddressShipping($request))->get()->first();
            if ($google->getCoordinates()) {
                $lat2 = $google->getCoordinates()->getLatitude();
                $lng2 = $google->getCoordinates()->getLongitude();
                $distance = $this->getDistanceBetweenPointsNew(
                    config('geocoder.starting_point.lat'),
                    config('geocoder.starting_point.lng'),
                    $lat2,
                    $lng2,
                    'Km'
                );
                return $distance < setting('free_shipping_radius_value');
            }
        }
        return false;
    }

    public function rates(Request $request)
    {
        $this->mergeShippingAddress($request);

        // If ZIP Code provided
        if (isset($request->shipping['zip'])) {
            if ($this->isInRadiusFreeShipping($request)) {
                ShippingMethod::register('free_shipping', function () {
                    return new Method('free_shipping', setting('free_shipping_label'), 0, null, true);
                });
                Cache::remember('free_shipping', now()->addHour(), function () {
                    return ShippingMethod::available();
                });
            } else if (setting('shippo_shipping_enabled')) {
                $shippo = new Shippo();
                $shippoRates = $shippo->getRates($request);

                if (!empty($shippoRates['rates'])) {
                    foreach ($shippoRates['rates'] as $rate) {
                        ShippingMethod::register($rate['servicelevel']['token'], function () use ($rate) {
                            return new Method(
                                $rate['servicelevel']['token'],
                                trans("storefront::shipped.method_shipping_label", [
                                    'provider' => $rate['provider'],
                                    'service_name' => $rate['servicelevel']['name'],
                                    'estimated_days' => $rate['estimated_days']
                                ]),
                                $this->getCost($rate['amount']), $rate['object_id']);
                        });
                    }
                } else {
                    return response()->json(['message' => $shippoRates['messages'][0]->text], 500);
                }

                Cache::remember('shippo_shipping_rates', now()->addHour(), function () {
                    return ShippingMethod::available();
                });
            }
        }

        if (!Cart::hasShippingMethod() && ShippingMethod::available()->count() > 0) {
            Cart::addShippingMethod(ShippingMethod::available()->first());
        }

        return Cart::instance();
    }

    public function isFreeShippingRadiusEnabled(): bool
    {
        return setting('free_shipping_radius_enabled') && setting('free_shipping_radius_value') > 0;
    }

    function getCost($cost)
    {

        // 1 = Percent, 0 = Fixed
        if (setting('shippo_profit_margin_type') === '1') {
            $costProfit = (setting('shippo_profit_margin') / 100) * $cost;
            return $cost + $costProfit;
        }

        return $cost + setting('shippo_profit_margin');
    }


    /**
     * Method to find the distance between 2 locations from its coordinates.
     *
     * @param float latitude1 LAT from point A
     * @param float longitude1 LNG from point A
     * @param float latitude2 LAT from point B
     * @param float longitude2 LNG from point B
     *
     * @return Float Distance in Kilometers.
     */
    function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi')
    {
        $theta = $longitude1 - $longitude2;
        $distance = sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta));

        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance *= 60 * 1.1515;

        switch ($unit) {
            case 'Mi':
                break;
            case 'Km' :
                $distance *= 1.609344;
        }

        return (round($distance, 2));
    }

    private function mergeShippingAddress($request)
    {
        $request->merge([
            'shipping' => $request->ship_to_a_different_address || !$request->billing ? $request->shipping : $request->billing,
        ]);
    }

}
