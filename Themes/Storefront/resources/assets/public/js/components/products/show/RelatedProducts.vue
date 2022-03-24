<template>

    <!-- Start product section -->
    <section class="product__section section--padding" v-if="hasAnyProduct">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">{{ $trans('storefront::product.related_products') }}</h2>
            </div>
            <div class="product__section--inner product__swiper--column4 swiper">
                <div class="swiper-wrapper">
                    <ProductCard v-for="(product, index) in products" :key="index" :product="product"
                                 css-class="swiper-slide"></ProductCard>
                </div>
                <div class="swiper__nav--btn swiper-button-next"></div>
                <div class="swiper__nav--btn swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- End product section -->
</template>

<script>
import ProductCard from './../../ProductCard.vue';

export default {
    components: { ProductCard },

    props: ['products'],

    computed: {
        hasAnyProduct() {
            return this.products.length !== 0;
        },
    },
};
</script>
