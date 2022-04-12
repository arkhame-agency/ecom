@extends('public.layout')

@section('title')
    @if (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ trans('storefront::products.shop') }}
    @endif
@endsection

@push('meta')
    <meta name="title" content="{{ $brand->meta->meta_title ?? $brandName ?? env('APP_NAME') }}">
    <meta name="description" content="{{ $brand->meta->meta_description ?? '' }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $brand->meta->meta_title ?? $brandName ?? env('APP_NAME')  }}">
    <meta property="og:description" content="{{ $brand->meta->meta_description ?? ''  }}">
    <meta property="og:image" content="{{ $brandLogo ?? $logo ?? "" }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach
@endpush

@push('globals')
    <script>
        FleetCart.langs['storefront::products.showing_results'] = '{{ trans("storefront::products.showing_results") }}';
        FleetCart.langs['storefront::products.show_more'] = '{{ trans("storefront::products.show_more") }}';
        FleetCart.langs['storefront::products.show_less'] = '{{ trans("storefront::products.show_less") }}';
    </script>
@endpush

@section('content')
    <product-index
        initial-query="{{ request('query') }}"
        initial-brand-name="{{ $brandName ?? '' }}"
        initial-brand-banner="{{ $brandBanner ?? '' }}"
        initial-brand-logo="{{ $brandLogo ?? '' }}"
        initial-brand-presentation="{{ $brandPresentation ?? '' }}"
        initial-brand-slug="{{ request('brand') }}"
        initial-category-name="{{ $categoryName ?? '' }}"
        initial-category-banner="{{ $categoryBanner ?? '' }}"
        initial-category-slug="{{ request('category') }}"
        initial-tag-name="{{ $tagName ?? '' }}"
        initial-tag-slug="{{ request('tag') }}"
        :initial-attribute="{{ json_encode(request('attribute', [])) }}"
        :max-price="{{ $maxPrice }}"
        initial-sort="{{ request('sort', 'latest') }}"
        :initial-per-page="{{ request('perPage', 30) }}"
        :initial-page="{{ request('page', 1) }}"
        initial-view-mode="{{ request('viewMode', 'grid') }}"
        initial-promotions="{{request('promotions', false)}}"
        inline-template
    >
        <div>
            <!-- Start breadcrumb section -->
            <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg2" @isset($categoryBanner)
            style="background: url('{{ $categoryBanner }}') center / cover"
                @endisset>
                <div class="container-fluid">
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="breadcrumb__content">
                                <h1 class="breadcrumb__content--title text-white mb-10">
                                    {{ trans('storefront::products.our_products') }}
                                </h1>
                                <ul class="breadcrumb__content--menu d-flex">
                                    <li class="breadcrumb__content--menu__items">
                                        <a class="text-white" href="{{ route('home') }}">
                                            {{ trans('storefront::layout.home') }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb__content--menu__items">
                                        <span class="text-white">
                                            {{ $categoryName ?? $brandName ?? $tagName ?? request('query') ?? trans('storefront::products.shop') }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End breadcrumb section -->

            <!-- Start shop section -->
            <section class="shop__section section--padding">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Left bar -->
                        <div class="col-xl-3 col-lg-4">
                            <div class="shop__sidebar--widget widget__area d-md-none">
                                <div class="single__widget widget__bg">
                                    {{--                        @include('public.products.index.latest_products')--}}
                                    <h2 class="widget__title position__relative h3">{{ trans('storefront::products.browse_categories') }}</h2>
                                    @if ($categories->isNotEmpty())
                                        @include('public.products.index.browse_categories')
                                    @endif
                                </div>
                                @include('public.products.index.filter')
                            </div>
                        </div>
                        <!-- Left bar -->
                        <div class="col-xl-9 col-lg-8">
                            <div class="content-left">
                                <h4 v-if="queryParams.query" v-cloak>
                                    {{ trans('storefront::products.search_results_for') }} <span
                                        v-text="queryParams.query"></span>
                                </h4>
                                <h2 class="widget__title h2" v-else-if="queryParams.brand && !brandPresentation"
                                    v-text="initialBrandName" v-cloak></h2>
                                <h2 class="widget__title h2" v-else-if="queryParams.category" v-text="categoryName"
                                    v-cloak></h2>
                                <h2 class="widget__title h2" v-else-if="queryParams.tag" v-text="initialTagName"
                                    v-cloak></h2>
                                <h2 class="widget__title h2" v-else
                                    v-cloak>{{ trans('storefront::products.shop') }}</h2>
                            </div>
                            <div class="shop__header bg__gray--color d-flex align-items-center justify-content-between
                            mb-30">
                                <button class="widget__filter--btn d-none d-md-flex align-items-center">
                                    <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="28"
                                              d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"/>
                                        <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                        <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                        <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                    </svg>
                                    <span
                                        class="widget__filter--btn__text">{{ trans('storefront::products.filters') }}</span>
                                </button>
                                <div class="product__view--mode d-flex align-items-center">
                                    <div
                                        class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
                                        <label class="product__view--label">
                                            {{ trans('storefront::products.per_page') }}:
                                        </label>
                                        <div class="select shop__header--select">
                                            <select
                                                class="product__view--select"
                                                v-model="queryParams.perPage"
                                                ref="perPageSelect"
                                            >
                                                @foreach (trans('storefront::products.per_page_options') as $key => $value)
                                                    <option
                                                        value="{{ $key }}"
                                                        {{ request('perPage', 30) == $key ? 'selected' : '' }}
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div
                                        class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
                                        <label class="product__view--label" for="product__view--select">
                                            {{ trans('storefront::products.sort_by') }}
                                        </label>
                                        <div class="select shop__header--select">
                                            <select
                                                id="product__view--select"
                                                class="product__view--select"
                                                v-model="queryParams.sort"
                                                ref="sortSelect"
                                            >
                                                @foreach (trans('storefront::products.sort_options') as $key => $value)
                                                    <option
                                                        value="{{ $key }}"
                                                        {{ request('sort', 'latest') === $key ? 'selected' : '' }}
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="product__view--mode__list">
                                        <div class="product__grid--column__buttons d-flex justify-content-center">
                                            <button
                                                type="submit"
                                                :class="{ active: viewMode === 'grid' }"
                                                title="{{ trans('storefront::products.grid_view') }}"
                                                @click="viewMode = 'grid'"
                                                class="product__grid--column__buttons--icons"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                     viewBox="0 0 9 9">
                                                    <g transform="translate(-1360 -479)">
                                                        <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4"
                                                              height="4" transform="translate(1360 479)"
                                                              fill="currentColor"/>
                                                        <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4"
                                                              height="4" transform="translate(1360 484)"
                                                              fill="currentColor"/>
                                                        <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4"
                                                              height="4" transform="translate(1365 479)"
                                                              fill="currentColor"/>
                                                        <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4"
                                                              height="4" transform="translate(1365 484)"
                                                              fill="currentColor"/>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button
                                                type="submit"
                                                :class="{ active: viewMode === 'list' }"
                                                title="{{ trans('storefront::products.list_view') }}"
                                                @click="viewMode = 'list'"
                                                class="product__grid--column__buttons--icons"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                     viewBox="0 0 13 8">
                                                    <g id="Group_14700" data-name="Group 14700"
                                                       transform="translate(-1376 -478)">
                                                        <g transform="translate(12 -2)">
                                                            <g id="Group_1326" data-name="Group 1326">
                                                                <rect id="Rectangle_5729" data-name="Rectangle 5729"
                                                                      width="3" height="2"
                                                                      transform="translate(1364 483)"
                                                                      fill="currentColor"/>
                                                                <rect id="Rectangle_5730" data-name="Rectangle 5730"
                                                                      width="9" height="2"
                                                                      transform="translate(1368 483)"
                                                                      fill="currentColor"/>
                                                            </g>
                                                            <g id="Group_1328" data-name="Group 1328"
                                                               transform="translate(0 -3)">
                                                                <rect id="Rectangle_5729-2" data-name="Rectangle 5729"
                                                                      width="3" height="2"
                                                                      transform="translate(1364 483)"
                                                                      fill="currentColor"/>
                                                                <rect id="Rectangle_5730-2" data-name="Rectangle 5730"
                                                                      width="9" height="2"
                                                                      transform="translate(1368 483)"
                                                                      fill="currentColor"/>
                                                            </g>
                                                            <g id="Group_1327" data-name="Group 1327"
                                                               transform="translate(0 -1)">
                                                                <rect id="Rectangle_5731" data-name="Rectangle 5731"
                                                                      width="3" height="2"
                                                                      transform="translate(1364 487)"
                                                                      fill="currentColor"/>
                                                                <rect id="Rectangle_5732" data-name="Rectangle 5732"
                                                                      width="9" height="2"
                                                                      transform="translate(1368 487)"
                                                                      fill="currentColor"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="product__showing--count" v-if="! emptyProducts" v-text="showingResults"></p>
                            </div>
                            <div class="shop__product--wrapper">
                                <div class="tab_content" :class="{ empty: emptyProducts, loading: fetchingProducts }">
                                    <!-- Product Gris render -->
                                    <div id="product_grid" class="tab_pane" v-if="viewMode === 'grid'"
                                         :class="{'active show': viewMode === 'grid'}">
                                        <div class="product__section--inner product__grid--inner">
                                            <div
                                                class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">
                                                <product-card-grid-view
                                                    v-for="product in products.data"
                                                    :key="product.id"
                                                    :product="product">
                                                </product-card-grid-view>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Product Gris render -->
                                    <!-- Product List render -->
                                    <div id="product_list" class="tab_pane" v-if="viewMode === 'list'"
                                         :class="{'active show': viewMode === 'list'}">
                                        <div class="product__section--inner">
                                            <div class="row row-cols-1 mb--n30">
                                                <div class="col mb-30">
                                                    <product-card-list-view
                                                        v-for="product in products.data" :key="product.id"
                                                        :product="product">
                                                    </product-card-list-view>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Product List render -->
                                    <div class="empty-message" v-if="! fetchingProducts && emptyProducts">
                                        @include('public.products.index.empty_results_logo')

                                        <h2>{{ trans('storefront::products.no_product_found') }}</h2>
                                    </div>
                                </div>
                                <div class="pagination__area bg__gray--color">
                                    <nav class="pagination">
                                        <v-pagination
                                            :total-page="totalPage"
                                            :current-page="queryParams.page"
                                            @page-changed="changePage"
                                            v-if="products.total > queryParams.perPage"
                                        >
                                        </v-pagination>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End shop section -->

            <!-- Start offcanvas filter sidebar -->
            <div class="offcanvas__filter--sidebar widget__area">
                <button type="button" class="offcanvas__filter--close">
                    <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
                    </svg>
                    <span class="offcanvas__filter--close__text">{{ trans('storefront::products.close') }}</span>
                </button>
                <div class="offcanvas__filter--sidebar__inner">
                    <div class="single__widget widget__bg">
                        <h2 class="widget__title position__relative h3">{{ trans('storefront::products.search') }}</h2>
                        <header-search
                            :categories="{{ $categories }}"
                            :most-searched-keywords="{{ $mostSearchedKeywords }}"
                            initial-query="{{ request('query') }}"
                            initial-category="{{ request('category') }}"
                        >
                        </header-search>
                    </div>
                    <div class="single__widget widget__bg">
                        <h2 class="widget__title position__relative h3">{{ trans('storefront::products.browse_categories') }}</h2>
                        @if ($categories->isNotEmpty())
                            @include('public.products.index.browse_categories', ['type'=>'filter'])
                        @endif
                    </div>
                    @include('public.products.index.filter')
                </div>
            </div>
            <!-- End offcanvas filter sidebar -->
        </div>
    </product-index>
@endsection
