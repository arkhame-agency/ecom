@extends('public.layout')

@section('title', trans('storefront::cart.cart'))

@section('content')
    <!-- cart section end -->
    <cart-index inline-template v-cloak :countries="{{ json_encode($countries) }}">
        <div>
            <section class="cart__section section--padding">
                <div class="container-fluid">
                    <div class="cart__section--inner">
                        <h2 class="cart__title mb-40">{{ trans('storefront::cart.shopping_cart') }}</h2>
                        <div class="row">
                            <div class="col-lg-8">
                                @include('public.cart.index.cart_items')
                            </div>
                            <div class="col-lg-4">
                                @include('public.cart.index.order_summary')
                            </div>
                            @include('public.cart.index.empty_cart')
                        </div>
                    </div>
                </div>
            </section>
            <landscape-products
                title="{{ trans('storefront::product.you_might_also_like') }}"
                v-if="hasAnyCrossSellProduct"
                :products="crossSellProducts"
            >
            </landscape-products>
        </div>
    </cart-index>
@endsection
