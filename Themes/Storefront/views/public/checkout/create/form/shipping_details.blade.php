<details :open="form.ship_to_a_different_address" v-cloak>
    <summary class="checkout__checkbox mb-20">
        <input
            type="checkbox"
            class="checkout__checkbox--input"
            name="ship_to_a_different_address"
            v-model="form.ship_to_a_different_address"
            id="ship-to-different-address"
        >
        <span class="checkout__checkbox--checkmark"></span>
        <label class="checkout__checkbox--label" for="ship-to-different-address">{{ trans('checkout::attributes.ship_to_a_different_address') }}</label>
    </summary>
    <div class="section__shipping--address__content">
        <div class="section__header mb-25">
            <h2 class="section__header--title h3">{{ trans('storefront::checkout.shipping_details') }} </h2>
        </div>
        <div class="select-address" v-if="hasAddress">
            <div class="form-group">
                <div class="form-radio" v-for="address in addresses">
                    <input
                        type="radio"
                        v-model="form.shippingAddressId"
                        :value="address.id"
                        :id="'shipping-address-' + address.id"
                    >

                    <label :for="'shipping-address-' + address.id">
                        <span v-text="address.full_name"></span>
                        <span v-text="address.address_1"></span>
                        <span v-if="address.address_2" v-text="address.address_2"></span>
                        <span>@{{ address.city }}, @{{ address.state_name }} @{{ address.zip }}</span>
                        <span v-text="address.country_name"></span>
                    </label>
                </div>

                <span class="error-message" v-if="! form.newShippingAddress && errors.has('shipping.address_1')">
                            {{ trans('storefront::checkout.you_must_select_an_address') }}
                        </span>
            </div>
        </div>
        <button
            v-if="hasAddress"
            type="button"
            class="btn btn-add-new-address"
            @click="addNewShippingAddress"
        >
            {{ trans('storefront::checkout.add_new_address') }}
        </button>
        <div class="row" v-show="! hasAddress || form.newShippingAddress">
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list ">
                    <label class="checkout__input--label mb-5"
                           for="shipping-first-name">{{ trans('checkout::attributes.shipping.first_name') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="shipping[first_name]"
                        v-model="form.shipping.first_name"
                        id="shipping-first-name"
                        class="checkout__input--field border-radius-5"
                        placeholder="{{ trans('checkout::attributes.shipping.first_name') }}"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('shipping.first_name')"
                        v-text="errors.get('shipping.first_name')"
                    >
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-last-name">
                        {{ trans('checkout::attributes.shipping.last_name') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="shipping[last_name]"
                        v-model="form.shipping.last_name"
                        id="shipping-last-name"
                        class="checkout__input--field border-radius-5" placeholder="Last name"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('shipping.last_name')"
                        v-text="errors.get('shipping.last_name')"
                    >
                    </span>
                </div>
            </div>
            <div class="col-12 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-address-1">
                        {{ trans('checkout::attributes.street_address') }}
                        <span class="checkout__input--label__star">*</span>
                    </label>
                    <input
                        type="text"
                        name="shipping[address_1]"
                        v-model="form.shipping.address_1"
                        id="shipping-address-1"
                        placeholder="{{ trans('checkout::attributes.shipping.address_1') }}"
                        class="checkout__input--field border-radius-5"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('shipping.address_1')"
                        v-text="errors.get('shipping.address_1')"
                    >
                </span>
                </div>
            </div>
            <div class="col-12 mb-20">
                <div class="checkout__input--list">
                    <input
                        type="text"
                        name="shipping[address_2]"
                        v-model="form.shipping.address_2"
                        class="checkout__input--field border-radius-5"
                        placeholder="{{ trans('checkout::attributes.shipping.address_2') }}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-city">
                        {{ trans('checkout::attributes.shipping.city') }}
                        <span class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="shipping[city]"
                        :value="form.shipping.city"
                        id="shipping-city"
                        class="checkout__input--field border-radius-5"
                        @change="changeShippingCity($event.target.value)"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('shipping.city')"
                        v-text="errors.get('shipping.city')"
                    >
                        </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-zip">
                        {{ trans('checkout::attributes.shipping.zip') }}
                        <span class="checkout__input--label__star">*</span></label>
                    <input
                        type="text"
                        name="shipping[zip]"
                        :value="form.shipping.zip"
                        id="shipping-zip"
                        class="checkout__input--field border-radius-5"
                        @change="changeShippingZip($event.target.value)"
                    >
                    <span
                        class="error-message"
                        v-if="errors.has('shipping.zip')"
                        v-text="errors.get('shipping.zip')"
                    >
                        </span>
                </div>
            </div>
            <div class="col-lg-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-country">
                        {{ trans('checkout::attributes.shipping.country') }} <span
                            class="checkout__input--label__star">*</span></label>
                    <div class="checkout__input--select select">
                        <select
                            name="shipping[country]"
                            :value="form.shipping.country"
                            id="shipping-country"
                            class="checkout__input--select__field border-radius-5"
                            @change="changeShippingCountry($event.target.value)"
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
                            v-if="errors.has('shipping.country')"
                            v-text="errors.get('shipping.country')"
                        >
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-20">
                <div class="checkout__input--list">
                    <label class="checkout__input--label mb-5" for="shipping-state">
                        {{ trans('checkout::attributes.shipping.state') }} <span
                            class="checkout__input--label__star">*</span></label>

                    <div class="checkout__input--select select">
                        <input
                            type="text"
                            name="shipping[state]"
                            :value="form.shipping.state"
                            id="shipping-state"
                            class="checkout__input--select__field border-radius-5"
                            v-if="! hasShippingStates"
                            @change="changeShippingState($event.target.value)"
                        >

                        <select
                            name="shipping[state]"
                            v-model="form.shipping.state"
                            id="shipping-state"
                            class="checkout__input--select__field border-radius-5"
                            v-else
                        >
                            <option value="">{{ trans('storefront::checkout.please_select') }}</option>

                            <option
                                v-for="(name, code) in states.shipping"
                                :value="code"
                                v-text="name"
                            >
                            </option>
                        </select>

                        <span
                            class="error-message"
                            v-if="errors.has('shipping.state')"
                            v-text="errors.get('shipping.state')"
                        >
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</details>


{{--<div class="shipping-details">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-18">--}}
{{--            <div class="form-group ship-to-different-address-label">--}}
{{--                <div class="form-check">--}}
{{--                    --}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="ship-to-different-address-form">--}}
{{--                <div class="add-new-address-wrap">--}}

{{--                    <div class="add-new-address-form">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-first-name">--}}
{{--                                        <span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[first_name]"--}}
{{--                                        v-model="form.shipping.first_name"--}}
{{--                                        id="shipping-first-name"--}}
{{--                                        class="form-control"--}}
{{--                                    >--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.first_name')"--}}
{{--                                        v-text="errors.get('shipping.first_name')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-last-name">--}}
{{--                                        {{ trans('checkout::attributes.shipping.last_name') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[last_name]"--}}
{{--                                        v-model="form.shipping.last_name"--}}
{{--                                        id="shipping-last-name"--}}
{{--                                        class="form-control"--}}
{{--                                    >--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.last_name')"--}}
{{--                                        v-text="errors.get('shipping.last_name')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-18">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-address-1">--}}
{{--                                        {{ trans('checkout::attributes.street_address') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[address_1]"--}}
{{--                                        v-model="form.shipping.address_1"--}}
{{--                                        id="shipping-address-1"--}}
{{--                                        class="form-control"--}}
{{--                                        placeholder="{{ trans('checkout::attributes.shipping.address_1') }}"--}}
{{--                                    >--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.address_1')"--}}
{{--                                        v-text="errors.get('shipping.address_1')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}

{{--                                <div class="form-group">--}}
{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[address_2]"--}}
{{--                                        v-model="form.shipping.address_2"--}}
{{--                                        class="form-control"--}}
{{--                                        placeholder="{{ trans('checkout::attributes.shipping.address_2') }}"--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-city">--}}
{{--                                        {{ trans('checkout::attributes.shipping.city') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[city]"--}}
{{--                                        :value="form.shipping.city"--}}
{{--                                        id="shipping-city"--}}
{{--                                        class="form-control"--}}
{{--                                        @change="changeShippingCity($event.target.value)"--}}
{{--                                    >--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.city')"--}}
{{--                                        v-text="errors.get('shipping.city')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-zip">--}}
{{--                                        {{ trans('checkout::attributes.shipping.zip') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[zip]"--}}
{{--                                        :value="form.shipping.zip"--}}
{{--                                        id="shipping-zip"--}}
{{--                                        class="form-control"--}}
{{--                                        @change="changeShippingZip($event.target.value)"--}}
{{--                                    >--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.zip')"--}}
{{--                                        v-text="errors.get('shipping.zip')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-country">--}}
{{--                                        {{ trans('checkout::attributes.shipping.country') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <select--}}
{{--                                        name="shipping[country]"--}}
{{--                                        :value="form.shipping.country"--}}
{{--                                        id="shipping-country"--}}
{{--                                        class="form-control arrow-black"--}}
{{--                                        @change="changeShippingCountry($event.target.value)"--}}
{{--                                    >--}}
{{--                                        <option--}}
{{--                                            v-for="(name, code) in countries"--}}
{{--                                            :value="code"--}}
{{--                                            v-text="name"--}}
{{--                                        >--}}
{{--                                        </option>--}}
{{--                                    </select>--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.country')"--}}
{{--                                        v-text="errors.get('shipping.country')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="shipping-state">--}}
{{--                                        {{ trans('checkout::attributes.shipping.state') }}<span>*</span>--}}
{{--                                    </label>--}}

{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        name="shipping[state]"--}}
{{--                                        :value="form.shipping.state"--}}
{{--                                        id="shipping-state"--}}
{{--                                        class="form-control"--}}
{{--                                        v-if="! hasShippingStates"--}}
{{--                                        @change="changeShippingState($event.target.value)"--}}
{{--                                    >--}}

{{--                                    <select--}}
{{--                                        name="shipping[state]"--}}
{{--                                        v-model="form.shipping.state"--}}
{{--                                        id="shipping-state"--}}
{{--                                        class="form-control arrow-black"--}}
{{--                                        v-else--}}
{{--                                        v-cloak--}}
{{--                                    >--}}
{{--                                        <option value="">{{ trans('storefront::checkout.please_select') }}</option>--}}

{{--                                        <option--}}
{{--                                            v-for="(name, code) in states.shipping"--}}
{{--                                            :value="code"--}}
{{--                                            v-text="name"--}}
{{--                                        >--}}
{{--                                        </option>--}}
{{--                                    </select>--}}

{{--                                    <span--}}
{{--                                        class="error-message"--}}
{{--                                        v-if="errors.has('shipping.state')"--}}
{{--                                        v-text="errors.get('shipping.state')"--}}
{{--                                    >--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
