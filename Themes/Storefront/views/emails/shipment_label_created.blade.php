<!DOCTYPE html>
<html lang="en" style="-ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    -webkit-print-color-adjust: exact;"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <style>
        td {
            vertical-align: top;
        }

        @media screen and (max-width: 767px) {
            .order-details {
                width: 100% !important;
            }

            .shipping-address {
                width: 100% !important;
            }

            .billing-address {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="font-family: 'Open Sans', sans-serif;
                font-size: 15px;
                min-width: 320px;
                color: #555555;
                margin: 0;">
<table style="border-collapse: collapse;
    min-width: 320px;
    max-width: 900px;
    width: 100%;
    margin: auto;
    border-bottom: 2px solid {{ mail_theme_color() }};">
    <tbody>
    <tr>
        <td style="padding: 0;">
            <table style="border-collapse: collapse;
                width: 100%;
                background: {{ mail_theme_color() }};">
                <tbody>
                <tr>
                    <td style="padding: 0 15px; text-align: center;">
                        @if (is_null($logo))
                            <h1 style="font-family: 'Open Sans', sans-serif;
                                                    font-weight: 400;
                                                    font-size: 32px;
                                                    line-height: 39px;
                                                    display: inline-block;
                                                    color: #fafafa;
                                                    margin: 17px 0 0;">
                                {{ setting('store_name') }}
                            </h1>
                        @else
                            <div style="display: flex;
                                                        height: 64px;
                                                        width: 200px;
                                                        align-items: center;
                                                        justify-content: center;
                                                        margin: auto;">
                                <img src="{{ $logo }}" style="max-height: 100%; max-width: 100%;" alt="logo">
                            </div>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0 15px; text-align: center;">
                        <span style="font-family: 'Open Sans', sans-serif;
                                                    font-weight: 400;
                                                    font-size: 56px;
                                                    line-height: 68px;
                                                    display: inline-block;
                                                    color: #fafafa;
                                                    margin: 3px 0 5px;">
                            {{ trans('storefront::shipped.ready_to_ship') }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0 15px;">
                        <table style="border-collapse: collapse;
                                                    width: 230px;
                                                    margin: 0 auto 20px;">
                            <tbody>
                            <tr>
                                <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 0;">
                                    <span style="float: left;">
                                        {{ trans('storefront::invoice.order_id') }}:
                                    </span>
                                    <span style="float: right;">
                                        #{{ $order->id }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 0;">
                                    <span style="float: left;">
                                        {{ trans('storefront::invoice.date') }}:
                                    </span>
                                    <span style="float: right;">
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
            <p>
                {!! trans('storefront::shipped.your_order_is_ready_to_ship_via', ['shipping_method' => $order->shipping_method]) !!}
            </p>

            <span style="display: block; padding: 4px 0;">
                <b>{{ $order->shipping_full_name }}</b>
            </span>

            <span style="display: block;">
                {{ $order->shipping_address_1 }}
            </span>

            <span style="display: block;">
                {{ $order->shipping_address_2 }}
            </span>

            <span style="display: block;">
                {{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}
            </span>

            <span style="display: block;">
                {{ $order->shipping_country_name }}
            </span>

            <p>
                {{trans('storefront::shipped.you_can_track_your_shipment_here')}}<br>
                <a href="{{ $shipmentLabel->tracking_url_provider }}">{{ $shipmentLabel->tracking_url_provider }}</a>
            </p>

            <p>
                {{trans('storefront::shipped.your_tracking_number_is')}}<br>
                {{ $shipmentLabel->tracking_number }}
            </p>
            <hr/>

            <p>
                {{trans('storefront::shipped.it_may_take_24_hours_for_your_tracking_number_to_return_correct_information')}}
            </p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
