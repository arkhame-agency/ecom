<aside class="order-summary-wrap" v-if="cartIsNotEmpty">

    <div class="cart__summary border-radius-10">
        <div class="coupon__code mb-30">
            @include('public.cart.index.coupon')
        </div>
        <div class="cart__summary--total mb-20">
            <table class="cart__summary--total__table">
                <tbody>
                <tr class="cart__summary--total__list">
                    <td class="cart__summary--total__title text-left">
                        {{ trans('storefront::cart.subtotal') }}
                    </td>
                    <td
                        class="cart__summary--amount text-right"
                        v-html="cart.subTotal.inCurrentCurrency.formatted">
                        -.--
                    </td>
                </tr>
                <tr class="cart__summary--total__list" v-if="hasCoupon" v-cloak>
                    <td class="cart__summary--amount text-right">
                        {{ trans('storefront::cart.coupon') }}
                        <label>
                            <span class="coupon-code">
                                [@{{ cart.coupon.code }}]
                                <span class="btn-remove-coupon" @click="removeCoupon">
                                    <i class="las la-times"></i>
                                </span>
                            </span>
                        </label>
                    </td>
                    <td>
                        <span
                            class="price-amount"
                            v-html="'-' + cart.coupon.value.inCurrentCurrency.formatted"
                        >
                        </span>
                    </td>
                </tr>
                <tr class="cart__summary--total__list" v-for="tax in cart.taxes">
                    <td class="cart__summary--total__title text-left" v-text="tax.name">
                    </td>
                    <td
                        class="cart__summary--amount text-right"
                        v-html="tax.amount.inCurrentCurrency.formatted">
                        -.--
                    </td>
                </tr>
                <tr class="cart__summary--total__list">
                    <td class="cart__summary--total__title text-left">{{ trans('storefront::cart.total') }}</td>
                    <td class="cart__summary--amount text-right" v-html="cart.total.inCurrentCurrency.formatted">-.--
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="cart__summary--footer">
{{--            <p class="cart__summary--footer__desc">Shipping calculated at checkout</p>--}}
            <ul class="d-flex justify-content-between">
                <li>
                    <a class="cart__summary--footer__btn primary__btn checkout"
                       href="{{ route('checkout.create') }}">{{ trans('storefront::cart.checkout') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End -->
    {{--    <div class="order-summary">--}}
    {{--        <div class="order-summary-top">--}}
    {{--            <h3 class="section-title">{{ trans('storefront::cart.order_summary') }}</h3>--}}
    {{--        </div>--}}

    {{--        <div class="order-summary-middle" :class="{ loading: loadingOrderSummary }">--}}
    {{--            <ul class="list-inline order-summary-list">--}}

    {{--                <li v-for="tax in cart.taxes">--}}
    {{--                    <label v-text="tax.name"></label>--}}

    {{--                    <span--}}
    {{--                        class="price-amount"--}}
    {{--                        v-html="tax.amount.inCurrentCurrency.formatted"--}}
    {{--                    >--}}
    {{--                    </span>--}}
    {{--                </li>--}}
    {{--            </ul>--}}

    {{--            <div class="shipping-methods">--}}
    {{--                <h6>{{ trans('storefront::cart.shipping_method') }}</h6>--}}

    {{--                <div class="form-group" v-if="hasShippingMethod" v-cloak>--}}
    {{--                    <div class="form-radio" v-for="shippingMethod in cart.availableShippingMethods">--}}
    {{--                        <input--}}
    {{--                            type="radio"--}}
    {{--                            name="shipping_method"--}}
    {{--                            v-model="shippingMethodName"--}}
    {{--                            :value="shippingMethod.name"--}}
    {{--                            :id="shippingMethod.name"--}}
    {{--                            @change="updateShippingMethod(shippingMethod)"--}}
    {{--                        >--}}

    {{--                        <label :for="shippingMethod.name" v-text="shippingMethod.label"></label>--}}

    {{--                        <span--}}
    {{--                            class="price-amount"--}}
    {{--                            v-html="shippingMethod.cost.inCurrentCurrency.formatted"--}}
    {{--                        >--}}
    {{--                        </span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <form id="address-to-ship-wrap" v-else v-cloak>--}}
    {{--                    --}}{{-- Country --}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="billing-country">--}}
    {{--                            {{ trans('storefront::cart.shipping_address.country') }}<span>*</span>--}}
    {{--                        </label>--}}

    {{--                        <select--}}
    {{--                            name="shipping[country]"--}}
    {{--                            :value="form.shipping.country"--}}
    {{--                            id="shipping-country"--}}
    {{--                            class="form-control arrow-black"--}}
    {{--                            @change="changeShippingCountry($event.target.value)"--}}
    {{--                        >--}}
    {{--                            <option--}}
    {{--                                v-for="(name, code) in countries"--}}
    {{--                                :value="code"--}}
    {{--                                v-text="name"--}}
    {{--                            >--}}
    {{--                            </option>--}}
    {{--                        </select>--}}

    {{--                        <span--}}
    {{--                            class="error-message"--}}
    {{--                            v-if="errors.has('shipping.country')"--}}
    {{--                            v-text="errors.get('shipping.country')"--}}
    {{--                        >--}}
    {{--                        </span>--}}
    {{--                    </div>--}}
    {{--                    --}}{{-- State --}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="shipping-state">--}}
    {{--                            {{ trans('storefront::cart.shipping_address.state') }}<span>*</span>--}}
    {{--                        </label>--}}

    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            name="shipping[state]"--}}
    {{--                            :value="form.shipping.state"--}}
    {{--                            id="shipping-state"--}}
    {{--                            class="form-control"--}}
    {{--                            v-if="! hasShippingStates"--}}
    {{--                            @change="changeShippingState($event.target.value)"--}}
    {{--                        >--}}

    {{--                        <select--}}
    {{--                            name="shipping[state]"--}}
    {{--                            v-model="form.shipping.state"--}}
    {{--                            id="shipping-state"--}}
    {{--                            class="form-control arrow-black"--}}
    {{--                            v-else--}}
    {{--                        >--}}
    {{--                            <option value="">{{ trans('storefront::checkout.please_select') }}</option>--}}

    {{--                            <option--}}
    {{--                                v-for="(name, code) in states.shipping"--}}
    {{--                                :value="code"--}}
    {{--                                v-text="name"--}}
    {{--                            >--}}
    {{--                            </option>--}}
    {{--                        </select>--}}

    {{--                        <span--}}
    {{--                            class="error-message"--}}
    {{--                            v-if="errors.has('shipping.state')"--}}
    {{--                            v-text="errors.get('shipping.state')"--}}
    {{--                        >--}}
    {{--                        </span>--}}
    {{--                    </div>--}}
    {{--                    --}}{{-- Zip code--}}
    {{--                    <div class="form-group">--}}
    {{--                        <label for="billing-zip">--}}
    {{--                            {{ trans('storefront::cart.shipping_address.zip') }}<span>*</span>--}}
    {{--                        </label>--}}

    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            name="shipping[zip]"--}}
    {{--                            :value="form.shipping.zip"--}}
    {{--                            id="shipping-zip"--}}
    {{--                            class="form-control"--}}
    {{--                            @change="changeShippingZip($event.target.value)"--}}
    {{--                        >--}}

    {{--                        <span--}}
    {{--                            class="error-message"--}}
    {{--                            v-if="errors.has('shipping.zip')"--}}
    {{--                            v-text="errors.get('shipping.zip')"--}}
    {{--                        >--}}
    {{--                        </span>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}

    {{--            <div class="order-summary-total">--}}
    {{--                <label>{{ trans('storefront::cart.total') }}</label>--}}
    {{--                <span class="total-price"></span>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="order-summary-bottom">--}}
    {{--            <a--}}
    {{--                href="{{ route('checkout.create') }}"--}}
    {{--                class="btn btn-primary btn-proceed-to-checkout"--}}
    {{--            >--}}
    {{--                {{ trans('storefront::cart.proceed_to_checkout') }}--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</aside>
