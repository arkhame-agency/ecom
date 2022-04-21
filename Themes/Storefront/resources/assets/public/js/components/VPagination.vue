<template>
    <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
        <li class="pagination__list" :class="{ disabled: hasFirst }">
            <a class="pagination__item--arrow  link" :disabled="hasFirst" @click="prev">
              <svg xmlns="http://www.w3.org/2000/svg" width="22.51"
                   height="20.443"
                   viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="48"
                      d="M244 400L100 256l144-144M120 256h292"/>
              </svg>
            </a>
        </li>

        <li v-show="rangeFirstPage !== 1" class="pagination__list">
            <button class="pagination__item" @click="goto(1)">
                1
            </button>
        </li>

        <li v-show="rangeFirstPage === 3" class="pagination__list">
            <button class="pagination__item" @click="goto(2)">
                2
            </button>
        </li>

        <li
            v-show="rangeFirstPage !== 1 && rangeFirstPage !== 2 && rangeFirstPage !== 3"
            class="pagination__list disabled"
        >
            <span class="pagination__item">...</span>
        </li>

        <li
            v-for="page in range"
            :key="page"
            class="pagination__list"
        >
            <button class="pagination__item" @click="goto(page)" :class="{ 'pagination__item--current': hasActive(page) }">
                {{ page }}
            </button>
        </li>

        <li
            v-show="rangeLastPage !== totalPage && rangeLastPage !== (totalPage - 1) && rangeLastPage !== (totalPage - 2)"
            class="pagination__list disabled"
        >
            <span class="pagination__item">...</span>
        </li>

        <li v-show="rangeLastPage === (totalPage - 2)" class="pagination__list">
            <button class="pagination__item" @click="goto(totalPage - 1)">
                {{ totalPage - 1 }}
            </button>
        </li>

        <li v-if="rangeLastPage !== totalPage" class="pagination__list">
            <button class="pagination__item" @click="goto(totalPage)">
                {{ totalPage }}
            </button>
        </li>

        <li class="pagination__list" :class="{ disabled: hasLast }">
            <a class="pagination__item--arrow link" :class="{ disabled: hasLast }" @click="next">
              <svg xmlns="http://www.w3.org/2000/svg" width="22.51"
                   height="20.443"
                   viewBox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="48"
                      d="M268 112l144 144-144 144M392 256H100"/>
              </svg>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            totalPage: Number,
            currentPage: Number,
            rangeMax: {
                type: Number,
                default: 3,
            },
        },

        mounted() {
            if (this.currentPage > this.totalPage) {
                this.$emit('page-changed', this.totalPage);
            }
        },

        computed: {
            rangeFirstPage() {
                if (this.currentPage === 1) {
                    return 1;
                }

                if (this.currentPage === this.totalPage) {
                    if ((this.totalPage - this.rangeMax) < 0) {
                        return 1;
                    }

                    return this.totalPage - this.rangeMax + 1;
                }

                return this.currentPage - 1;
            },

            rangeLastPage() {
                return Math.min(this.rangeFirstPage + this.rangeMax - 1, this.totalPage);
            },

            range() {
                let rangeList = [];

                for (let page = this.rangeFirstPage; page <= this.rangeLastPage; page += 1) {
                    rangeList.push(page);
                }

                return rangeList;
            },

            hasFirst() {
                return this.currentPage === 1;
            },

            hasLast() {
                return this.currentPage === this.totalPage;
            },
        },

        methods: {
            prev() {
                this.scrollTopSearch(this.$parent.$refs.productsearchwrap);
                this.$emit('page-changed', this.currentPage - 1);
            },

            next() {
                this.scrollTopSearch(this.$parent.$refs.productsearchwrap);
                // this.$parent.$refs.productSearchWrap.scrollIntoView();
                this.$emit('page-changed', this.currentPage + 1);
            },

            goto(page) {
                this.scrollTopSearch(this.$parent.$refs.productsearchwrap);
                // this.$parent.$refs.productSearchWrap.scrollIntoView();
                if (this.currentPage !== page) {
                    this.$emit('page-changed', page);
                }
            },

            hasActive(page) {
                return page === this.currentPage;
            },

            scrollTopSearch(element) {
                let headerOffset = 110;
                let elementPosition = element.getBoundingClientRect().top;
                let offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                });
            },
        },
    };
</script>
