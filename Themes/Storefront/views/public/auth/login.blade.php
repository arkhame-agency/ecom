@extends('public.layout')

@section('title', trans('user::auth.login'))

@section('content')

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg2">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">{{ trans('storefront::account.pages.my_account') }}</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items">
                                <a class="text-white" href="{{ route('home') }}">
                                    {{ trans('storefront::layout.home') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container">
            <div class="login__section--inner">
                <div class="row row-cols-md-2 row-cols-1">
                    <div class="col">
                        <div class="account__login">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">
                                    {{ trans('user::auth.login') }}
                                </h3>
                                <p class="account__login--header__desc">
                                    {{ trans('user::auth.message_login') }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="account__login--inner">
                                    <label>
                                        <input
                                            class="account__login--input"
                                            placeholder="{{ trans('user::auth.email') }}"
                                            name="email"
                                            value="{{ old('email') }}"
                                            id="email"
                                            type="email"
                                        >
                                        @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input" type="password" name="password"
                                               id="password" placeholder="{{ trans('user::auth.password') }}">
                                        @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <div
                                        class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                        <div class="account__login--remember position__relative">


                                            <input type="hidden" name="remember_me" value="0">
                                            <input type="checkbox" class="checkout__checkbox--input"
                                                   name="remember_me" value="1"
                                                   id="remember" {{ old('remember_me', false) ? 'checked' : '' }}>
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label for="remember"
                                                   class="checkout__checkbox--label login__remember--label">
                                                {{ trans('user::auth.remember_me') }}
                                            </label>
                                        </div>
                                        <a class="account__login--forgot" href="{{ route('reset') }}">
                                            {{ trans('user::auth.forgot_password') }}
                                        </a>
                                    </div>
                                    <button class="account__login--btn primary__btn" type="submit" data-loading>
                                        {{ trans('user::auth.sign_in') }}
                                    </button>
                                    @include('public.auth.partials.social_login')
                                    <p class="account__login--signup__text mt-15">
                                        {{ trans('user::auth.dont_have_an_account') }}
                                        <a href="{{ route('register') }}">
                                            {{ trans('user::auth.create_account') }}
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col">
                        <div class="account__login register">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">{{ trans('user::auth.register') }}</h3>
                                <p class="account__login--header__desc">
                                    {{ trans('user::auth.register_message') }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="account__login--inner">
                                    <label>
                                        <input
                                            class="account__login--input"
                                            placeholder="{{ trans('user::auth.first_name') }}"
                                            name="first_name"
                                            value="{{ old('first_name') }}"
                                            id="first-name"
                                            type="text">
                                        @error('first_name')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               name="last_name" value="{{ old('last_name') }}" id="last-name"
                                               placeholder="{{ trans('user::auth.last_name') }}"
                                               type="text">
                                        @error('last_name')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               placeholder="{{ trans('user::auth.email') }}"
                                               name="email"
                                               value="{{ old('email') }}"
                                               id="email" type="email"
                                        >
                                        @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               type="email"
                                               name="validate_mail"
                                               value="{{ old('email') }}"
                                               id="validate-email"
                                               placeholder="{{ trans('user::auth.valida_email') }}"
                                        >
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               id="phone"
                                               placeholder="{{ trans('user::auth.phone') }}"
                                               type="tel">
                                        @error('phone')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               placeholder="{{ trans('user::auth.password') }}"
                                               type="password"
                                               name="password"
                                               id="password">
                                        @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        <input class="account__login--input"
                                               placeholder="{{ trans('user::auth.confirm_password') }}"
                                               type="password"
                                               name="password_confirmation"
                                               id="confirm-password"
                                        >
                                        @error('password_confirmation')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <label>
                                        @captcha
                                        <input type="text" name="captcha" id="captcha" class="account__login--input"
                                               placeholder="{{ trans('storefront::layout.enter_captcha_code') }}">
                                        @error('captcha')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </label>

                                    <label>
                                        <button type="submit"  class="account__login--btn primary__btn mb-10" data-loading>
                                            {{ trans('user::auth.create_account') }}
                                        </button>
                                    </label>
                                    <div class="account__login--remember position__relative">

                                        <input type="hidden" name="privacy_policy" value="0">
                                        <input type="checkbox" class="checkout__checkbox--input" name="privacy_policy"
                                               value="1" id="terms" {{ old('privacy_policy', false) ? 'checked' : '' }}>

                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="terms">
                                            {{ trans('user::auth.i_agree_to_the') }} <a
                                                href="{{ $privacyPageUrl }}">{{ trans('user::auth.privacy_policy') }}</a>
                                        </label>
                                        @error('privacy_policy')
                                        <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End login section  -->
@endsection
