<div class="accordion-box-content">
    <div class="tab-content clearfix">
        {{ Form::checkbox('storefront_cross_sell_sidebar_cart_enabled', trans('storefront::attributes.enable_disable'), trans('storefront::storefront.form.enable_cross_sell_sidebar_cart'), $errors, $settings) }}

        <div class="panel-wrap">
            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.product_page_banner'),
                'name' => 'storefront_product_page_banner',
                'banner' => $banner,
            ])
        </div>
    </div>
</div>
