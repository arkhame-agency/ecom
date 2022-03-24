<sidebar-cart inline-template>
    <!-- Start offCanvas minicart -->
    <div class="offCanvas__minicart" tabindex="-1">
        <div class="minicart__header ">
            <div class="minicart__header--top d-flex justify-content-between align-items-center">
                <h3 class="minicart__title">{{ trans('storefront::layout.shopping_cart') }}</h3>
                <button class="minicart__close--btn" aria-label="minicart close btn">
                    <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="32" d="M368 368L144 144M368 144L144 368"/>
                    </svg>
                </button>
            </div>
            {{--            <p class="minicart__header--desc">The organic foods products are limited</p>--}}
        </div>
        <div class="empty" v-if="cartIsEmpty">
            <div class="empty-message">
                @include('public.layout.sidebar_cart.empty_logo')

                <h4>{{ trans('storefront::cart.your_cart_is_empty') }}</h4>
            </div>
        </div>
        <div class="minicart__product" :class="{ empty: cartIsEmpty }">
            <sidebar-cart-item
                v-for="cartItem in cart.items"
                :key="cartItem.id"
                :cart-item="cartItem"
            >
            </sidebar-cart-item>
        </div>
        <div class="minicart__amount" v-if="cartIsNotEmpty">
            <div class="minicart__amount_list d-flex justify-content-between">
                <span>
                {{ trans('storefront::layout.subtotal') }}
                </span>
                <span><b v-html="cart.subTotal.inCurrentCurrency.formatted"></b></span>
            </div>
            {{--            <div class="minicart__amount_list d-flex justify-content-between">--}}
            {{--                <span>Total:</span>--}}
            {{--                <span><b>$240.00</b></span>--}}
            {{--            </div>--}}
        </div>
        <div class="minicart__conditions text-center">
            {{--            <input class="minicart__conditions--input" id="accept" type="checkbox">--}}
            {{--            <label class="minicart__conditions--label" for="accept">I agree with the <a--}}
            {{--                    class="minicart__conditions--link" href="privacy-policy.html">Privacy And Policy</a></label>--}}
        </div>
        <div class="minicart__button d-flex justify-content-center" v-if="cartIsNotEmpty">
            <a class="primary__btn minicart__button--link"
               href="{{ route('cart.index') }}">{{ trans('storefront::layout.view_cart') }}</a>
            <a class="primary__btn minicart__button--link"
               href="{{ route('checkout.create') }}">{{ trans('storefront::layout.checkout') }}</a>
        </div>
    </div>
    <!-- End offCanvas minicart -->

    {{--        @if (setting('storefront_cross_sell_sidebar_cart_enabled'))--}}
    {{--            <transition name="fade">--}}
    {{--                <landscape-products--}}
    {{--                    title="{{ trans('storefront::product.you_might_also_like') }}"--}}
    {{--                    :slides="2"--}}
    {{--                    v-if="hasAnyCrossSellProduct && cartIsNotEmpty"--}}
    {{--                    :products="crossSellProducts"--}}
    {{--                >--}}
    {{--                </landscape-products>--}}
    {{--            </transition>--}}
    {{--        @endif--}}

</sidebar-cart>
