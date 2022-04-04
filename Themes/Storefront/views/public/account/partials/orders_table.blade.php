{{--<h3 class="account__content--title mb-20">Orders History</h3>--}}
<div class="account__table--area">
    <table class="account__table">
        <thead class="account__table--header">
        <tr class="account__table--header__child">
            <th class="account__table--header__child--items">{{ trans('storefront::account.orders.order_id') }}</th>
            <th class="account__table--header__child--items">{{ trans('storefront::account.date') }}</th>
            <th class="account__table--header__child--items">{{ trans('storefront::account.status') }}</th>
            <th class="account__table--header__child--items">{{ trans('storefront::account.orders.total') }}</th>
            <th class="account__table--header__child--items">{{ trans('storefront::account.action') }}</th>
        </tr>
        </thead>
        <tbody class="account__table--body mobile__none">
        @foreach ($orders as $order)
            <tr class="account__table--body__child">
                <td class="account__table--body__child--items">
                    {{ $order->id }}
                </td>
                <td class="account__table--body__child--items">
                    {{ $order->created_at->toFormattedDateString() }}
                </td>
                <td class="account__table--body__child--items">
                <span class="badge {{ order_status_badge_class($order->status) }}">
                    {{ $order->status() }}
                </span>
                </td>
                <td class="account__table--body__child--items">
                    {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                </td>
                <td class="account__table--body__child--items">
                    <a href="{{ route('account.orders.show', $order) }}" class="btn btn-view">
                        <i class="las la-eye"></i>
                        {{ trans('storefront::account.orders.view') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tbody class="account__table--body mobile__block">
        @foreach ($orders as $order)
            <tr class="account__table--body__child">
                <td class="account__table--body__child--items">
                    <a href="{{ route('account.orders.show', $order) }}" class="btn btn-view">
                        <i class="las la-eye"></i>
                        {{ trans('storefront::account.orders.view') }}
                    </a>
                </td>
                <td class="account__table--body__child--items">
                    <strong>Order</strong>
                    <span>{{ $order->id }}</span>
                </td>
                <td class="account__table--body__child--items">
                    <strong>Date</strong>
                    <span>{{ $order->created_at->toFormattedDateString() }}</span>
                </td>
                <td class="account__table--body__child--items">
                    <strong>Payment Status</strong>
                    <span class="badge {{ order_status_badge_class($order->status) }}">
                    {{ $order->status() }}
                </span>
                </td>
                <td class="account__table--body__child--items">
                    <strong>Total</strong>
                    <span>{{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
