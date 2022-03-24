<template>
    <!-- Start product section -->
    <section class="product__section section--padding pt-0">
        <div class="container-fluid">
            <div class="section__heading text-center mb-30">
                <h2 class="section__heading--maintitle">{{ data.title }}</h2>
                <span class="excerpt">{{ data.subtitle }}</span>
            </div>
            <ul class="product__tab--btn d-flex justify-content-center mb-50">
                <li
                    v-for="(tab, index) in tabs"
                    :key="index"
                    :class="classes(tab)"
                    :title="title(tab)"
                    @click="change(tab)"
                >{{ tab.label }}
                </li>
            </ul>
            <div class="tab_content">
                <div id="chair" class="tab_pane active show">
                    <div class="product__section--inner">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                            <ProductCard v-for="product in products" :key="product.id" :product="product" css-class="col mb-30"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <dynamic-tab
            v-for="(category, index) in data.categories"
            :key="index"
            :label="category.name"
            :initial-logo="category.logo"
            :url="route('storefront.featured_category_products.index', { categoryNumber: index + 1 })"
        >
        </dynamic-tab>
    </section>
    <!-- End product section -->
</template>

<script>
import ProductCard from '../ProductCard.vue';
import DynamicTabsMixin from '../../mixins/DynamicTabsMixin';
import { slickNextArrow, slickPrevArrow } from '../../functions';

export default {
    components: { ProductCard },

    mixins: [
        DynamicTabsMixin,
    ],

    props: ['data'],

    methods: {
        selector() {
            return $('.featured-category-products');
        },

        slickOptions() {
            return {
                rows: 0,
                dots: true,
                arrows: false,
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                rtl: window.FleetCart.rtl,
                prevArrow: slickPrevArrow(),
                nextArrow: slickNextArrow(),
                responsive: [
                    {
                        breakpoint: 1761,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        },
                    },
                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                    {
                        breakpoint: 1051,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                    {
                        breakpoint: 881,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                ],
            };
        },
    },
};
</script>
