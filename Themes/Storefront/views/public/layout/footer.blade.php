<!-- Start footer section -->
<footer class="footer__section footer__bg">
    <div class="container-fluid">
        <div class="main__footer">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer__widget">
                        <div class="footer__widget--inner">
                            <h2 class="footer__widget--title ">{{ trans('storefront::layout.contact_us') }}</h2>
                            <ul class="list-inline contact-info">
                                @if (setting('store_phone') && ! setting('store_phone_hide'))
                                    <li>
                                        <a href="tel:{{ setting('store_phone') }}">
                                            {{ format_phone_number(setting('store_phone')) }}
                                        </a>
                                    </li>
                                    @if (setting('store_fax') && ! setting('store_phone_hide'))
                                        <li>
                                            {{ format_phone_number(setting('store_fax')) }}
                                        </li>
                                    @endif
                                @endif

                                @if (setting('store_email') && ! setting('store_email_hide'))
                                    <li>
                                        <a href="mailto:{{ setting('store_email') }}">{{ setting('store_email') }}</a>
                                    </li>
                                @endif

                                @if (setting('storefront_address'))
                                    <li>
                                        <a href="https://www.google.com/maps/search/{{ setting('storefront_address') }}"
                                           target="_blank">{{ setting('store_address_1') }}
                                            <br/>{{ stateName(setting('store_country'), setting('store_state'))}}
                                            , {{ setting('store_zip') }}<br/>{{ countryName(setting('store_country')) }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            {{-- Footer social --}}
                            <div class="footer__social">
                                @if (social_links()->isNotEmpty())
                                    <ul class="social__share d-flex">
                                        @foreach (social_links() as $icon => $socialLink)
                                            <li class="social__share--list">
                                                <a class="social__share--list__icon" target="_blank"
                                                   href="{{ $socialLink }}">
                                                    <i class="{{ $icon }}"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- $footerMenuOne --}}
                <div class="col-lg-2 col-md-6">
                    @if ($footerMenuOne->isNotEmpty())
                        <div class="footer__widget">
                            <h2 class="footer__widget--title ">{{ setting('storefront_footer_menu_one_title') }}
                                <button class="footer__widget--button" aria-label="footer widget button"></button>
                                <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                     width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                    <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                          transform="translate(-6 -8.59)" fill="currentColor"></path>
                                </svg>
                            </h2>
                            <ul class="footer__widget--menu footer__widget--inner">
                                @foreach ($footerMenuOne as $menuItem)
                                    <li class="footer__widget--menu__list">
                                        <a class="footer__widget--menu__text" target="{{ $menuItem->target }}"
                                           href="{{ $menuItem->url() }}">
                                            {{ $menuItem->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                {{-- $footerMenuTwo --}}
                <div class="col-lg-2 col-md-6">
                    @if ($footerMenuTwo->isNotEmpty())
                        <div class="footer__widget">
                            <h2 class="footer__widget--title ">{{ setting('storefront_footer_menu_two_title') }}
                                <button class="footer__widget--button" aria-label="footer widget button"></button>
                                <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                     width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                    <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                          transform="translate(-6 -8.59)" fill="currentColor"></path>
                                </svg>
                            </h2>
                            <ul class="footer__widget--menu footer__widget--inner">
                                @foreach ($footerMenuTwo as $menuItem)
                                    <li class="footer__widget--menu__list">
                                        <a class="footer__widget--menu__text" target="{{ $menuItem->target }}"
                                           href="{{ $menuItem->url() }}">
                                            {{ $menuItem->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                {{-- Account section --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title ">{{ trans('storefront::layout.my_account') }}
                            <button class="footer__widget--button" aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                 width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                      transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <ul class="footer__widget--menu footer__widget--inner">
                            <li class="footer__widget--menu__list">
                                <a class="footer__widget--menu__text" href="{{ route('account.dashboard.index') }}">
                                    {{ trans('storefront::account.pages.dashboard') }}
                                </a>
                            </li>
                            <li class="footer__widget--menu__list">
                                <a class="footer__widget--menu__text" href="{{ route('account.orders.index') }}">
                                    {{ trans('storefront::account.pages.my_orders') }}
                                </a>
                            </li>
                            <li class="footer__widget--menu__list">
                                <a class="footer__widget--menu__text"
                                   href="{{ trans('storefront::account.pages.my_reviews') }}">
                                    {{ trans('storefront::account.pages.my_reviews') }}
                                </a>
                            </li>
                            <li class="footer__widget--menu__list">
                                <a class="footer__widget--menu__text" href="{{ route('account.profile.edit') }}">
                                    {{ trans('storefront::account.pages.my_profile') }}
                                </a>
                            </li>
                            @auth
                                <li class="footer__widget--menu__list">
                                    <a class="footer__widget--menu__text" href="{{ route('logout') }}">
                                        {{ trans('storefront::account.pages.logout') }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
                {{-- Newsletter section--}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title ">{{ trans('storefront::layout.subscribe_to_our_newsletter') }}
                            <button class="footer__widget--button" aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                 width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                      transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <div class="footer__newsletter footer__widget--inner">
                            <p class="footer__newsletter--desc">
                                {{ trans('storefront::layout.subscribe_to_our_newsletter_subtitle') }}
                            </p>
{{--                            <form @submit.prevent="subscribe" class="newsletter__subscribe--form__style position__relative">--}}
{{--                                <label>--}}
{{--                                    <input--}}
{{--                                        v-model="email"--}}
{{--                                        class="footer__newsletter--input newsletter__subscribe--input"--}}
{{--                                        placeholder="{{ trans('storefront::layout.enter_your_email_address') }}"--}}
{{--                                        type="email"--}}
{{--                                    >--}}
{{--                                </label>--}}
{{--                                <button--}}
{{--                                    type="submit"--}}
{{--                                    class="footer__newsletter--button newsletter__subscribe--button primary__btn"--}}
{{--                                    v-if="subscribed"--}}
{{--                                    v-cloak--}}
{{--                                >--}}
{{--                                    <i class="las la-check"></i>--}}
{{--                                    {{ trans('storefront::layout.subscribed') }}--}}
{{--                                </button>--}}

{{--                                <button--}}
{{--                                    type="submit"--}}
{{--                                    class="footer__newsletter--button newsletter__subscribe--button primary__btn"--}}
{{--                                    :class="{ 'btn-loading': subscribing }"--}}
{{--                                    v-else--}}
{{--                                    v-cloak--}}
{{--                                >--}}
{{--                                    {{ trans('storefront::layout.subscribe') }}--}}
{{--                                    <svg class="newsletter__subscribe--button__icon" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         width="9.159" height="7.85" viewBox="0 0 9.159 7.85">--}}
{{--                                        <path data-name="Icon material-send"--}}
{{--                                              d="M3,12.35l9.154-3.925L3,4.5,3,7.553l6.542.872L3,9.3Z"--}}
{{--                                              transform="translate(-3 -4.5)" fill="currentColor"/>--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom d-flex justify-content-between align-items-center">
            <p class="copyright__content  m-0">
                {!! $copyrightText !!}
            </p>
            <div class="footer__payment text-right">
                <img class="footer__payment--visa__card display-block" src="{{ $acceptedPaymentMethodsImage->path }}"
                     alt="visa-card">
            </div>
        </div>
    </div>
</footer>
<!-- End footer section -->

{{--<footer class="footer-wrap">--}}
{{--    <div class="container">--}}
{{--        <div class="footer">--}}
{{--            <div class="footer-top">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-5 col-md-8">--}}
{{--                        <div class="contact-us">--}}
{{--                            <h4 class="title">{{ trans('storefront::layout.contact_us') }}</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    @if ($footerMenuTwo->isNotEmpty())--}}
{{--                        <div class="col-lg-3 col-md-5">--}}
{{--                            <div class="footer-links">--}}
{{--                                <h4 class="title">{{ setting('storefront_footer_menu_two_title') }}</h4>--}}

{{--                                <ul class="list-inline">--}}
{{--                                    @foreach ($footerMenuTwo as $menuItem)--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">--}}
{{--                                                {{ $menuItem->name }}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    @if ($footerTags->isNotEmpty())--}}
{{--                        <div class="col-lg-4 col-md-7">--}}
{{--                            <div class="footer-links footer-tags">--}}
{{--                                <h4 class="title">{{ trans('storefront::layout.tags') }}</h4>--}}

{{--                                <ul class="list-inline">--}}
{{--                                    @foreach ($footerTags as $footerTag)--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ $footerTag->url() }}">--}}
{{--                                                {{ $footerTag->name }}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="footer-bottom">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-md-9 col-sm-18">--}}
{{--                        <div class="footer-text">--}}
{{--                            {!! $copyrightText !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    @if ($acceptedPaymentMethodsImage->exists)--}}
{{--                        <div class="col-md-9 col-sm-18">--}}
{{--                            <div class="footer-payment">--}}
{{--                                <img src="{{ $acceptedPaymentMethodsImage->path }}" alt="accepted payment methods">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
