<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\NullCartCoupon;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Exceptions\MinimumSpendException;

class MinimumSpend
{
    /**
     * @param Coupon|NullCartCoupon $coupon
     * @param Closure $next
     * @return mixed
     * @throws MinimumSpendException
     */
    public function handle($coupon, Closure $next)
    {
        if ($coupon->didNotSpendTheRequiredAmount()) {
            throw new MinimumSpendException($coupon->minimum_spend);
        }

        return $next($coupon);
    }
}
