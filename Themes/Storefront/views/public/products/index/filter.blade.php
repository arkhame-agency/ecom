<div class="single__widget price__filter widget__bg">
    <h2 class="widget__title position__relative h3">{{ trans('storefront::products.price') }}</h2>
    <form class="price__filter--form" @submit.prevent="fetchProducts">
        <div class="price__filter--form__inner mb-15 d-flex align-items-center">
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-GTE1">{{ trans('storefront::products.prices.from') }}</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input
                        type="number"
                        id="Filter-Price-GTE1"
                        class="price__filter--input__field border-0"
                        :value="queryParams.fromPrice"
                        @change="updatePriceRange($event.target.value, null)"
                        ref="fromPrice"
                    >
                </div>
            </div>
            <div class="price__divider">
                <span>-</span>
            </div>
            <div class="price__filter--group">
                <label class="price__filter--label" for="Filter-Price-LTE1">{{ trans('storefront::products.prices.to') }}</label>
                <div class="price__filter--input border-radius-5 d-flex align-items-center">
                    <span class="price__filter--currency">$</span>
                    <input
                        type="number"
                        id="Filter-Price-LTE1"
                        class="price__filter--input__field border-0"
                        :value="queryParams.toPrice"
                        @change="updatePriceRange(null, $event.target.value)"
                        ref="toPrice"
                    >
                </div>
            </div>
        </div>
        <div ref="priceRange" @change="fetchProducts" class="mb-15"></div>
        <button class="price__filter--btn primary__btn" @click="fetchProducts">Filter</button>
    </form>
</div>

<div class="single__widget widget__bg" v-for="attribute in attributeFilters" :key="attribute.id" class="filter-section" v-cloak>
    <h2 class="widget__title position__relative h3" v-text="attribute.name"></h2>
    <ul class="widget__form--check">
        <li class="widget__form--check__list" v-for="value in attribute.values" :key="value.id">
            <label class="widget__form--check__label"  :for="'attribute-' + value.id" v-text="value.value"></label>
            <input class="widget__form--check__input"
                   type="checkbox"
                   :name="attribute.slug"
                   :id="'attribute-' + value.id"
                   :checked="isFilteredByAttribute(attribute.slug, value.value)"
                   @click="toggleAttributeFilter(attribute.slug, value.value)"
            >
            <span class="widget__form--checkmark"></span>
        </li>
    </ul>
</div>
