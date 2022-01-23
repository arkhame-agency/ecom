<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Exceptions\MinimumSpendException;

class MinimumSpend
{
    /**
     * @param Coupon $coupon
     * @param Closure $next
     * @return mixed
     * @throws MinimumSpendException
     */
    public function handle(Coupon $coupon, Closure $next)
    {
        if ($coupon->didNotSpendTheRequiredAmount()) {
            throw new MinimumSpendException($coupon->minimum_spend);
        }

        return $next($coupon);
    }
}
