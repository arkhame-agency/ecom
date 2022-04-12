<template>
    <!-- Start shipping section -->
    <section class="shipping__section shipping_mt position__relative section--padding pt-0">
        <div class="container">
            <div class="shipping__section--inner border-radius-10 d-flex justify-content-center">
                <div class="shipping__items text-center" v-for="(feature, index) in features" :key="index">
                    <div class="shipping__items--icon">
                        <i :class="feature.icon"></i>
                    </div>
                    <div class="shipping__items--content">
                        <h3 class="shipping__items--content__title">{{ feature.title }}</h3>
                        <span v-html="feature.subtitle"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shipping section -->

    <!--    <section class="features-wrap">-->
    <!--        <div class="container">-->
    <!--            <div class="features">-->
    <!--                <div class="feature-list">-->
    <!--                    <div class="single-feature" v-for="(feature, index) in features" :key="index">-->
    <!--                        <div class="feature-icon">-->
    <!--                            -->
    <!--                        </div>-->

    <!--                        <div class="feature-details">-->
    <!--                            <h6>{{ feature.title }}</h6>-->
    <!--                            <span>{{ feature.subtitle }}</span>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->
</template>

<script>
export default {
    props: ['features'],
};
</script>
