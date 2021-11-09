<div class="row">
    <div class="col-md-8">
        {{ Form::text('length', trans('product::attributes.length'), $errors, $product, []) }}
        {{ Form::text('weight', trans('product::attributes.weight'), $errors, $product, []) }}
        {{ Form::text('width', trans('product::attributes.width'), $errors, $product, []) }}
        {{ Form::text('height', trans('product::attributes.height'), $errors, $product, []) }}
    </div>
</div>
