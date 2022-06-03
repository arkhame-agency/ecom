<?php

namespace Modules\Order\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Modules\Order\Entities\Order;

class OrderPrintController
{
    /**
     * Show the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order)
    {
        $order->load('products', 'coupon', 'taxes');
        $logo = is_null(Cache::get(md5("files.".setting('storefront_header_logo')))) ? null : Cache::get(md5("files.".setting('storefront_header_logo')))->path;

        return view('order::admin.orders.print.show', compact('order', 'logo'));
    }
}
