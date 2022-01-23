<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\InapplicableCouponException;

class ExcludedBrands
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('excludeBrands');

        if ($coupon->excludeBrands->isEmpty()) {
            return $next($coupon);
        }

        foreach (Cart::items() as $cartItem) {
            if ($this->inExcludedBrands($coupon, $cartItem)) {
                throw new InapplicableCouponException;
            }
        }

        return $next($coupon);
    }

    private function inExcludedBrands($coupon, $cartItem)
    {
        return $coupon->excludeBrands->intersect($cartItem->product->brands)->isNotEmpty();
    }

}
