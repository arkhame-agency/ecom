<div class="order-information-wrapper">
    <div class="order-information-buttons">
        <a href="{{ route('admin.orders.print.show', $order) }}" class="btn btn-default" target="_blank"
           data-toggle="tooltip" title="{{ trans('order::orders.print') }}">
            <i class="fa fa-print" aria-hidden="true"></i>
        </a>

        <form method="POST" action="{{ route('admin.orders.email.store', $order) }}">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-default" data-toggle="tooltip"
                    title="{{ trans('order::orders.send_email') }}" data-loading>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </button>
        </form>
    </div>

    <h3 class="section-title">{{ trans('order::orders.order_and_account_information') }}</h3>

    <div class="row">
        <div class="col-md-6">
            <div class="order clearfix">
                <h4>{{ trans('order::orders.order_information') }}</h4>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>{{ trans('order::orders.order_id') }}</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('order::orders.order_date') }}</td>
                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('order::orders.order_status') }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-9 col-md-10 col-sm-10">
                                        <select id="order-status" class="form-control custom-select-black"
                                                data-id="{{ $order->id }}">
                                            @foreach (trans('order::statuses') as $name => $label)
                                                <option
                                                    value="{{ $name }}" {{ $order->status === $name ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @if ($order->hasShippingMethod())
                            <tr>
                                <td>{{ trans('order::orders.shipping_method') }}</td>
                                <td>
                                    <div class="flex-nowrap">
                                        <div>
                                            {{ $order->shipping_method }}
                                        </div>
                                        <div>
                                            @if($order->shipment_rate_id)
                                                @if (config('services.noviship.key'))
                                                    ({{ $order->shipment_rate_id }})
                                                @else
                                                    @if($order->getShipmentLabel())
                                                        <ul id="detail-shipping-label" class="detail-shipping show">
                                                            <li>
                                                                <i class="fa fa-tag" aria-hidden="true"></i>
                                                                <a href="{{$order->getShipmentLabel()->get('label_url')}}" target="_blank" id="url-shipping-label">
                                                                    Print Shipping Label (PDF)
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <a href="{{$order->getShipmentLabel()->get('tracking_url_provider')}}" target="_blank" id="tracking-url">
                                                                    URL for Tracking (<span id="tracking-id">{{$order->getShipmentLabel()->get('tracking_number')}}</span>)
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @else
                                                        <button class="btn btn-primary btn-sm" id="create-shipping-label"
                                                                data-id="{{ $order->id }}">Create
                                                            shipping label
                                                        </button>
                                                        <ul id="detail-shipping-label" class="detail-shipping">
                                                            <li>
                                                                <i class="fa fa-tag" aria-hidden="true"></i>
                                                                <a href="" target="_blank" id="url-shipping-label">
                                                                    Print Shipping Label (PDF)
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <a href="" target="_blank" id="tracking-url">
                                                                    URL for Tracking (<span id="tracking-id"></span>)
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td>{{ trans('order::orders.payment_method') }}</td>
                            <td>{{ $order->payment_method }}</td>
                        </tr>

                        @if (is_multilingual())
                            <tr>
                                <td>{{ trans('order::orders.currency') }}</td>
                                <td>{{ $order->currency }}</td>
                            </tr>

                            <tr>
                                <td>{{ trans('order::orders.currency_rate') }}</td>
                                <td>{{ $order->currency_rate }}</td>
                            </tr>
                        @endif

                        @if ($order->note)
                            <tr>
                                <td>{{ trans('order::orders.order_note') }}</td>
                                <td>{{ $order->note }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="account-information">
                <h4>{{ trans('order::orders.account_information') }}</h4>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>{{ trans('order::orders.customer_name') }}</td>
                            <td>{{ $order->customer_full_name }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('order::orders.customer_email') }}</td>
                            <td>{{ $order->customer_email }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('order::orders.customer_phone') }}</td>
                            <td>{{ $order->customer_phone }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('order::orders.customer_group') }}</td>

                            <td>
                                {{ is_null($order->customer_id) ? trans('order::orders.guest') : trans('order::orders.registered') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
