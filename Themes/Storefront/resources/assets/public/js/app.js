require('./storefront');

import Vue from 'vue';
import store from './store';
import { notify, trans, chunk } from './functions';
import VueToast from 'vue-toast-notification';
import vClickOutside from 'v-click-outside';
import VPagination from './components/VPagination.vue';
import HeaderSearch from './components/layout/HeaderSearch.vue';
import SidebarCart from './components/layout/SidebarCart';
import NewsletterPopup from './components/layout/NewsletterPopup';
import NewsletterSubscription from './components/layout/NewsletterSubscription';
import CookieBar from './components/layout/CookieBar';
import LandscapeProducts from './components/LandscapeProducts.vue';
import DynamicTab from './components/home/DynamicTab';
import HomeFeatures from './components/home/HomeFeatures.vue';
import FeaturedCategories from './components/home/FeaturedCategories.vue';
import BannerThreeColumnFullWidth from './components/home/BannerThreeColumnFullWidth.vue';
import ProductTabsOne from './components/home/ProductTabsOne.vue';
import TopBrands from './components/home/TopBrands.vue';
import FlashSaleAndVerticalProducts from './components/home/FlashSaleAndVerticalProducts.vue';
import FlashSale from './components/home/FlashSale.vue';
import BannerTwoColumn from './components/home/BannerTwoColumn.vue';
import VerticalProducts from './components/home/VerticalProducts.vue';
import ProductGrid from './components/home/ProductGrid.vue';
import BannerThreeColumn from './components/home/BannerThreeColumn.vue';
import ProductTabsTwo from './components/home/ProductTabsTwo.vue';
import BannerOneColumn from './components/home/BannerOneColumn.vue';
import ProductIndex from './components/products/Index';
import ProductCardGridView from './components/products/index/ProductCardGridView.vue';
import ProductCardListView from './components/products/index/ProductCardListView.vue';
import ProductCardVertical from './components/ProductCardVertical.vue';
import ProductShow from './components/products/Show';
import CartIndex from './components/cart/Index';
import CheckoutCreate from './components/checkout/Create';
import CompareIndex from './components/compare/Index';
import MyWishlist from './components/account/wishlist/Index';
import MyAddresses from './components/account/addresses/Index';

Vue.prototype.route = route;
Vue.prototype.$notify = notify;
Vue.prototype.$trans = trans;
Vue.prototype.$chunk = chunk;

Vue.use(VueToast);
Vue.use(vClickOutside);

Vue.component('v-pagination', VPagination);
Vue.component('header-search', HeaderSearch);
Vue.component('sidebar-cart', SidebarCart);
Vue.component('newsletter-popup', NewsletterPopup);
Vue.component('newsletter-subscription', NewsletterSubscription);
Vue.component('cookie-bar', CookieBar);
Vue.component('landscape-products', LandscapeProducts);
Vue.component('dynamic-tab', DynamicTab);
Vue.component('home-features', HomeFeatures);
Vue.component('featured-categories', FeaturedCategories);
Vue.component('banner-three-column-full-width', BannerThreeColumnFullWidth);
Vue.component('product-tabs-one', ProductTabsOne);
Vue.component('top-brands', TopBrands);
Vue.component('flash-sale-and-vertical-products', FlashSaleAndVerticalProducts);
Vue.component('flash-sale', FlashSale);
Vue.component('banner-two-column', BannerTwoColumn);
Vue.component('vertical-products', VerticalProducts);
Vue.component('product-grid', ProductGrid);
Vue.component('banner-three-column', BannerThreeColumn);
Vue.component('product-tabs-two', ProductTabsTwo);
Vue.component('banner-one-column', BannerOneColumn);
Vue.component('product-index', ProductIndex);
Vue.component('product-card-grid-view', ProductCardGridView);
Vue.component('product-card-list-view', ProductCardListView);
Vue.component('product-card-vertical', ProductCardVertical);
Vue.component('product-show', ProductShow);
Vue.component('cart-index', CartIndex);
Vue.component('checkout-create', CheckoutCreate);
Vue.component('compare-index', CompareIndex);
Vue.component('my-wishlist', MyWishlist);
Vue.component('my-addresses', MyAddresses);

new Vue({
    el: '#app',

    computed: {
        cart() {
            return store.state.cart;
        },

        wishlistCount() {
            return store.wishlistCount();
        },
    },
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': FleetCart.csrfToken,
    },
});

$(function () {
    $('#register-form #validate-email, #register-form #email').on('change', function (e) {
        $('#email, #validate-email').siblings('.error-message').remove();
        $('#email, #validate-email').removeClass('is-invalid');
        if ($('#validate-email').val() !== '') {
            if ($(this).val() !== $('#email').val() || $(this).val() !== $('#validate-email').val()) {
                $('#email, #validate-email').addClass('is-invalid');
                $('#email, #validate-email').after('<span class="error-message">' + trans('auth::validation.email') + '</span>');
            } else {
                $('#email, #validate-email').removeClass('is-invalid');
                $('#email, #validate-email').siblings('.error-message').remove();
            }
        }
    });
    $('#register-form #confirm-password, #register-form #password').on('change', function () {
        $('#password, #confirm-password').siblings('.error-message').remove();
        $('#password, #confirm-password').removeClass('is-invalid');
        if ($('#confirm-password').val() !== '') {
            if ($(this).val() !== $('#password').val() || $(this).val() !== $('#confirm-password').val()) {
                $('#password, #confirm-password').addClass('is-invalid');
                $('#password, #confirm-password').after('<span class="error-message">' + trans('auth::validation.confirmed') + '</span>');
            } else {
                $('#password, #confirm-password').removeClass('is-invalid');
                $('#password, #confirm-password').siblings('.error-message').remove();
            }
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-top').fadeIn();
        } else {
            $('.back-top').fadeOut();
        }
    });

    // scroll body to 0px on click
    $('.back-top').click(function () {
        $('body,html').animate({
            scrollTop: 0,
        }, 1600);
        return false;
    });
});
