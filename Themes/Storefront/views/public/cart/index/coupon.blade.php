<h3 class="coupon__code--title">Coupon</h3>
<p class="coupon__code--desc">{{ trans('storefront::cart.enter_coupon_code_if_you_have_one') }}</p>
<div class="coupon__code--field d-flex ">
    <form @submit.prevent="applyCoupon">
        <input
            class="coupon__code--field__input border-radius-5"
            type="text"
            v-model="couponCode"
            placeholder="{{ trans('storefront::cart.enter_coupon_code') }}"
            @input="couponError = null"
        >
        <button
            class="coupon__code--field__btn primary__btn"
            :class="{ 'btn-loading': applyingCoupon }"
            type="submit"
        >
            {{ trans('storefront::cart.apply_coupon') }}
        </button>
        <span
            class="error-message"
            v-if="couponError"
            v-text="couponError"
        >
                </span>
    </form>
</div>
