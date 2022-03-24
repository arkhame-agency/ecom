export default {
    data() {
        return {
            tabs: [],
            activeTab: null,
            loading: false,
            products: [],
        };
    },

    mounted() {
        this.tabs = this.$children.filter((component) => {
            return component.$options.name === 'DynamicTab';
        });

        // Show the first tab by default on page load.
        this.change(this.tabs[0]);
    },

    methods: {
        classes(tab) {
            return {
                'product__tab--btn__list': true,
                loading: this.activeTab === tab && this.loading,
                active: this.activeTab === tab && ! this.loading,
            };
        },
        title(tab) {
            return tab.label;
        },

        change(activeTab) {
            if (this.activeTab === activeTab) {
                return;
            }

            this.loading = true;
            this.activeTab = activeTab;

            $.ajax({
                method: 'GET',
                url: activeTab.url,
            }).then((products) => {
                if (this.selector().hasClass('slick-initialized')) {
                    this.selector().slick('unslick');
                }

                this.products = products;
                this.loading = false;

                this.$nextTick(() => {
                    this.selector().slick(this.slickOptions());
                });
            });
        },
    },
};
