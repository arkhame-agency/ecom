<div class="row">
    <div class="col-sm-8">
        {{ Form::text('name', trans('user::attributes.roles.name'), $errors, $role, ['required' => true]) }}
        {{ Form::number('global_marge', trans('user::attributes.global_marge'), $errors, $role, ['min' => 0]) }}
        {{ Form::select('increase_or_decrease', trans('user::attributes.increase_or_decrease'), $errors, trans('user::attributes.select_increase_or_decrease'), $role) }}
    </div>
</div>
