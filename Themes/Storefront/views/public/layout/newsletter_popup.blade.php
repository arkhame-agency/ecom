@if (setting('newsletter_enabled') && json_decode(Cookie::get('show_newsletter_popup', true)))
    <newsletter-popup inline-template>
        <div class="modal" id="modal1" data-animation="slideInUp">
            <div class="modal-dialog quickview__main--wrapper">
                <header class="modal-header quickview__header">
                    <button class="close-modal quickview__close--btn" aria-label="close modal" data-close>✕</button>
                </header>
                <div class="quickview__inner">
                    <div class="newsletter-left">
                        <h1 class="title">
                            {{ trans('storefront::layout.subscribe_to_our_newsletter') }}
                        </h1>

                        <p class="sub-title">
                            {{ trans('storefront::layout.subscribe_to_our_newsletter_subtitle') }}
                        </p>

                        <form @submit.prevent="subscribe" class="newsletter-form">
                            @if(setting('newsletter_last_name_enabled'))
                                <div class="form-group mb-3">
                                    <input
                                        type="text"
                                        v-model="name"
                                        class="contact__form--input"
                                        placeholder="{{ trans('storefront::layout.enter_your_name') }}"
                                    >
                                </div>

                                <div class="form-group mb-3">
                                    <input
                                        type="text"
                                        v-model="lname"
                                        class="contact__form--input"
                                        placeholder="{{ trans('storefront::layout.enter_your_last_name') }}"
                                    >
                                </div>
                            @endif

                            <div class="form-group">
                                <input
                                    type="text"
                                    v-model="email"
                                    class="contact__form--input"
                                    placeholder="{{ trans('storefront::layout.enter_your_email_address') }}"
                                >

                                <span class="error-message" v-if="error" v-text="error"></span>

                                <button class="btn btn-primary btn-subscribe" v-if="subscribed">
                                    <i class="las la-check"></i>
                                    {{ trans('storefront::layout.subscribed') }}
                                </button>

                                <button
                                    class="btn btn-primary btn-subscribe"
                                    :class="{ 'btn-loading': subscribing }"
                                    v-else
                                >
                                    {{ trans('storefront::layout.subscribe') }}
                                </button>
                            </div>

                            <span class="error-message" v-if="error" v-text="error"></span>
                        </form>

                        <p class="info-text">
                            {{ trans('storefront::layout.by_subscribing') }} <a
                                href="{{ $privacyPageUrl }}" target="_blank">{{ trans('storefront::layout.privacy_policy') }}</a>
                        </p>

                        <div class="form-group newsletter-checkbox">
                            <div class="form-check">
                                <input type="checkbox" v-model="disable_popup" id="do_not_show_popup_again">

                                <label for="do_not_show_popup_again" class="form-check-label">
                                    {{ trans('storefront::layout.don\'t_show_this_popup_again') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="newsletter-right" style="background-image: url({{ $newsletterBgImage }})"></div>
                </div>
            </div>
        </div>
    </newsletter-popup>
@endif
