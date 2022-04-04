<div class="order-notes mb-20">
    <label class="checkout__input--label mb-5" for="order-note">
        {{ trans('checkout::attributes.order_note') }}<span class="checkout__input--label__star">*</span></label>
    <textarea
        name="order_note"
        v-model="form.order_note"
        cols="30"
        rows="4"
        id="order-note"
        class="checkout__notes--textarea__field border-radius-5"
        placeholder="{{ trans('storefront::checkout.special_note_for_delivery') }}"
        spellcheck="false">
    </textarea>
</div>
