<template>
  <!-- Start product section -->
  <section class="product__section section--padding pt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-12 product__col--width__8">
          <vertical-products
              :title="data.vertical_products_1_title"
              :url="route('storefront.vertical_products.index', { columnNumber: 1 })"
          ></vertical-products>
        </div>
        <div class="col-xl-4 offset-xl-0 col-lg-6 offset-lg-3 col-md-8  product__col--width__4">
          <flash-sale
              :title="data.flash_sale_title"
              :url="route('storefront.flash_sale_products.index')"
          >
          </flash-sale>
        </div>
      </div>
    </div>
  </section>
  <!-- End product section -->
</template>

<script>
export default {
  props: ['data'],
};
</script>
