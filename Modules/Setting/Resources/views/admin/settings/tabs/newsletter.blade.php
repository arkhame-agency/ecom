<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix m-b-20">
            {{ Form::checkbox('newsletter_enabled', trans('setting::attributes.newsletter_enabled'), trans('setting::settings.form.allow_customers_to_subscribe'), $errors, $settings) }}
        </div>

        <div class="box-content clearfix m-b-20">
            <h5 class="section-title tab-content-title">{{ trans('setting::attributes.newsletter_popup') }}</h5>
            {{ Form::checkbox('newsletter_popup_enabled', trans('setting::attributes.newsletter_popup_enabled'), trans('setting::settings.form.allow_newsletter_popup'), $errors, $settings) }}
            <div class="{{ old('newsletter_popup_enabled', array_get($settings, 'newsletter_popup_enabled')) ? '' : 'hide' }}" id="customer-lastname-fields">
            {{ Form::checkbox('newsletter_last_name_enabled', trans('setting::attributes.newsletter_last_name_enabled'), trans('setting::settings.form.allow_customers_last_name'), $errors, $settings) }}
            </div>
        </div>

        <div class="box-content clearfix m-b-20">
            <h5 class="section-title tab-content-title">{{ trans('setting::attributes.mailchimp_settings') }}</h5>
            {{ Form::password('mailchimp_api_key', trans('setting::attributes.mailchimp_api_key'), $errors, $settings) }}
            {{ Form::text('mailchimp_list_id', trans('setting::attributes.mailchimp_list_id'), $errors, $settings) }}
        </div>
    </div>
</div>
