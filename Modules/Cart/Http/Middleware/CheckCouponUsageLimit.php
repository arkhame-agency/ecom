<?php

namespace Modules\Cart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Cart\Facades\Cart;

class CheckCouponUsageLimit
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::coupon()->usageLimitReached($request->customer_email)) {
            Cart::removeCoupon();
            return redirect()->route('cart.index')->with('error', trans('coupon::messages.usage_limit_reached'));
        }

        return $next($request);
    }
}
