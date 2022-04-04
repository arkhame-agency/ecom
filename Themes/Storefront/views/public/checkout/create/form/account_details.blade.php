@guest
    <div class="checkout__content--step section__contact--information">
        <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
            <h2 class="section__header--title h3">{{ trans('storefront::checkout.account_details') }}</h2>
            <p class="layout__flex--item">
                Already have an account?
                <a class="layout__flex--item__link" href="login.html">Log in</a>
            </p>
        </div>
        <div class="customer__information">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-20">
                    <div class="checkout__input--list ">
                        <label class="checkout__input--label mb-5" for="email">
                            {{ trans('checkout::attributes.customer_email') }} <span
                                class="checkout__input--label__star">*</span>
                        </label>
                        <input
                            type="email"
                            name="customer_email"
                            v-model="form.customer_email"
                            id="email"
                            class="checkout__input--field border-radius-5"
                            placeholder="{{ trans('checkout::attributes.customer_email') }}"
                        >
                        <span
                            class="error-message"
                            v-if="errors.has('customer_email')"
                            v-text="errors.get('customer_email')"
                        ></span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-20">
                    <div class="checkout__input--list ">
                        <label class="checkout__input--label mb-5" for="phone">
                            {{ trans('checkout::attributes.customer_phone') }} <span
                                class="checkout__input--label__star">*</span>
                        </label>
                        <input
                            type="text"
                            name="customer_phone"
                            v-model="form.customer_phone"
                            id="phone"
                            class="checkout__input--field border-radius-5"
                            placeholder="{{ trans('checkout::attributes.customer_phone') }}"
                        >
                        <span
                            class="error-message"
                            v-if="errors.has('customer_phone')"
                            v-text="errors.get('customer_phone')"
                        ></span>
                    </div>
                </div>
            </div>
            <div class="checkout__checkbox mb-20">
                <input
                    type="checkbox"
                    name="create_an_account"
                    class="checkout__checkbox--input"
                    v-model="form.create_an_account"
                    id="create-an-account"
                >
                <span class="checkout__checkbox--checkmark"></span>
                <label class="checkout__checkbox--label" for="create-an-account">
                    {{ trans('checkout::attributes.create_an_account') }}</label>
            </div>
            <div v-show="form.create_an_account" v-cloak>
                <div class="col-12 mb-20">
                    {{ trans('storefront::checkout.create_an_account_by_entering_the_information_below') }}
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-20">
                        <div class="checkout__input--list ">
                            <label class="checkout__input--label mb-5" for="email">
                                {{ trans('checkout::attributes.password') }} <span
                                    class="checkout__input--label__star">*</span>
                            </label>
                            <input
                                type="password"
                                name="password"
                                v-model="form.password"
                                id="password"
                                class="checkout__input--field border-radius-5"
                                placeholder="{{ trans('checkout::attributes.password') }}"
                            >
                            <span
                                class="error-message"
                                v-if="errors.has('password')"
                                v-text="errors.get('password')"
                            ></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <input type="hidden" name="customer_email" v-model="form.customer_email">
@endguest
