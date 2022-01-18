<div class="row">
    <div class="col-md-8 m-b-15">
        Shippo is the best multi-carrier shipping software for e-commerce businesses.
    </div>
    <div class="col-md-8">
        {{ Form::checkbox('shippo_shipping_enabled', trans('setting::attributes.shippo_shipping_enabled'), trans('setting::settings.form.enable_shippo_shipping'), $errors, $settings) }}
        {{ Form::password('shippo_shipping_api_key', trans('setting::attributes.shippo_shipping_api_key'), $errors, $settings, ['required' => true]) }}
    </div>
</div>

