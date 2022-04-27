@extends('public.layout')

{{--@section('title', trans('storefront::checkout.checkout'))--}}

@section('content')
    <checkout-create
        customer-email="{{ auth()->user()->email ?? null }}"
        customer-phone="{{ auth()->user()->phone ?? null }}"
        :addresses="{{ $addresses }}"
        :default-address="{{ $defaultAddress }}"
        :gateways="{{ $gateways }}"
        :countries="{{ json_encode($countries) }}"
        inline-template
    >
        <div>
            <!-- Start breadcrumb section -->
            <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg1">
                <div class="container">
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="breadcrumb__content">
                                <h1 class="breadcrumb__content--title text-white mb-10">{{ trans('storefront::checkout.checkout') }}</h1>
                                <ul class="breadcrumb__content--menu d-flex">
                                    <li class="breadcrumb__content--menu__items">
                                        <a class="text-white" href="{{ route('home') }}">
                                            {{ trans('storefront::layout.home') }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb__content--menu__items"><span class="text-white">{{ trans('storefront::checkout.checkout') }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End breadcrumb section -->

            <!-- Start checkout page area -->
            <div class="checkout__page--area section--padding">
                <div class="container">
                    <form @submit.prevent="placeOrder" @input="errors.clear($event.target.name)">
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="main checkout__mian">
                                    @include('public.checkout.create.form.account_details')
                                    @include('public.checkout.create.form.billing_details')
                                    @include('public.checkout.create.form.order_note')
                                    <div class="checkout__content--step__footer d-flex align-items-center">
                                        <a class="previous__link--content" href="{{route('cart.index')}}">
                                            {{ trans('storefront::cart.return_to_cart') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @include('public.checkout.create.order_summary')
                        </div>
                    </form>
                </div>
            </div>
            <!-- End checkout page area -->
        </div>
    </checkout-create>
@endsection

@push('pre-scripts')
    @if (setting('paypal_enabled'))
        <script
            src="https://www.paypal.com/sdk/js?client-id={{ setting('paypal_client_id') }}&currency={{ setting('default_currency') }}&disable-funding=credit,card,venmo,sepa,bancontact,eps,giropay,ideal,mybank,p24,p24"></script>
    @endif

    @if (setting('stripe_enabled'))
        <script src="https://js.stripe.com/v3/"></script>
    @endif

    @if (setting('paytm_enabled'))
        @if (setting('paytm_test_mode'))
            <script
                src="https://securegw-stage.paytm.in/merchantpgpui/checkoutjs/merchants/{{ setting('paytm_merchant_id') }}.js"></script>
        @else
            <script
                src="https://securegw.paytm.in/merchantpgpui/checkoutjs/merchants/{{ setting('paytm_merchant_id') }}.js"></script>
        @endif
    @endif

    @if (setting('razorpay_enabled'))
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif
@endpush
