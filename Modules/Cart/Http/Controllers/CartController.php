<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Modules\Cart\Facades\Cart;
use Modules\Support\Country;

class CartController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::forget('shippo_shipping_rates');
        Cache::forget('free_shipping');
        Cart::removeShippingMethod();
        return view('public.cart.index', ['countries' => Country::supported()]);
    }
}
