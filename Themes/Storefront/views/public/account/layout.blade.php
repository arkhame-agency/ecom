@extends('public.layout')

@section('breadcrumb')
@endsection

@section('content')

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg1">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">{{trans('storefront::account.pages.my_account')}}</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items">
                                <a class="text-white" href="{{ route('home') }}">
                                    {{ trans('storefront::layout.home') }}
                                </a>
                            </li>
                            <li class="breadcrumb__content--menu__items">
                                <span class="text-white">
                                    {{trans('storefront::account.pages.my_account')}}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <h3 class="account__content--title mb-20">{{trans('storefront::account.pages.my_profile')}}</h3>
                    <ul class="account__menu">
                        <li class="account__menu--list {{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('account.dashboard.index') }}">
                                <i class="las la-tachometer-alt"></i>
                                {{ trans('storefront::account.pages.dashboard') }}
                            </a>
                        </li>
                        <li class="account__menu--list {{ request()->routeIs('account.orders.index') ? 'active' : '' }}">
                            <a href="{{ route('account.orders.index') }}">
                                <i class="las la-cart-arrow-down"></i>
                                {{ trans('storefront::account.pages.my_orders') }}
                            </a>
                        </li>
{{--                        <li class="account__menu--list {{ request()->routeIs('account.downloads.index') ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('account.downloads.index') }}">--}}
{{--                                <i class="las la-download"></i>--}}
{{--                                {{ trans('storefront::account.pages.my_downloads') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}

                        <li class="account__menu--list {{ request()->routeIs('account.wishlist.index') ? 'active' : '' }}">
                            <a href="{{ route('account.wishlist.index') }}">
                                <i class="lar la-heart"></i>
                                {{ trans('storefront::account.pages.my_wishlist') }}
                            </a>
                        </li>

                        <li class="account__menu--list {{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                            <a href="{{ route('account.reviews.index') }}">
                                <i class="las la-comment"></i>
                                {{ trans('storefront::account.pages.my_reviews') }}
                            </a>
                        </li>

                        <li class="account__menu--list {{ request()->routeIs('account.addresses.index') ? 'active' : '' }}">
                            <a href="{{ route('account.addresses.index') }}">
                                <i class="las la-address-book"></i>
                                {{ trans('storefront::account.pages.my_addresses') }}
                            </a>
                        </li>

                        <li class="account__menu--list {{ request()->routeIs('account.profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('account.profile.edit') }}">
                                <i class="las la-user-circle"></i>
                                {{ trans('storefront::account.pages.my_profile') }}
                            </a>
                        </li>

                        <li class="account__menu--list ">
                            <a href="{{ route('logout') }}">
                                <i class="las la-sign-out-alt"></i>
                                {{ trans('storefront::account.pages.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="account__wrapper">
                    <div class="account__content">
                        @yield('panel')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
@endsection
