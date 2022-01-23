<div class="col-lg-6 col-sm-18">
    <div class="order-information">
        <h4>{{ trans('storefront::account.view_order.order_information') }}</h4>

        <ul class="list-inline order-information-list">
            <li>
                <label>{{ trans('storefront::account.view_order.phone') }}</label>
                <span>{{ $order->customer_phone }}</span>
            </li>

            <li>
                <label>{{ trans('storefront::account.view_order.email') }}</label>
                <span>{{ $order->customer_email }}</span>
            </li>

            <li>
                <label>{{ trans('storefront::account.view_order.date') }}</label>
                <span>{{ $order->created_at->toFormattedDateString() }}</span>
            </li>

            <li>
                <label>{{ trans('storefront::account.view_order.shipping_method') }}</label>
                <span>{{ $order->shipping_method }}</span>
            </li>

            @if($order->getShipmentLabel())
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ trans('storefront::account.view_order.track_number') }}</div>
                        <span class="bold text-blue">
                            {{$order->getShipmentLabel()->get('tracking_number')}}
                        </span>
                        <div class="small text-black-50">
                            {{ trans('storefront::account.view_order.info_shipping') }}
                        </div>
                    </div>
                    <a href="{{$order->getShipmentLabel()->get('tracking_url_provider')}}"
                       target="_blank">
                        {{ trans('storefront::account.view_order.tracking_url') }} &raquo;
                    </a>
                </li>
            @else
            @endif

            <li>
                <label>{{ trans('storefront::account.view_order.payment_method') }}</label>
                <span>{{ $order->payment_method }}</span>
            </li>

            @if ($order->note)
                <li>
                    <label>{{ trans('storefront::account.view_order.order_note') }}</label>
                    <span>{{ $order->note }}</span>
                </li>
            @endif
        </ul>
    </div>
</div>
