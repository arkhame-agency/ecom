<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\InapplicableCouponException;

class ApplicableBrands
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('brands');

        if ($coupon->brands->isEmpty()) {
            return $next($coupon);
        }

        $cartItems = Cart::items()->filter(function ($cartItem) use ($coupon) {
            return $coupon->brands->intersect($cartItem->product->brands)->isNotEmpty();
        });

        if ($cartItems->isEmpty()) {
            throw new InapplicableCouponException;
        }

        return $next($coupon);
    }
}
