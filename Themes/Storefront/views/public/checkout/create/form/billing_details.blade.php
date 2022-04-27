<div class="checkout__content--step section__shipping--address">
    <div class="section__header mb-25">
        <h2 class="section__header--title h3">{{ trans('storefront::checkout.billing_details') }}</h2>
    </div>
    <div class="select-address" v-if="hasAddress" v-cloak>
        <div class="form-group">
            <div class="form-radio" v-for="address in addresses">
                <input
                    type="radio"
                    v-model="form.billingAddressId"
                    :value="address.id"
                    :id="'billing-address-' + address.id"
                >

                <label :for="'billing-address-' + address.id">
                    <span v-text="address.full_name"></span>
                    <span v-text="address.address_1"></span>
                    <span v-if="address.address_2" v-text="address.address_2"></span>
                    <span>@{{ address.city }}, @{{ address.state_name }} @{{ address.zip }}</span>
                    <span v-text="address.country_name"></span>
                </label>
            </div>

            <span class="error-message" v-if="! form.newBillingAddress && errors.has('billing.address_1')">
                {{ trans('storefront::checkout.you_must_select_an_address') }}
            </span>
        </div>
    </div>
    <div class="section__shipping--address__content add-new-address-wrap" v-cloak>
        <button v-if="hasAddress"
                type="button"
                class="btn btn-add-new-address"
                @click="addNewBillingAddress"
        >
            {{ trans('storefront::checkout.add_new_address') }}
        </button>
        <div class="row" v-show="! hasAddress || form.newBillingAddress">
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list ">
                    <label class="checkout__input--label mb-5"
                           for="billing-first-name">{{ trans('checkout::attributes.billing.first_name') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="billing[first_name]"
                        v-model="form.billing.first_name"
                        id="billing-first-name"
                        class="checkout__input--field border-radius-5"
                        placeholder="{{ trans('checkout::attributes.billing.first_name') }}"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('billing.first_name')"
                        v-text="errors.get('billing.first_name')"
                    >
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="billing-last-name">
                        {{ trans('checkout::attributes.billing.last_name') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="billing[last_name]"
                        v-model="form.billing.last_name"
                        id="billing-last-name"
                        class="checkout__input--field border-radius-5" placeholder="{{ trans('checkout::attributes.billing.last_name') }}"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('billing.last_name')"
                        v-text="errors.get('billing.last_name')"
                    >
                    </span>
                </div>
            </div>
            <div class="col-12 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="billing-address-1">
                        {{ trans('checkout::attributes.street_address') }}
                        <span class="checkout__input--label__star">*</span>
                    </label>
                    <input
                        type="text"
                        name="billing[address_1]"
                        v-model="form.billing.address_1"
                        id="billing-address-1"
                        placeholder="{{ trans('checkout::attributes.billing.address_1') }}"
                        class="checkout__input--field border-radius-5"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('billing.address_1')"
                        v-text="errors.get('billing.address_1')"
                    >
                </span>
                </div>
            </div>
            <div class="col-12 mb-20">
                <div class="checkout__input--list">
                    <input
                        type="text"
                        name="billing[address_2]"
                        v-model="form.billing.address_2"
                        class="checkout__input--field border-radius-5"
                        placeholder="{{ trans('checkout::attributes.billing.address_2') }}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="input5">
                        {{ trans('checkout::attributes.billing.city') }}
                        <span class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="billing[city]"
                        :value="form.billing.city"
                        id="billing-city"
                        class="checkout__input--field border-radius-5"
                        @change="changeBillingCity($event.target.value)"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('billing.city')"
                        v-text="errors.get('billing.city')"
                    >
                        </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="input5">
                        {{ trans('checkout::attributes.billing.zip') }}
                        <span class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="billing[zip]"
                        :value="form.billing.zip"
                        id="billing-zip"
                        class="checkout__input--field border-radius-5"
                        @change="changeBillingZip($event.target.value)"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('billing.zip')"
                        v-text="errors.get('billing.zip')"
                    >
                        </span>
                </div>
            </div>
            <div class="col-lg-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="country">
                        {{ trans('checkout::attributes.billing.country') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <div class="checkout__input--select select">
                        <select
                            name="billing[country]"
                            :value="form.billing.country"
                            id="billing-country"
                            class="checkout__input--select__field border-radius-5"
                            @change="changeBillingCountry($event.target.value)"
                        >
                            <option
                                v-for="(name, code) in countries"
                                :value="code"
                                v-text="name"
                            >
                            </option>
                        </select>

                        <span
                            class="error-message"
                            v-if="errors.has('billing.country')"
                            v-text="errors.get('billing.country')"
                        >
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="input6">
                        {{ trans('checkout::attributes.billing.state') }} <span
                            class="checkout__input--label__star">*</span></label>

                    <div class="checkout__input--select select">
                        <input
                            type="text"
                            name="billing[state]"
                            :value="form.billing.state"
                            id="billing-state"
                            class="checkout__input--select__field border-radius-5"
                            v-if="! hasBillingStates"
                            @change="changeBillingState($event.target.value)"
                        >

                        <select
                            name="billing[state]"
                            v-model="form.billing.state"
                            id="billing-state"
                            class="checkout__input--select__field border-radius-5"
                            v-else
                        >
                            <option value="">{{ trans('storefront::checkout.please_select') }}</option>

                            <option
                                v-for="(name, code) in states.billing"
                                :value="code"
                                v-text="name"
                            >
                            </option>
                        </select>

                        <span
                            class="error-message"
                            v-if="errors.has('billing.state')"
                            v-text="errors.get('billing.state')"
                        >
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('public.checkout.create.form.shipping_details')
</div>
