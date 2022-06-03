<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('commercial_shipping_enabled', trans('setting::attributes.commercial_shipping_enabled'), trans('setting::settings.form.enable_commercial_shipping'), $errors, $settings) }}
        {{ Form::text('translatable[commercial_shipping_label]', trans('setting::attributes.translatable.commercial_shipping_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::number('commercial_shipping_cost', trans('setting::attributes.commercial_shipping_cost'), $errors, $settings, ['min' => 0, 'required' => true]) }}
    </div>
</div>

