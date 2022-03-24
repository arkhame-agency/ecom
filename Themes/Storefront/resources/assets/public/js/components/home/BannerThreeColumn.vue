<template>
    <!-- Start banner section -->
    <section class="banner__section section--padding pt-0">
        <div class="container-fluid">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 mb--n28">
                <div class="col mb-28">
                    <div class="banner__items">
                        <a
                            :href="data.banner_1.call_to_action_url"
                            class="banner__items--thumbnail position__relative"
                            :target="data.banner_1.open_in_new_window ? '_blank' : '_self'"
                        >
                            <img :src="data.banner_1.image.path" alt="banner" class="banner__items--thumbnail__img">
                        </a>
                    </div>
                </div>
                <div class="col mb-28">
                    <div class="banner__items">
                        <a
                            :href="data.banner_2.call_to_action_url"
                            class="banner__items--thumbnail position__relative"
                            :target="data.banner_2.open_in_new_window ? '_blank' : '_self'"
                        >
                            <img :src="data.banner_2.image.path" alt="banner" class="banner__items--thumbnail__img">
                        </a>
                    </div>
                </div>
                <div class="col mb-28">
                    <div class="banner__items">
                        <a
                            :href="data.banner_3.call_to_action_url"
                            class="banner__items--thumbnail position__relative"
                            :target="data.banner_3.open_in_new_window ? '_blank' : '_self'"
                        >
                            <img :src="data.banner_3.image.path" alt="banner" class="banner__items--thumbnail__img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['data'],
};
</script>
