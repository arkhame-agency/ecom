<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Exceptions\MaximumSpendException;

class MaximumSpend
{
    /**
     * @param Coupon $coupon
     * @param Closure $next
     * @return mixed
     * @throws MaximumSpendException
     */
    public function handle($coupon, Closure $next)
    {
        if ($coupon->spentMoreThanMaximumAmount()) {
            throw new MaximumSpendException($coupon->maximum_spend);
        }

        return $next($coupon);
    }
}
