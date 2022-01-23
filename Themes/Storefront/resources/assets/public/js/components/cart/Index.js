import store from '../../store';
import CartHelpersMixin from '../../mixins/CartHelpersMixin';
import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';
import Errors from '../../Errors';

export default {
    mixins: [
        CartHelpersMixin,
        ProductHelpersMixin,
    ],

    props: ['countries'],

    data() {
        return {
            shippingMethodName: null,
            crossSellProducts: [],
            form: {
                shipping: {},
                cart: {},
            },
            states: {
                shipping: {},
            },
            errors: new Errors(),
        };
    },


    watch: {
        'form.shipping.zip': function (newZip) {
            if (newZip) {
                this.loadingOrderSummary = true;
                this.getRates();
            }
        },
    },

    computed: {
        hasAnyCrossSellProduct() {
            return this.crossSellProducts.length !== 0;
        },
        hasShippingStates() {
            return Object.keys(this.states.shipping).length !== 0;
        },
        firstCountry() {
            return Object.keys(this.countries)[0];
        },
    },

    created() {
        this.$nextTick(() => {
            if (this.firstShippingMethod) {
                this.updateShippingMethod(this.firstShippingMethod);
            }

            this.fetchCrossSellProducts();
        });
    },

    methods: {

        hasShippingAddress() {
            return Object.keys(this.form.shipping).length !== 0;
        },

        changeShippingState(state) {
            this.$set(this.form.shipping, 'state', state);
        },

        changeShippingZip(zip) {
            this.$set(this.form.shipping, 'zip', zip);
        },

        changeShippingCountry(country) {
            this.$set(this.form.shipping, 'country', country);

            this.fetchStates(country, (states) => {
                this.loadingOrderSummary = false;
                this.$set(this.states, 'shipping', states);
                this.$set(this.form.shipping, 'state', '');
            });
        },

        fetchStates(country, callback) {
            this.loadingOrderSummary = true;
            $.ajax({
                method: 'GET',
                url: route('countries.states.index', { code: country }),
            }).then(callback);
        },

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
                if (this.hasShippingAddress()) {
                    this.loadingOrderSummary = true;
                    this.getRates();
                }
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                if (! this.hasShippingAddress()) {
                    this.loadingOrderSummary = false;
                }
            });
        },

        exceedsMaxStock(cartItem, qty) {
            return cartItem.product.manage_stock && cartItem.product.qty < qty;
        },

        remove(cartItem) {
            this.loadingOrderSummary = true;

            store.removeCartItem(cartItem);

            if (store.cartIsEmpty()) {
                this.crossSellProducts = [];
            }

            $.ajax({
                method: 'DELETE',
                url: route('cart.items.destroy', { cartItemId: cartItem.id }),
            }).then((cart) => {
                store.updateCart(cart);
                if (! store.cartIsEmpty() && this.hasShippingStates) {
                    this.loadingOrderSummary = true;
                    this.getRates();
                }
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                if (! this.hasShippingStates) {
                    this.loadingOrderSummary = false;
                }
            });
        },

        clearCart() {
            store.clearCart();

            if (store.cartIsEmpty()) {
                this.crossSellProducts = [];
            }

            $.ajax({
                method: 'POST',
                url: route('cart.clear.store'),
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },

        changeShippingMethod(shippingMethod) {
            this.shippingMethodName = shippingMethod.name ? this.cart.availableShippingMethods[shippingMethod.name].name : this.cart.availableShippingMethods[this.firstShippingMethod].name;
        },

        fetchCrossSellProducts() {
            $.ajax({
                method: 'GET',
                url: route('cart.cross_sell_products.index'),
            }).then((crossSellProducts) => {
                this.crossSellProducts = crossSellProducts.filter((product, pos, arr) => {
                    return arr.map(mapProduct => mapProduct.id).indexOf(product.id) === pos;
                });
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },
    },
};
