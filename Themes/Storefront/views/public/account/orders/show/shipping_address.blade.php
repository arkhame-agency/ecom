<div class="col-lg-4 col-sm-6">
    <div class="order-shipping-details">
        <h4>{{ trans('storefront::account.view_order.shipping_address') }}</h4>

        <address>
            <span>{{ $order->shipping_full_name }}</span>
            <span>{{ $order->shipping_address_1 }}</span>

            @if ($order->shipping_address_2)
                <span>{{ $order->shipping_address_2 }}</span>
            @endif

            <span>{{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}</span>
            <span>{{ $order->shipping_country_name }}</span>
        </address>
    </div>
</div>
