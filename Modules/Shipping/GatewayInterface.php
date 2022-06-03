<?php

namespace Modules\Shipping;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;

interface GatewayInterface
{
    public function getRates(Request $request);

    public function createShipmentLabel(Order $order);
}
