@extends('public.layout')

@section('title', trans('storefront::compare.compare'))

@section('content')
    <compare-index :compare="{{ $compare }}" inline-template>
        <div>

            <!-- Start breadcrumb section -->
            <section class="breadcrumb__section breadcrumb__bg breadcrumb__bg3">
                <div class="container">
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="breadcrumb__content">
                                <h1 class="breadcrumb__content--title text-white mb-10">Compare</h1>
                                <ul class="breadcrumb__content--menu d-flex">
                                    <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                                    href="index.html">Home</a></li>
                                    <li class="breadcrumb__content--menu__items"><span class="text-white">Compare</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End breadcrumb section -->

            <!-- Start Compare section -->
            <section class="compare__section section--padding">
                <div class="container" v-cloak>
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="section__heading text-center mb-40">
                                <h2 class="compare__heading--maintitle">{{ trans('storefront::compare.compare') }}</h2>
                            </div>
                            <div class="compare__section--inner table-responsive" v-if="hasAnyProduct">
                                <table class="compare__table">
                                    <thead class="compare__table--header">
                                    <tr class="compare__table--items">
                                        <td class="compare__table--items__child" v-for="product in products">
                                            <button type="button" aria-label="compare remove btn"
                                                    class="compare__remove" @click="remove(product)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.105" height="24.732"
                                                     viewBox="0 0 512 512">
                                                    <path fill="currentColor" stroke="currentColor"
                                                          stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
                                                </svg>
                                            </button>
                                            <h4 class="compare__product--title">
                                                <a :href="productUrl(product)" v-text="product.name"
                                                   class="product-name"></a>
                                            </h4>
                                            <img class="compare__product--thumbnail" :src="baseImage(product)"
                                                 :class="{ 'image-placeholder': ! hasBaseImage(product) }"
                                                 alt="product image">
                                            <product-rating :rating-percent="product.rating_percent"
                                                            :review-count="product.reviews.length"></product-rating>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody class="compare__table--body">
                                    <tr class="compare__table--items">
                                        <td class="compare__table--items__child" v-for="product in products">
                                            <span class="compare__product--price"
                                                  v-html="product.formatted_price"></span>
                                        </td>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <th class="compare__table--items__child--header" v-for="product in products">
                                            {{ trans('storefront::compare.description') }}
                                        </th>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <td class="compare__table--items__child" v-for="product in products">
                                            <p class="compare__description" v-text="product.short_description || '-'">
                                                Lorem ipsum dolor sit, amet elit. Iusto excepturi fugiat vitae the are
                                                commodi nihil.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <th class="compare__table--items__child--header" v-for="product in products">
                                            {{ trans('storefront::compare.specification') }}
                                        </th>
                                    </tr>
                                    <tr v-for="attribute in attributes">
                                        <td class="compare__table--items__child" v-for="product in products">
                                            {{--                                            <span v-text="attribute.name"></span>--}}

                                            <div>
                                                <template v-if="hasAttribute(product, attribute)">
                                                    @{{ attributeValues(product, attribute) }}
                                                </template>

                                                <template v-else>
                                                    &ndash;
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <th class="compare__table--items__child--header" v-for="product in products">
                                            {{ trans('storefront::compare.availability') }}
                                        </th>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <td class="compare__table--items__child" v-for="product in products">
                                            <span class="badge badge-success compare__instock"
                                                  v-if="product.is_in_stock">
                                                    {{ trans('storefront::compare.in_stock') }}
                                            </span>
                                            <span class="badge badge-danger compare__instock" v-else>
                                                    {{ trans('storefront::compare.out_of_stock') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="compare__table--items">
                                        <td class="compare__table--items__child text-center"
                                            v-for="product in products">
                                            <button class="compare__cart--btn primary__btn"
                                                    v-if="hasNoOption(product) || product.is_out_of_stock"
                                                    :disabled="product.is_out_of_stock"
                                                    @click="addToCart(product)">
                                                <span class="add__to--cart__text">{{ trans('storefront::compare.add_to_cart') }}</span>
                                            </button>
                                            <a v-else :href="productUrl(product)"
                                                class="compare__cart--btn primary__btn"
                                            >
                                                {{ trans('storefront::product_card.view_options') }}
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="empty-message" v-else>
                                <svg version="1.1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 500 500"
                                     preserveAspectRatio="xMidYMid meet">
                                    <g>
                                        <path d="M250,26.72c-74.8,0-135.42,60.62-135.42,135.42c0,33.9,12.44,64.84,33.01,88.56c16.47,19.06,38.19,33.49,62.92,40.97
                                    c12.47,3.85,25.76,5.88,39.49,5.88c13.73,0,27.02-2.04,39.49-5.88c24.72-7.48,46.45-21.91,62.92-40.97
                                    c20.58-23.72,33.01-54.66,33.01-88.56C385.41,87.34,324.79,26.72,250,26.72z M308.73,202.41c1.52,1.52,1.52,4,0,5.51l-12.92,12.92
                                    c-1.55,1.55-4.03,1.55-5.55,0L250,180.57l-40.27,40.27c-1.52,1.55-4,1.55-5.51,0l-12.95-12.92c-1.52-1.52-1.52-4,0-5.51
                                    l40.27-40.27l-40.27-40.27c-1.52-1.52-1.52-4,0-5.55l12.95-12.92c1.52-1.52,4-1.52,5.51,0L250,143.67l40.27-40.27
                                    c1.52-1.52,4-1.52,5.55,0l12.92,12.92c1.52,1.55,1.52,4.03,0,5.55l-40.27,40.27L308.73,202.41z"/>
                                        <path
                                            d="M68.59,491.26H5.68V209.21c0-1.1,0.89-1.99,1.99-1.99H66.6c1.1,0,1.99,0.89,1.99,1.99V491.26z"/>
                                        <path d="M147.6,291.47c18.25,14.47,39.64,25.17,62.92,30.9v168.88H147.6V291.47z"/>
                                        <path d="M289.49,322.38c23.28-5.74,44.67-16.43,62.92-30.9v199.78h-62.92V322.38z"/>
                                        <path
                                            d="M494.32,491.26h-62.92V10.75c0-1.11,0.9-2.01,2.01-2.01h58.89c1.11,0,2.01,0.9,2.01,2.01V491.26z"/>
                                    </g>
                                </svg>

                                <h3>{{ trans('storefront::compare.no_product') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Compare section -->

            <landscape-products
                title="{{ trans('storefront::product.related_products') }}"
                v-if="hasAnyRelatedProduct"
                :products="relatedProducts"
                :class="{ loading: fetchingRelatedProducts }"
            >
            </landscape-products>
        </div>
    </compare-index>
@endsection
