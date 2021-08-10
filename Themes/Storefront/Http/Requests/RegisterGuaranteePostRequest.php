<?php

namespace Themes\Storefront\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterGuaranteePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'telephone' => 'required',
            'province' => 'required|not_in:0',
            'make' => 'required',
            'model' => 'required',
            'serial_number' => 'required',
            'date_of_purchase' => 'required|date',
            'invoice_number' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('storefront::guarantee_form.validation.name'),
            'email.required' => trans('storefront::guarantee_form.validation.email'),
            'email.email' => 'Should be an email',
            'address.required' => trans('storefront::guarantee_form.validation.address'),
            'city.required' => trans('storefront::guarantee_form.validation.city'),
            'postal_code.required' => trans('storefront::guarantee_form.validation.postal_code'),
            'telephone.required' => trans('storefront::guarantee_form.validation.telephone'),
            'province.required' => trans('storefront::guarantee_form.validation.province'),
            'make.required' => trans('storefront::guarantee_form.validation.make'),
            'model.required' => trans('storefront::guarantee_form.validation.model'),
            'serial_number.required' => trans('storefront::guarantee_form.validation.serial_number'),
            'date_of_purchase.required' => trans('storefront::guarantee_form.validation.date_of_purchase'),
            'invoice_number.required' => trans('storefront::guarantee_form.validation.invoice_number'),
        ];
    }
}
