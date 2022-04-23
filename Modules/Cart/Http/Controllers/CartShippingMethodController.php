<?php

namespace Modules\Cart\Http\Controllers;

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
        } else {
            $shippingMethod = ShippingMethod::get(request('shipping_method'));
        }

        Cart::addShippingMethod($shippingMethod);

        return Cart::instance();
    }

    public function rates(Request $request)
    {

        $this->mergeShippingAddress($request);

        if (setting('shippo_shipping_enabled')) {
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

                Cache::remember('shippo_shipping_rates', now()->addHour(), function () {
                    return ShippingMethod::available();
                });

                if (!Cart::hasShippingMethod()) {
                    Cart::addShippingMethod(ShippingMethod::available()->first());
                }

            } else {
                return response()->json(['message' => $this->getMessages($shippoRates['messages'])], 500);
            }
        }

        return Cart::instance();
    }

    public function getMessages($messages)
    {
        $msg = null;
        foreach ($messages as $message) {
            $msg .= $message['text'] . '. ';
        }
        return $msg;
    }

    public function getCost($cost)
    {

        // 1 = Percent, 0 = Fixed
        if (setting('shippo_profit_margin_type') === '1') {
            $costProfit = (setting('shippo_profit_margin') / 100) * $cost;
            return $cost + $costProfit;
        }

        return $cost + setting('shippo_profit_margin');
    }

    private function mergeShippingAddress($request)
    {
        $request->merge([
            'shipping' => $request->ship_to_a_different_address || !$request->billing ? $request->shipping : $request->billing,
        ]);
    }
}
