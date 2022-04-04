<template>
    <div class="minicart__product--items d-flex">
        <div class="minicart__thumbnail">
            <a :href="productUrl(cartItem.product)">
                <img
                    :src="baseImage(cartItem.product)"
                    :class="{ 'image-placeholder': ! hasBaseImage(cartItem.product) }"
                    alt="product image"
                >
            </a>
        </div>
        <div class="minicart__text">
            <h4 class="minicart__subtitle">
                <a :href="productUrl(cartItem.product)" :title="cartItem.product.name">
                    {{ cartItem.product.name }}
                </a>
            </h4>
            <ul class="minicart__product--variants">
                <li class="minicart__product--variant-item" v-for="option in cartItem.options" :key="option.id">
                    <b>{{ option.name }}:</b> {{ optionValues(option) }}
                </li>
            </ul>
<!--            <div class="minicart__price">-->
<!--                <span class="current__price" v-html="cartItem.unitPrice.inCurrentCurrency.formatted">$125.00</span>-->
<!--                &lt;!&ndash;                <span class="old__price">$140.00</span>&ndash;&gt;-->
<!--            </div>-->
            <div class="minicart__text--footer d-flex align-items-center">
                <div class="quantity__box minicart__quantity">
<!--                    <button type="button" class="quantity__value decrease" aria-label="quantity value"-->
<!--                            :disabled="cartItem.qty == 1" data-type="minus">- -->
<!--                    </button>-->
<!--                    <label>-->
<!--                        <input-->
<!--                            type="number"-->
<!--                            :value="cartItem.qty"-->
<!--                            min="1"-->
<!--                            :max="cartItem.product.manage_stock ? cartItem.product.qty : ''"-->
<!--                            class="quantity__number"-->
<!--                            @input="updateQuantity(cartItem, $event.target.value)"-->
<!--                            @keydown.up="updateQuantity(cartItem, cartItem.qty + 1)"-->
<!--                            @keydown.down="updateQuantity(cartItem, cartItem.qty - 1)"-->
<!--                        >-->
<!--                    </label>-->
<!--                    <button type="button" class="quantity__value increase" aria-label="quantity value" data-type="plus">-->
<!--                        +-->
<!--                    </button>-->
                    <div class="product-quantity">
                        {{ cartItem.qty }} x <span class="current__price" v-html="cartItem.unitPrice.inCurrentCurrency.formatted"></span>
                    </div>
                </div>
                <button class="minicart__product--remove" aria-label="minicart remove btn" @click="remove">
                    {{ $trans('storefront::layout.remove') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import store from '../../store';
import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';

export default {
    mixins: [
        ProductHelpersMixin,
    ],

    props: ['cartItem'],

    methods: {
        optionValues(option) {
            let values = [];

            for (let value of option.values) {
                values.push(value.label);
            }

            return values.join(', ');
        },

        updateQuantity(cartItem, qty) {
            if (qty < 1 || this.exceedsMaxStock(cartItem, qty)) {
                return;
            }

            if (isNaN(qty)) {
                qty = 1;
            }

            this.loadingOrderSummary = true;

            cartItem.qty = qty;

            $.ajax({
                method: 'PUT',
                url: route('cart.items.update', { cartItemId: cartItem.id }),
                data: { qty: qty || 1 },
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },

        exceedsMaxStock(cartItem, qty) {
            return cartItem.product.manage_stock && cartItem.product.qty < qty;
        },

        remove() {

            store.removeCartItem(this.cartItem);

            $.ajax({
                method: 'DELETE',
                url: route('cart.items.destroy', { cartItemId: this.cartItem.id }),
            }).then((cart) => {
                store.updateCart(cart);
            });
        },
    },
};
</script>
