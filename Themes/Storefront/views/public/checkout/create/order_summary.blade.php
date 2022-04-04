<div class="col-lg-5 col-md-6">
    <aside class="checkout__sidebar sidebar border-radius-10">
        <h2 class="checkout__order--summary__title text-center mb-15">{{ trans('storefront::cart.order_summary') }}</h2>
        <div class="cart__table checkout__product--table">
            <table class="cart__table--inner">
                <tbody class="cart__table--body">
                <tr class="cart__table--body__items" v-for="cartItem in cart.items">
                    <td class="cart__table--body__list">
                        <div class="product__image two  d-flex align-items-center">
                            <div class="product__thumbnail border-radius-5">
                                <a class="display-block" :href="productUrl(cartItem.product)">
                                    <img
                                        :src="baseImage(cartItem.product)"
                                        :class="{ 'image-placeholder': ! hasBaseImage(cartItem.product) }"
                                        class="display-block border-radius-5"
                                        alt="cart-product"
                                    >
                                </a>
                                <span class="product__thumbnail--quantity" v-text="'x' + cartItem.qty">1</span>
                            </div>
                            <div class="product__description">
                                <h4 class="product__description--name">
                                    <a :href="productUrl(cartItem.product)" v-text="cartItem.product.name">

                                    </a>
                                </h4>
                                <span class="product__description--variant mr-3" v-for="option in cartItem.options">
                                    @{{ option.name }}: @{{ optionValues(option) }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="cart__table--body__list">
                        <span class="cart__price" v-html="cartItem.unitPrice.inCurrentCurrency.formatted">-.--</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="checkout__discount--code">
            <div class="d-flex">
                <label>
                    <input
                        type="text"
                        v-model="couponCode"
                        placeholder="{{ trans('storefront::cart.enter_coupon_code') }}"
                        @input="couponError = null"
                        class="checkout__discount--code__input--field border-radius-5"
                    >
                </label>
                <button
                    class="checkout__discount--code__btn primary__btn border-radius-5"
                    type="button"
                    :class="{ 'btn-loading': applyingCoupon }"
                    @click.prevent="applyCoupon"
                >
                    {{ trans('storefront::cart.apply_coupon') }}
                </button>
                <span
                    class="error-message"
                    v-if="couponError"
                    v-text="couponError"
                >
                        </span>
            </div>
        </div>
        <div class="checkout__total mt-30">
            <table class="checkout__total--table" :class="{ loading: loadingOrderSummary }">
                <tbody class="checkout__total--body">
                <tr class="checkout__total--items">
                    <td class="checkout__total--title text-left">
                        {{ trans('storefront::cart.subtotal') }}
                    </td>
                    <td class="checkout__total--amount text-right" v-html="cart.subTotal.inCurrentCurrency.formatted">
                        -.--
                    </td>
                </tr>
                <tr class="checkout__total--items" v-if="hasCoupon" v-cloak>
                    <td class="checkout__total--title text-left">
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
                    <td class="checkout__total--amount text-right">
                        <span
                            class="price-amount"
                            v-html="'-' + cart.coupon.value.inCurrentCurrency.formatted"
                        >
                        </span>
                    </td>
                </tr>
                <tr v-for="tax in cart.taxes">
                    <td class="checkout__total--title text-left" v-text="tax.name">
                    </td>
                    <td class="checkout__total--calculated__text text-right"
                        v-html="tax.amount.inCurrentCurrency.formatted">
                    </td>
                </tr>
                <tr class="checkout__total--items" v-if="hasShippingMethod" v-cloak>
                    <td colspan="2" class="checkout__total">
                        <h3 class="payment__history--title mb-10">{{ trans('storefront::cart.shipping_method') }}</h3>
                    </td>
                </tr>
                <tr class="checkout__total--items" v-for="shippingMethod in cart.availableShippingMethods">
                    <td class="checkout__total--title text-left mb-20">
                        <div class="form-radio">
                            <input
                                type="radio"
                                name="shipping_method"
                                v-model="form.shipping_method"
                                :value="shippingMethod.name"
                                :id="shippingMethod.name"
                                @change="updateShippingMethod(shippingMethod)"
                            >
                            <label :for="shippingMethod.name" v-html="shippingMethod.label"></label>
                        </div>
                    </td>
                    <td class="checkout__total--calculated__text text-right mb-20">
                        <span
                            class="price-amount"
                            v-html="shippingMethod.cost.inCurrentCurrency.formatted"
                        >
                        </span>
                    </td>
                </tr>
                </tbody>
                <tfoot class="checkout__total--footer">
                <tr class="checkout__total--footer__items">
                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                        {{ trans('storefront::cart.total') }}
                    </td>
                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right"
                        v-html="cart.total.inCurrentCurrency.formatted">-.--
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        {{--            <ul class="payment__history--inner d-flex">--}}
        {{--                <li class="payment__history--list">--}}
        {{--                    <button class="payment__history--link primary__btn" type="submit">Credit Card</button>--}}
        {{--                </li>--}}
        {{--                <li class="payment__history--list">--}}
        {{--                    <button class="payment__history--link primary__btn" type="submit">Bank Transfer</button>--}}
        {{--                </li>--}}
        {{--                <li class="payment__history--list">--}}
        {{--                </li>--}}
        {{--            </ul>--}}
        @include('public.checkout.create.payment')
        <div class="payment__history mb-30">
            <div class="form-check">
                <input type="checkbox" v-model="form.terms_and_conditions" id="terms-and-conditions">

                <label for="terms-and-conditions" class="form-check-label">
                    {{ trans('storefront::checkout.i_agree_to_the') }}
                    <a href="{{ $termsPageURL }}">
                        {{ trans('storefront::checkout.terms_&_conditions') }}
                    </a>
                </label>

                <span class="error-message" v-if="errors.has('terms_and_conditions')"
                      v-text="errors.get('terms_and_conditions')"></span>
            </div>
        </div>

        <div id="paypal-button-container" v-if="form.payment_method === 'paypal'"></div>

        <button
            type="submit"
            class="checkout__now--btn primary__btn btn-place-order"
            :class="{ 'btn-loading': placingOrder }"
            :disabled="! form.terms_and_conditions"
            v-else
            v-cloak
        >
            {{ trans('storefront::checkout.place_order') }}
        </button>
    </aside>
</div>
