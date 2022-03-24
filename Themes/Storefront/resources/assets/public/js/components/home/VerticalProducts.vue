<template>
    <div class="product__section--wrapper">
        <div class="section__heading style2 position__relative border-bottom mb-35">
            <h2 class="section__heading--maintitle">{{ title }}</h2>
        </div>
        <div class="product__section--inner">
            <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n25"
                 v-for="(productChunks, index) in $chunk(products, 8)" :key="index">
                <ProductCardVertical v-for="product in productChunks" :key="product.id" :product="product"/>
            </div>
        </div>
    </div>
</template>

<script>
import ProductCardVertical from '../ProductCardVertical.vue';

export default {
    components: { ProductCardVertical },

    props: ['title', 'url'],

    data() {
        return {
            products: [],
        };
    },

    created() {
        $.ajax({
            method: 'GET',
            url: this.url,
        }).then((products) => {
            this.products = products;

            this.$nextTick(() => {
                $(this.$refs.productsPlaceholder).slick(this.slickOptions());
            });
        });
    },

    methods: {
        slickOptions() {
            return {
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
            };
        },
    },
};
</script>
