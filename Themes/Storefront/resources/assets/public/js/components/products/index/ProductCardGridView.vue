<template>
    <div class="col mb-30">
        <ProductCard :product="product"/>
    </div>
</template>

<script>
    import ProductCard from './../../ProductCard.vue';

    export default {
        components: { ProductCard },

        props: ['product'],
    };
</script>
