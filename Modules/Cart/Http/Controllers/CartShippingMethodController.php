<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Shipping\Facades\ShippingMethod;
use Modules\Shipping\Gateway\Shippo;
use Modules\Shipping\Method;

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
        $shippo = new Shippo();
        $shippoRates = $shippo->getRates($request);

        foreach ($shippoRates['rates'] as $rate) {
            ShippingMethod::register($rate['servicelevel']['token'], function () use ($rate) {
                return new Method($rate['servicelevel']['token'], $rate['provider'] . " - " . $rate['servicelevel']['name'] . "(Days to delivery: " . $rate['estimated_days'] . ")", $rate['amount'], $rate['object_id']);
            });
        }

        Cache::remember('shippo_shipping_rates', now()->addHour(), function () {
            return ShippingMethod::available();
        });

        if (!Cart::hasShippingMethod()) {
            Cart::addShippingMethod(ShippingMethod::available()->first());
        }
        return Cart::instance();
    }
}
