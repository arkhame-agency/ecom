{{ Form::text('name', trans('brand::attributes.name'), $errors, $brand, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('presentation', trans('brand::attributes.presentation'), $errors, $brand, ['labelCol' => 2]) }}
<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('is_active', trans('brand::attributes.is_active'), trans('brand::brands.form.enable_the_brand'), $errors, $brand) }}
    </div>
</div>
