@extends('public.layout')

@section('title', $product->meta->meta_title ?: $product->name)

@push('meta')
    <meta name="title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta name="description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta property="og:description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta property="og:image" content="{{ $product->base_image->path }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach

    <meta property="product:price:amount" content="{{ $product->selling_price->convertToCurrentCurrency()->amount() }}">
    <meta property="product:price:currency" content="{{ currency() }}">
@endpush

@push('globals')
    <script>
        FleetCart.langs['storefront::product.reviews'] = '{{ trans("storefront::product.reviews") }}';
        FleetCart.langs['storefront::product.review_form.based_on_reviews'] = '{{ trans("storefront::product.review_form.based_on_reviews") }}';
        FleetCart.langs['storefront::product.related_products'] = '{{ trans("storefront::product.related_products") }}';
    </script>

    {!! $productSchemaMarkup->toScript() !!}
@endpush

{{--@section('breadcrumb')--}}
{{--    @if (! $categoryBreadcrumb)--}}
{{--        <li><a href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a></li>--}}
{{--    @endif--}}

{{--    {!! $categoryBreadcrumb !!}--}}

{{--    <li class="active">{{ $product->name }}</li>--}}
{{--@endsection--}}

@section('content')

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg1">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">{{ trans('storefront::product.details') }}</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            @if (! $categoryBreadcrumb)
                                <li class="breadcrumb__content--menu__items">
                                    <a class="text-white"
                                       href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a>
                                </li>
                            @endif
                            {!! $categoryBreadcrumb !!}
                            <li class="breadcrumb__content--menu__items active">
                                <span class="text-white">
                                    {{ $product->name }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <product-show
        :product="{{ $product }}"
        :review-count="{{ $review->count ?? 0 }}"
        :avg-rating="{{ $review->avg_rating ?? 0 }}"
        inline-template
    >
        <!-- Start product details section -->
        <section class="product__details--section section--padding">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-md-2">
                    @include('public.products.show.images')
                    <div class="col">
                        <div class="product__details--info">
                            <h2 class="product__details--info__title mb-15">{{ $product->name }}</h2>
                            <div class="product__details--info__price mb-10">
                                    <span class="current__price" v-html="price">
                                        {!! $product->formatted_price !!}</span>
                            </div>
                            @if (setting('reviews_enabled'))
                                <product-rating :rating-percent="ratingPercent"
                                                :review-count="totalReviews"></product-rating>
                            @endif
                            @if ($product->isInStock())
                                @if ($product->manage_stock)
                                    <div class="product__details--availability in-stock">
                                        {{ trans('storefront::product.left_in_stock', ['count' => $product->qty]) }}
                                    </div>
                                @else
                                    <div class="product__details--availability in-stock">
                                        {{ trans('storefront::product.in_stock') }}
                                    </div>
                                @endif
                            @else
                                <div class="product__details--availability out-of-stock">
                                    {{ trans('storefront::product.out_of_stock') }}
                                </div>
                            @endif
                            <p class="product__details--info__desc mb-20">{!! $product->short_description !!}</p>
                            <div class="product__variant">
                                <form
                                    @submit.prevent="addToCart"
                                    @input="errors.clear($event.target.name)"
                                    @change="updatePrice"
                                    @nice-select-updated="updatePrice"
                                >
                                    <div class="product__variant--list mb-20">
                                        @foreach ($product->options as $option)
                                            @includeIf("public.products.show.custom_options.{$option->type}")
                                        @endforeach
                                    </div>
                                    <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                        <div class="quantity__box">
                                            <button
                                                type="button"
                                                class="quantity__value quickview__value--quantity decrease"
                                                aria-label="quantity value" value="Decrease Value"
                                                data-type="minus">-
                                            </button>
                                            <label>
                                                <input
                                                    type="number"
                                                    class="quantity__number quickview__value--number"
                                                    :value="cartItemForm.qty"
                                                    min="1"
                                                    max="{{ $product->manage_stock ? $product->qty : '' }}"
                                                    id="qty"
                                                    class="form-control input-number input-quantity"
                                                    @input="updateQuantity($event.target.value)"
                                                    @keydown.up="updateQuantity(cartItemForm.qty + 1)"
                                                    @keydown.down="updateQuantity(cartItemForm.qty - 1)"
                                                />
                                            </label>
                                            <button type="button"
                                                    class="quantity__value quickview__value--quantity increase"
                                                    aria-label="quantity value" value="Increase Value"
                                                    data-type="plus">+
                                            </button>
                                        </div>
                                        <button
                                            class="quickview__cart--btn primary__btn"
                                            type="submit"
                                            :class="{'btn-loading': addingToCart }"
                                            {{ $product->isOutOfStock() ? 'disabled' : '' }}
                                        >
                                            <i class="las la-cart-arrow-down"></i>
                                            {{ trans('storefront::product.add_to_cart') }}
                                        </button>
                                    </div>
                                </form>

                                <!-- Wish and Compare -->
                                <div class="product__variant--list d-flex mb-15">
                                    <a class="variant__wishlist--icon" :class="{ 'added': inWishlist }"
                                       @click="syncWishlist"
                                       title="{{ trans('storefront::product.add_to_wishlist') }}">
                                        <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                                        {{ trans('storefront::product.wishlist') }}
                                    </a>
                                    <a class="variant__wishlist--icon" :class="{ 'added': inCompareList }"
                                       @click="syncCompareList"
                                       title="{{ trans('storefront::product.add_to_compare') }}">
                                        <i class="la-heart" :class="inCompareList ? 'las' : 'lar'"></i>
                                        {{ trans('storefront::product.add_to_compare') }}
                                    </a>
                                </div>
                                <hr/>
                                <div class="product__variant--list mb-15">
                                    <div class="product__details--info__meta">
                                        @unless (is_null($product->sku))
                                            <p class="product__details--info__meta--list">
                                                <strong>{{ trans('storefront::product.sku') }}</strong>
                                                <span>{{ $product->sku }}</span>
                                            </p>
                                        @endunless
                                        @if ($product->categories->isNotEmpty())
                                            <p class="product__details--info__meta--list">
                                                <strong>{{ trans('storefront::product.categories') }}</strong>
                                                @foreach ($product->categories as $category)
                                                    <span><a href="{{ $category->url() }}">{{ $category->name }}</a>{{ $loop->last ? '' : ',' }}</span>
                                                @endforeach
                                            </p>
                                        @endif
                                        @if ($product->tags->isNotEmpty())
                                            <p class="product__details--info__meta--list">
                                                <strong>{{ trans('storefront::product.tags') }}</strong>

                                                @foreach ($product->tags as $tag)
                                                    <span><a href="{{ $tag->url() }}">{{ $tag->name }}</a>{{ $loop->last ? '' : ',' }}</span>
                                                @endforeach
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="quickview__social d-flex align-items-center mb-15">
                                <label class="quickview__social--title">{{ trans('storefront::product.share') }}</label>
                                @include('public.products.show.social_share')
                            </div>
                            <div class="guarantee__safe--checkout">
                                <h5 class="guarantee__safe--checkout__title">{{ trans('storefront::product.guaranteed_safe_checkout') }}</h5>
                                <img class="guarantee__safe--checkout__img"
                                     src="{{ $acceptedPaymentMethodsImage->path }}"
                                     alt="Payment Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End product details section -->

    </product-show>

    <product-show
        :product="{{ $product }}"
        :review-count="{{ $review->count ?? 0 }}"
        :avg-rating="{{ $review->avg_rating ?? 0 }}"
        inline-template
    >
        <!-- Start product details tab section -->
        <section class="product__details--tab__section section--padding">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <ul class="product__details--tab d-flex mb-30">
                            <li class="product__details--tab__list active" data-toggle="tab"
                                data-target="#description" :class="{ active: activeTab === 'description' }">
                                {{ trans('storefront::product.description') }}
                            </li>
                            @if ($product->hasAnyAttribute())
                                <li class="product__details--tab__list" data-toggle="tab"
                                    data-target="#specification"
                                    :class="{ active: activeTab === 'specification' }">
                                    {{ trans('storefront::product.specification') }}
                                </li>
                            @endif
                            @if ($product->hasDownloadsAttribute())
                                <li class="product__details--tab__list" data-toggle="tab" data-target="#downloads"
                                    :class="{ active: activeTab === 'download' }">
                                    {{ trans('product::products.tabs.downloads') }}
                                </li>
                            @endif
                            @if (setting('reviews_enabled'))
                                <li class="product__details--tab__list" data-toggle="tab" data-target="#reviews"
                                    :class="{ active: activeTab === 'reviews' }" v-cloak>
                                    @{{ $trans('storefront::product.reviews', { count: totalReviews }) }}
                                </li>
                            @endif
                        </ul>
                        <div class="product__details--tab__inner border-radius-10">
                            <div class="tab_content">
                                @include('public.products.show.tab_description')
                                @include('public.products.show.tab_specification')
                                @include('public.products.show.tab_download')
                                @include('public.products.show.tab_reviews')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </product-show>
    <!-- End product details tab section -->

    {{--                    @include('public.products.show.right_sidebar')--}}
    {{--                    @include('public.products.show.left_sidebar')--}}

    <related-products :products="{{ $relatedProducts }}"></related-products>

@endsection

@push('scripts')
    <script src="{{ v(Theme::url('public/js/flatpickr.js')) }}"></script>
@endpush
