<template>
    <!-- Start product section -->
    <section class="product__section section--padding pt-0">
        <div class="container-fluid">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">{{ title }}</h2>
            </div>
            <div class="product__section--inner product__swiper--column5 swiper">
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
import ProductCard from './ProductCard.vue';
import { slickPrevArrow, slickNextArrow } from '../functions';

export default {
    components: { ProductCard },

    props: {
        title: '',
        products: {},
        slides: {
            default: 6,
            type: Number,
        },
    },

    computed: {
        hasAnyProduct() {
            return this.products.length !== 0;
        },
    },

    mounted() {
        var swiper = new Swiper('.product__swiper--column5', {
            slidesPerView: 5,
            clickable: true,
            loop: true,
            spaceBetween: 30,
            breakpoints: {
                1200: {
                    slidesPerView: 5,
                },
                992: {
                    slidesPerView: 4,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                280: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                0: {
                    slidesPerView: 1,
                },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    },
};
</script>
