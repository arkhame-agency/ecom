export default {
    methods: {
        productUrl(product) {
            return route('products.show', product.slug);
        },

        hasBaseImage(product) {
            return product.base_image.length !== 0;
        },

        baseImage(product) {
            if (this.hasBaseImage(product)) {
                return product.base_image.path;
            }

            return `${window.FleetCart.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },

        hasAdditionalImages(product) {
            return product.files.length !== 0;
        },

        additionalImages(product) {
            if (this.hasAdditionalImages(product)) {
                return product.files[0].path;
            }

            return `${window.FleetCart.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },
    },
};
