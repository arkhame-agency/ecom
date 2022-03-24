<template>
    <!-- Start instagram section -->
    <section class="instagram__section section--padding pt-0">
        <div class="container-fluid">
            <div class="instagram__section--inner instagram__swiper--column5 swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="(topBrand, index) in topBrands">
                        <div class="instagram__thumbnail position__relative">
                            <a :key="index"
                               :href="topBrand.url"
                               class="instagram__thumbnail--link display-block">
                                <img class="instagram__thumbnail--img display-block" :src="topBrand.logo.path"
                                     alt="instagram-img">
                                <span class="instagram__social--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="39.697" height="27.066"
                                         viewBox="0 0 39.697 27.066">
                                            <path
                                                d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z"
                                                transform="translate(-1 -4.5)" fill="currentColor"/>
                                            </svg>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper__nav--btn swiper-button-next"></div>
                <div class="swiper__nav--btn swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- End instagram section -->
</template>

<script>
export default {
    props: ['topBrands'],
};
</script>
