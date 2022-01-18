<?php

namespace Modules\Cart;

use Modules\Support\Money;

class CartShippingMethod
{
    private $cart;
    private $shippingMethodCondition;

    public function __construct($cart, $shippingMethodCondition)
    {
        $this->cart = $cart;
        $this->shippingMethodCondition = $shippingMethodCondition;
    }

    public function name()
    {
        return $this->shippingMethodCondition->getAttribute('shipping_method')->name;
    }

    public function label()
    {
        return $this->shippingMethodCondition->getAttribute('shipping_method')->label;
    }

    public function shipment_rate_id()
    {
        return $this->shippingMethodCondition->getAttribute('shipping_method')->shipment_rate_id;
    }

    public function cost()
    {
        return Money::inDefaultCurrency($this->calculate());
    }

    private function calculate()
    {
        return $this->shippingMethodCondition->getCalculatedValue($this->cart->subTotal()->amount());
    }
}
