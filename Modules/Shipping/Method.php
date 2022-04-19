<?php

namespace Modules\Shipping;

use Modules\Support\Money;
use Modules\Cart\Facades\Cart;

class Method
{
    public $name;
    public $label;
    public $cost;
    public $shipment_rate_id;
    public array $shipment_label;
    public bool $isInRadius;

    /**
     * @param $name
     * @param $label
     * @param $cost
     * @param null $shipment_rate_id
     * @param bool $isInRadius
     */
    public function __construct($name, $label, $cost, $shipment_rate_id = null, bool $isInRadius = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->cost = Money::inDefaultCurrency($cost);
        $this->shipment_rate_id = $shipment_rate_id;
        $this->isInRadius = $isInRadius;
    }

    public function available()
    {
        if ($this->name !== 'free_shipping') {
            return true;
        }

        return $this->freeShippingMethodIsAvailable();
    }

    private function freeShippingMethodIsAvailable()
    {
        $minimumAmount = Money::inDefaultCurrency(setting('free_shipping_min_amount'));

        return Cart::subTotal()->greaterThanOrEqual($minimumAmount) || $this->isInRadius;
    }
}
