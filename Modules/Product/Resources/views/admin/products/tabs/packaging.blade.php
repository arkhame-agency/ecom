<div class="row">
    <div class="col-md-8">
        <fieldset>
            <legend>{{trans('product::attributes.packaging.legend_dimension')}}</legend>
            {{ Form::text('length', trans('product::attributes.packaging.length'), $errors, $product, ['required' => true]) }}
            {{ Form::text('width', trans('product::attributes.packaging.width'), $errors, $product, ['required' => true]) }}
            {{ Form::text('height', trans('product::attributes.packaging.height'), $errors, $product, ['required' => true]) }}
        </fieldset>
        <fieldset>
            <legend>{{trans('product::attributes.packaging.legend_weight')}}</legend>
            {{ Form::text('weight', trans('product::attributes.packaging.weight'), $errors, $product, ['required' => true]) }}
        </fieldset>
    </div>
</div>
