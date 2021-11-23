import store from '../../store';
import SidebarCartItem from './SidebarCartItem.vue';

export default {
    components: { SidebarCartItem },

    data() {
        return {
            crossSellProducts: [],
        };
    },

    created() {
        this.$root.$refs.sidebarcart = this;
        this.fetchCrossSellProducts();
    },

    computed: {
        cart() {
            return store.state.cart;
        },

        cartIsEmpty() {
            return store.cartIsEmpty();
        },

        cartIsNotEmpty() {
            return ! store.cartIsEmpty();
        },

        hasAnyCrossSellProduct() {
            return this.crossSellProducts.length !== 0;
        },
    },

    methods: {

        fetchCrossSellProducts() {
            this.crossSellProducts = [];
            $.ajax({
                method: 'GET',
                url: route('cart.cross_sell_products.index'),
            }).then((crossSellProducts) => {
                this.crossSellProducts = crossSellProducts;
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },
    },
};
