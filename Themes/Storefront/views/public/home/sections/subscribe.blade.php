<newsletter-subscription inline-template>
    <!-- Start Newsletter banner section -->
    <section class="newsletter__banner--section section--padding pb-0 pt-0">
        <div class="container-fluid">
            <div class="newsletter__banner--thumbnail position__relative">
                <img class="newsletter__banner--thumbnail__img display-block"
                     src="{{ asset('themes/storefront/public/images/img_newsletter.jpg') }}"
                     alt="newsletter-banner">
                <div class="newsletter__content newsletter__subscribe">
                    <h5 class="newsletter__content--subtitle text-white">{{ trans('storefront::layout.subscribe_to_our_newsletter_subtitle') }}</h5>
                    <h2 class="newsletter__content--title text-white h3 mb-25">
                        {{ trans('storefront::layout.subscribe_to_our_newsletter') }}
                    </h2>
                    <form @submit.prevent="subscribe" class="newsletter__subscribe--form position__relative">
                        <label>
                            <input
                                v-model="email"
                                class="newsletter__subscribe--input"
                                placeholder="{{ trans('storefront::layout.enter_your_email_address') }}"
                                type="email"
                            >
                        </label>
                        <button
                            type="submit"
                            class="newsletter__subscribe--button primary__btn"
                            v-if="subscribed"
                            v-cloak
                        >
                            <i class="las la-check"></i>
                            {{ trans('storefront::layout.subscribed') }}
                        </button>

                        <button
                            type="submit"
                            class="newsletter__subscribe--button primary__btn"
                            :class="{ 'btn-loading': subscribing }"
                            v-else
                            v-cloak
                        >
                            {{ trans('storefront::layout.subscribe') }}
                            <svg class="newsletter__subscribe--button__icon" xmlns="http://www.w3.org/2000/svg"
                                 width="9.159" height="7.85" viewBox="0 0 9.159 7.85">
                                <path data-name="Icon material-send"
                                      d="M3,12.35l9.154-3.925L3,4.5,3,7.553l6.542.872L3,9.3Z"
                                      transform="translate(-3 -4.5)" fill="currentColor"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Newsletter banner section -->
</newsletter-subscription>
