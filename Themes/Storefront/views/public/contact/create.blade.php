@extends('public.layout')

@section('title', trans('storefront::contact.contact'))

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg1">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">{{ trans('storefront::contact.contact_us') }}</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items">
                                <a class="text-white" href="{{ route('home') }}">
                                    {{ trans('storefront::layout.home') }}
                                </a>
                            </li>
                            <li class="breadcrumb__content--menu__items">
                                <span class="text-white">Contact Us</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start contact section -->
    <section class="contact__section section--padding">
        <div class="container">
            <div class="section__heading mb-40">
                <h2 class="section__heading--maintitle contact__section--hrading mb-10">
                    {{ trans('storefront::contact.get_in_touch') }}
                </h2>
                <p class="contact__section--hrading__desc">
                    {{ trans('storefront::contact.short_intro') }}
                </p>
            </div>
            <div class="main__contact--area">
                <div class="row align-items-center row-md-reverse">
                    <div class="col-lg-5">
                        <div class="contact__info border-radius-10">
                            @if (setting('store_phone') && ! setting('store_phone_hide'))
                                <div class="contact__info--items">
                                    <h3 class="contact__info--content__title text-white mb-15">
                                        {{ trans('storefront::contact.contact_us') }}
                                    </h3>
                                    <div class="contact__info--items__inner d-flex">
                                        <div class="contact__info--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31.568" height="31.128"
                                                 viewBox="0 0 31.568 31.128">
                                                <path id="ic_phone_forwarded_24px"
                                                      d="M26.676,16.564l7.892-7.782L26.676,1V5.669H20.362v6.226h6.314Zm3.157,7a18.162,18.162,0,0,1-5.635-.887,1.627,1.627,0,0,0-1.61.374l-3.472,3.424a23.585,23.585,0,0,1-10.4-10.257l3.472-3.44a1.48,1.48,0,0,0,.395-1.556,17.457,17.457,0,0,1-.9-5.556A1.572,1.572,0,0,0,10.1,4.113H4.578A1.572,1.572,0,0,0,3,5.669,26.645,26.645,0,0,0,29.832,32.128a1.572,1.572,0,0,0,1.578-1.556V25.124A1.572,1.572,0,0,0,29.832,23.568Z"
                                                      transform="translate(-3 -1)" fill="currentColor"/>
                                            </svg>
                                        </div>
                                        <div class="contact__info--content">
                                            <p class="contact__info--content__desc text-white">
                                                {!! trans('storefront::contact.contact_us_txt', ['phone_number'=> setting('store_phone'), 'phone_number_formatted'=> format_phone_number(setting('store_phone'))]) !!}
                                                @if (setting('store_fax') && ! setting('store_phone_hide'))
                                                    <br/>Fax : {{ format_phone_number(setting('store_fax')) }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(! setting('store_email_hide'))
                                <div class="contact__info--items">
                                    <h3 class="contact__info--content__title text-white mb-15">{{ trans('storefront::contact.email_address') }}</h3>
                                    <div class="contact__info--items__inner d-flex">
                                        <div class="contact__info--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13"
                                                 viewBox="0 0 31.57 31.13">
                                                <path id="ic_email_24px"
                                                      d="M30.413,4H5.157C3.421,4,2.016,5.751,2.016,7.891L2,31.239c0,2.14,1.421,3.891,3.157,3.891H30.413c1.736,0,3.157-1.751,3.157-3.891V7.891C33.57,5.751,32.149,4,30.413,4Zm0,7.783L17.785,21.511,5.157,11.783V7.891l12.628,9.728L30.413,7.891Z"
                                                      transform="translate(-2 -4)" fill="currentColor"/>
                                            </svg>
                                        </div>
                                        <div class="contact__info--content">
                                            <p class="contact__info--content__desc text-white">
                                                <a href="mailto:{{ setting('store_email') }}">{{ setting('store_email') }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (setting('storefront_address'))
                                <div class="contact__info--items">
                                    <h3 class="contact__info--content__title text-white mb-15">{{ trans('storefront::contact.office_location') }}</h3>
                                    <div class="contact__info--items__inner d-flex">
                                        <div class="contact__info--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13"
                                                 viewBox="0 0 31.57 31.13">
                                                <path id="ic_account_balance_24px"
                                                      d="M5.323,14.341V24.718h4.985V14.341Zm9.969,0V24.718h4.985V14.341ZM2,32.13H33.57V27.683H2ZM25.262,14.341V24.718h4.985V14.341ZM17.785,1,2,8.412v2.965H33.57V8.412Z"
                                                      transform="translate(-2 -1)" fill="currentColor"/>
                                            </svg>
                                        </div>
                                        <div class="contact__info--content">
                                            <p class="contact__info--content__desc text-white">
                                                <a
                                                    href="https://www.google.com/maps/search/{{ setting('storefront_address') }}"
                                                    target="_blank">{{ setting('storefront_address') }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="contact__info--items">
                                <h3 class="contact__info--content__title text-white mb-15">{{ trans('storefront::contact.follow_us') }}</h3>
                                @if (social_links()->isNotEmpty())
                                    <ul class="contact__info--social d-flex">
                                        @foreach (social_links() as $icon => $socialLink)
                                            <li class="contact__info--social__list">
                                                <a class="contact__info--social__icon" href="{{ $socialLink }}"
                                                   target="_blank">
                                                    <i class="{{ $icon }}"></i>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact__form">
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="email">
                                                {{ trans('contact::attributes.email') }}
                                                <span class="contact__form--label__star">*</span>
                                            </label>
                                            <input class="contact__form--input"
                                                   type="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   id="email"
                                            >
                                            @error('email')
                                            <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="subject">
                                                {{ trans('contact::attributes.subject') }}
                                                <span class="contact__form--label__star">*</span>
                                            </label>
                                            <input
                                                class="contact__form--input"
                                                type="text" name="subject"
                                                value="{{ old('subject') }}"
                                                id="subject"
                                            >
                                            @error('subject')
                                            <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="message">
                                                {{ trans('contact::attributes.message') }}
                                                <span class="contact__form--label__star">*</span>
                                            </label>
                                            <textarea rows="5" name="message" id="message"
                                                      class="contact__form--textarea">{{ old('message') }}</textarea>
                                            @error('message')
                                            <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="input3">
                                                {{ trans('contact::attributes.captcha') }}
                                                <span class="contact__form--label__star">*</span>
                                                <br />
                                                @captcha
                                            </label>
                                            <input type="text" name="captcha" class="contact__form--input"
                                                   placeholder="{{ trans('storefront::layout.enter_captcha_code') }}">

                                            @error('captcha')
                                            <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="account__login--remember position__relative mb-15">--}}
                                {{--                                    <input class="checkout__checkbox--input" id="check2" type="checkbox">--}}
                                {{--                                    <span class="checkout__checkbox--checkmark"></span>--}}
                                {{--                                    <label class="checkout__checkbox--label login__remember--label" for="check2">--}}
                                {{--                                        Accept Terms & Condition</label>--}}
                                {{--                                </div>--}}
                                <button type="submit" class="contact__form--btn primary__btn" data-loading>
                                    {{ trans('storefront::contact.send_message') }}
                                </button>
                                <p class="form-messege"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End contact section -->

    <!-- Start contact map area -->
    <div class="contact__map--area section--padding pt-0">
        <iframe
            class="contact__map--iframe"
            src="https://maps.google.com/maps?q={{ setting('storefront_address') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
    <!-- End contact map area -->
@endsection
