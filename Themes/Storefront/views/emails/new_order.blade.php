<!DOCTYPE html>
<html lang="en" style="-ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    -webkit-print-color-adjust: exact;"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
</head>

<body style="font-family: 'Open Sans', sans-serif;
                font-size: 15px;
                min-width: 320px;
                margin: 0;"
>
<table style="border-collapse: collapse; width: 100%;">
    <tbody>
    <tr>
        <td style="padding: 0;">
            <table style="border-collapse: collapse; width: 100%;">
                <tbody>
                <tr>
                    <td style="background: {{ mail_theme_color() }}; text-align: center;">
                        @if (is_null($logo))
                            <h5 style="font-size: 30px;
                                                    line-height: 36px;
                                                    margin: 0;
                                                    padding: 30px 15px;
                                                    text-align: center;"
                            >
                                <a href="{{ route('home') }}" style="font-family: 'Open Sans', sans-serif;
                                                                                    font-weight: 400;
                                                                                    color: #ffffff;
                                                                                    text-decoration: none;"
                                >
                                    {{ setting('store_name') }}
                                </a>
                            </h5>
                        @else
                            <div style="display: flex;
                                                        height: 64px;
                                                        width: 200px;
                                                        align-items: center;
                                                        justify-content: center;
                                                        margin: auto;
                                                        padding: 16px 15px;"
                            >
                                <img src="{{ $logo }}" style="max-height: 100%; max-width: 100%;" alt="logo">
                            </div>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding: 40px 15px;">
            <table style="border-collapse: collapse;
                                    min-width: 320px;
                                    max-width: 900px;
                                    width: 100%;
                                    margin: auto;"
            >
                <tr>
                    <td style="padding: 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        {{ trans('checkout::mail.new_order_text', ['order_id' => $order->id]) }}
                                    </span>
                    </td>
                </tr>


                <tr>
                    <td style="padding: 30px 0; text-align: center;">
                        <a href="{{ route('admin.orders.show', $order) }}" style="font-family: 'Open Sans', sans-serif;
                            font-weight: 400;
                            text-decoration: none;
                            display: inline-block;
                            background: {{ mail_theme_color() }};
                            color: #fafafa;
                            padding: 11px 30px;
                            border: none;
                            border-radius: 3px;
                            outline: 0;"
                        >
                            {{ trans('checkout::mail.view_order') }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style="border-collapse: collapse;
                            min-width: 320px;
                            max-width: 900px;
                            width: 100%;
                            margin: auto;
                            border-bottom: 2px solid {{ mail_theme_color() }};"
                        >
                            <tbody>
                            <tr>
                                <td style="padding: 0;">
                                    <table style="border-collapse: collapse;
                                        width: 100%;
                                        background: {{ mail_theme_color() }};"
                                    >
                                        <tbody>
                                        <tr>
                                            <td style="padding: 0 15px;">
                                                <table style="border-collapse: collapse;
                                                    width: 100%;border-radius: 3px"
                                                >
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 10px;width: 50%"
                                                        >
                                                        <span>
                                                            {{ trans('storefront::invoice.order_id') }}:
                                                        </span>

                                                            <span>
                                                            #{{ $order->id }}
                                                        </span>
                                                        </td>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 10px;width: 50%;text-align: right"
                                                        >
                                                        <span>
                                                            {{ trans('storefront::invoice.date') }}:
                                                        </span>

                                                            <span>
                                                            {{ $order->created_at->toFormattedDateString() }}
                                                        </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 30px 15px;">
                                    <table style="border-collapse: collapse;
                                    min-width: 320px;
                                    max-width: 760px;
                                    width: 100%;
                                    margin: auto;"
                                    >
                                        <tbody>
                                        <tr>
                                            <td style="padding: 0; width: 50%;">
                                                <table style="border-collapse: collapse; width: 100%;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;"
                                                            >
                                                                {{ trans('storefront::invoice.order_details') }}
                                                            </h5>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <table class="order-details"
                                                                   style="border-collapse: collapse; width: 50%;">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.email') }}:
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->customer_email }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.phone') }}:
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->customer_phone }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.payment_method') }}
                                                                        :
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->payment_method }}
                                                                    </td>
                                                                </tr>
                                                                @if($order->note)
                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.note') }}
                                                                        :
                                                                    </td>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                        >
                                                                            {{ $order->note }}
                                                                        </td>
                                                                </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 0;">
                                                <table class="shipping-address" style="border-collapse: collapse;
                                                                            width: 50%;
                                                                            float: left;
                                                                            margin-top: 25px;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;"
                                                            >
                                                                {{ trans('storefront::invoice.shipping_address') }}
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-weight: 400;
                                                            font-size: 15px;
                                                            padding: 0;">
                                                            <span style="display: block; padding: 4px 0;">
                                                                {{ $order->shipping_full_name }}
                                                            </span>
                                                            <span style="display: block; padding: 4px 0;">
                                                                {{ $order->shipping_address_1 }}
                                                            </span>
                                                            <span style="display: block; padding: 4px 0;">
                                                                {{ $order->shipping_address_2 }}
                                                            </span>
                                                            <span style="display: block; padding: 4px 0;">
                                                                {{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}
                                                            </span>
                                                            <span style="display: block; padding: 4px 0;">
                                                                {{ $order->shipping_country_name }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <table class="billing-address" style="border-collapse: collapse;
                                                                            width: 50%;
                                                                            float: left;
                                                                            margin-top: 25px;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="padding: 0;">
                                                            <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;">
                                                                {{ trans('storefront::invoice.billing_address') }}
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-weight: 400;
                                                            font-size: 15px;
                                                            padding: 0;"
                                                        >
                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_full_name }}
                                                        </span>

                                                            <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_address_1 }}
                                                        </span>

                                                            <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_address_2 }}
                                                        </span>

                                                            <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_city }}, {{ $order->billing_state_name }} {{ $order->billing_zip }}
                                                        </span>

                                                            <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_country_name }}
                                                        </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 30px 0 0;">
                                                <table style="border-collapse: collapse;
                                                    width: 100%;
                                                    border-bottom: 1px solid #e9e9e9;">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table style="border-collapse: collapse; width: 100%">
                                                                <thead>
                                                                <tr style="border-bottom: 1px solid #f1f1f1;">
                                                                    <th style="padding: 8px 0;width:40%;text-align: left">
                                                                        {{ trans('storefront::invoice.product') }}
                                                                    </th>
                                                                    <th style="padding: 8px 0;width:20%;text-align: right">
                                                                        {{ trans('storefront::invoice.unit_price') }}
                                                                    </th>
                                                                    <th style="padding: 8px 0;width:20%;text-align: right">
                                                                        {{ trans('storefront::invoice.quantity') }}
                                                                    </th>
                                                                    <th style="padding: 8px 0;width:20%;text-align: right">
                                                                        {{ trans('storefront::invoice.line_total') }}
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($order->products as $product)
                                                                    <tr>
                                                                        <td style="padding: 8px 0;width:40%;text-align: left">
                                                                            <a href="{{ $product->url() }}" style="font-family: 'Open Sans', sans-serif;
                                                                                    font-weight: 400;
                                                                                    font-size: 18px;
                                                                                    line-height: 22px;
                                                                                    color: #444444;
                                                                                    margin: 0;
                                                                                    text-decoration: none;">
                                                                                {{ $product->name }}
                                                                            </a>
                                                                            @if ($product->hasAnyOption())
                                                                                <table
                                                                                    style="border-collapse: collapse; width: 100%;">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                                    font-weight: 400;
                                                                                                    font-size: 14px;
                                                                                                    padding: 8px 0;">
                                                                                            @foreach ($product->options as $option)
                                                                                                <span
                                                                                                    style="display: block;">
                                                                                                    {{ $option->name }}:
                                                                                                    <span
                                                                                                        style="color: #9a9a9a; margin-left: 5px;">
                                                                                                        @if ($option->option->isFieldType())
                                                                                                            {{ $option->value }}
                                                                                                        @else
                                                                                                            {{ $option->values->implode('label', ', ') }}
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </span>
                                                                                            @endforeach
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            @endif
                                                                        </td>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 8px 0;width:20%;text-align: right">
                                                                            <span style="margin-left: 5px;">
                                                                                {{ $product->unit_price->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                                            </span>
                                                                        </td>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 8px 0;width:20%;text-align: right">
                                                                            <span style="margin-left: 5px;">
                                                                                {{ $product->qty }}
                                                                            </span>
                                                                        </td>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 8px 0;width:20%;text-align: right">
                                                                            <span style="margin-left: 5px;">
                                                                                {{ $product->line_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 0;">
                                                <table style="border-collapse: collapse;
                                                    width: 300px;
                                                    margin-top: 10px;
                                                    float: right;">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 400;
                                                            padding: 5px 0;">
                                                            {{ trans('storefront::invoice.subtotal') }}
                                                        </td>

                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 400;
                                                            padding: 5px 0;
                                                            float: right;">
                                                            {{ $order->sub_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                        </td>
                                                    </tr>

                                                    @if ($order->hasShippingMethod())
                                                        <tr>
                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;">
                                                                {{ $order->shipping_method }}
                                                            </td>

                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: right;">
                                                                {{ $order->shipping_cost->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @if ($order->hasCoupon())
                                                        <tr>
                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;">
                                                                {{ trans('storefront::invoice.coupon') }}
                                                                (<span
                                                                    style="color: #444444;">{{ $order->coupon->code }}</span>)
                                                            </td>

                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: right;">
                                                                {{ $order->discount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @foreach ($order->taxes as $tax)
                                                        <tr>
                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;">
                                                                {{ $tax->name }}
                                                            </td>

                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: right;">
                                                                {{ $tax->order_tax->amount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr style="border-top: 1px solid #e9e9e9;">
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 600;
                                                            padding: 5px 0;">
                                                            {{ trans('storefront::invoice.total') }}
                                                        </td>

                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 600;
                                                            padding: 5px 0;
                                                            float: right;">
                                                            {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0;">
                        <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 15px;
                                                line-height: 24px;
                                                display: block;
                                                padding: 5px 0 10px;
                                                color: #666666;
                                                border-top: 1px solid #e9e9e9;">
                            {{ trans('checkout::mail.if_you\’re_having_trouble') }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0;">
                        <a href="{{ route('admin.orders.show', $order) }}" style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 400;
                                                                font-size: 16px;
                                                                line-height: 26px;
                                                                text-decoration: underline;
                                                                color: #31629f;
                                                                word-break: break-all;">
                            {{ route('admin.orders.show', $order) }}
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding: 15px 0; background: #f1f3f7; text-align: center;">
            <span style="font-family: 'Open Sans', sans-serif;
                                    font-weight: 400;
                                    font-size: 16px;
                                    line-height: 26px;
                                    display: inline-block;
                                    color: #555555;
                                    padding: 0 15px;">
                &copy; {{ date('Y') }}
                <a target="_blank" href="{{ route('home') }}" style="text-decoration: none; color: #31629f;">
                    {{ setting('store_name') }}.
                </a>
                {{ trans('storefront::mail.all_rights_reserved') }}
            </span>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
