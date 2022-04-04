<!-- Table items cart -->
<div class="cart__table" v-if="cartIsNotEmpty">
    <table class="cart__table--inner">
        <thead class="cart__table--header">
        <tr class="cart__table--header__items">
            <th class="cart__table--header__list">{{ trans('storefront::cart.table.product_name') }}</th>
            <th class="cart__table--header__list">{{ trans('storefront::cart.table.unit_price') }}</th>
            <th class="cart__table--header__list">{{ trans('storefront::cart.table.quantity') }}</th>
            <th class="cart__table--header__list">{{ trans('storefront::cart.table.line_total') }}</th>
        </tr>
        </thead>
        <tbody class="cart__table--body">
        <tr class="cart__table--body__items" v-for="cartItem in cart.items" :key="cartItem.id">
            <td class="cart__table--body__list">
                <div class="cart__product d-flex align-items-center">
                    <button class="cart__remove--btn" aria-label="search button" type="button" @click="remove(cartItem)">
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px"
                             height="16px">
                            <path
                                d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/>
                        </svg>
                    </button>
                    <div class="cart__thumbnail">
                        <a :href="productUrl(cartItem.product)">
                            <img
                                class="border-radius-5"
                                :src="baseImage(cartItem.product)"
                                :class="{ 'image-placeholder': ! hasBaseImage(cartItem.product) }"
                                alt="product image"
                            >
                        </a>
                    </div>
                    <div class="cart__content">
                        <h4 class="cart__content--title">
                            <a :href="productUrl(cartItem.product)" class="product-name"
                               v-text="cartItem.product.name">
                            </a>
                        </h4>
                        <span class="cart__content--variant" v-for="option in cartItem.options">
                                @{{ option.name }}: @{{ optionValues(option) }}
                            </span>
                    </div>
                </div>
            </td>
            <td class="cart__table--body__list">
                <span class="cart__price" v-html="cartItem.unitPrice.inCurrentCurrency.formatted">$-.--</span>
            </td>
            <td class="cart__table--body__list">
                <div class="quantity__box">
                    <button
                        type="button"
                        class="quantity__value quickview__value--quantity decrease"
                        aria-label="quantity value"
                        value="Decrease Value"
                        data-type="minus"
                    >-
                    </button>
                    <label>
                        <input
                            type="number"
                            :value="cartItem.qty"
                            min="1"
                            :max="cartItem.product.manage_stock ? cartItem.product.qty : ''"
                            class="quantity__number quickview__value--number"
                            @input="updateQuantity(cartItem, $event.target.value)"
                            @keydown.up="updateQuantity(cartItem, cartItem.qty + 1)"
                            @keydown.down="updateQuantity(cartItem, cartItem.qty - 1)"
                        >
                    </label>
                    <button
                        type="button"
                        class="quantity__value quickview__value--quantity increase"
                        aria-label="quantity value"
                        value="Increase Value"
                        data-type="plus"
                    >+
                    </button>
                </div>
            </td>
            <td class="cart__table--body__list">
                <span class="cart__price end" v-html="cartItem.total.inCurrentCurrency.formatted">-.--</span>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="continue__shopping d-flex justify-content-between">
        <a class="continue__shopping--link" href="{{route('products.index')}}">{{ trans('storefront::cart.continue_shopping') }}</a>
        <button class="continue__shopping--clear" @click="clearCart()">{{ trans('storefront::cart.clear_cart') }}</button>
    </div>
</div>
