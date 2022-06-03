<div class="row">
    <div class="col-md-8 m-b-15">
        Shippo is the best multi-carrier shipping software for e-commerce businesses.
    </div>
    <div class="col-md-8">
        {{ Form::checkbox('shippo_shipping_enabled', trans('setting::attributes.shippo_shipping_enabled'), trans('setting::settings.form.enable_shippo_shipping'), $errors, $settings) }}
        {{ Form::password('shippo_shipping_api_key', trans('setting::attributes.shippo_shipping_api_key'), $errors, $settings, ['required' => true]) }}
        {{ Form::number('shippo_profit_margin', trans('setting::attributes.shippo_profit_margin'), $errors, $settings, ['min' => 0]) }}
        {{ Form::select('shippo_profit_margin_type', trans('setting::attributes.shippo_profit_margin_type'), $errors, trans('setting::attributes.shippo_profit_margin_types'), $settings) }}
    </div>
</div>

