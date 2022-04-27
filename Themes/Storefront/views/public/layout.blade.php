<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <base href="{{ config('app.url') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - {{ setting('store_name') }}
        @else
            {{ setting('store_name') }}
        @endif
    </title>

    @stack('meta')

    {{--    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">--}}
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ v(Theme::url('public/css/glightbox.min.css')) }}">
    <link rel="stylesheet" href="{{ v(Theme::url('public/css/swiper-bundle.min.css')) }}">
    @if (is_rtl())
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
    @endif

    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

    @stack('styles')

    {!! setting('custom_header_assets') !!}

    <script>
        window.FleetCart = {
            baseUrl: '{{ config("app.url") }}',
            rtl: {{ is_rtl() ? 'true' : 'false' }},
            storeName: '{{ setting("store_name") }}',
            storeLogo: '{{ $logo }}',
            loggedIn: {{ auth()->check() ? 'true' : 'false' }},
            csrfToken: '{{ csrf_token() }}',
            stripePublishableKey: '{{ setting("stripe_publishable_key") }}',
            defaultCountry: '{{ setting("default_country") }}',
            locale: '{{ locale() }}',
            razorpayKeyId: '{{ setting("razorpay_key_id") }}',
            cart: {!! $cart !!},
            wishlist: {!! $wishlist !!},
            compareList: {!! $compareList !!},
            langs: {
                'storefront::layout.next': '{{ trans("storefront::layout.next") }}',
                'storefront::layout.prev': '{{ trans("storefront::layout.prev") }}',
                'storefront::layout.search_for_products': '{{ trans("storefront::layout.search_for_products") }}',
                'storefront::layout.all_categories': '{{ trans("storefront::layout.all_categories") }}',
                'storefront::layout.most_searched': '{{ trans("storefront::layout.most_searched") }}',
                'storefront::layout.category_suggestions': '{{ trans("storefront::layout.category_suggestions") }}',
                'storefront::layout.product_suggestions': '{{ trans("storefront::layout.product_suggestions") }}',
                'storefront::layout.more_results': '{{ trans("storefront::layout.more_results") }}',
                'storefront::product_card.out_of_stock': '{{ trans("storefront::product_card.out_of_stock") }}',
                'storefront::product_card.new': '{{ trans("storefront::product_card.new") }}',
                'storefront::product_card.add_to_cart': '{{ trans("storefront::product_card.add_to_cart") }}',
                'storefront::product_card.view_options': '{{ trans("storefront::product_card.view_options") }}',
                'storefront::product_card.compare': '{{ trans("storefront::product_card.compare") }}',
                'storefront::product_card.wishlist': '{{ trans("storefront::product_card.wishlist") }}',
                'storefront::product_card.available': '{{ trans("storefront::product_card.available") }}',
                'storefront::product_card.sold': '{{ trans("storefront::product_card.sold") }}',
                'storefront::product_card.years': '{{ trans("storefront::product_card.years") }}',
                'storefront::product_card.months': '{{ trans("storefront::product_card.months") }}',
                'storefront::product_card.weeks': '{{ trans("storefront::product_card.weeks") }}',
                'storefront::product_card.days': '{{ trans("storefront::product_card.days") }}',
                'storefront::product_card.hours': '{{ trans("storefront::product_card.hours") }}',
                'storefront::product_card.minutes': '{{ trans("storefront::product_card.minutes") }}',
                'storefront::product_card.seconds': '{{ trans("storefront::product_card.seconds") }}',
                'storefront::brands.brands': '{{ trans("storefront::brands.brands") }}',
                'storefront::layout.remove': '{{ trans("storefront::layout.remove") }}',
                'auth::validation.confirmed': '{{ trans("user::auth.validation.confirmed") }}',
                'auth::validation.email': '{{ trans("user::auth.validation.email") }}',
            },
        };
    </script>

    {!! $schemaMarkup->toScript() !!}

    @stack('globals')

    @routes
</head>

<body
    class="page-template {{ is_rtl() ? 'rtl' : 'ltr' }}"
    data-theme-color="#{{ $themeColor->getHex() }}"
    style="--color-primary: #{{ $themeColor->getHex() }};
        --color-primary-hover: #{{ $themeColor->darken(100) }};
        --color-primary-transparent: {{ color2rgba($themeColor, 0.8) }};
        --color-primary-transparent-lite: {{ color2rgba($themeColor, 0.3) }};"
>
<div id="app">
    @yield('before_header')
    @include('public.layout.header')
    <main class="main__content_wrapper">
        @include('public.layout.breadcrumb')
        @yield('content')
    </main>
    {{--    @include('public.home.sections.subscribe')--}}

    @include('public.layout.footer')

    <div class="overlay"></div>

{{--@include('public.layout.sidebar_menu')--}}
@include('public.layout.alert')
@include('public.layout.newsletter_popup')
@include('public.layout.entreprise_popup')
@include('public.layout.cookie_bar')

<!-- Scroll top bar -->
    <button aria-label="scroll top btn" id="scroll__top">
        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                  d="M112 244l144-144 144 144M256 120v292"/>
        </svg>
    </button>
    <!-- End scroll top bar -->
</div>

@stack('pre-scripts')

<script src="/background-check.min.js" type="text/javascript"></script>
<script src="{{ v(Theme::url('public/js/plugins/swiper-bundle.min.js')) }}"></script>
<script src="{{ v(Theme::url('public/js/plugins/glightbox.min.js')) }}"></script>
<script src="{{ v(Theme::url('public/js/app.js')) }}"></script>
<script src="{{ v(Theme::url('public/js/script.js')) }}"></script>

@stack('scripts')

{!! setting('custom_footer_assets') !!}
</body>
</html>
