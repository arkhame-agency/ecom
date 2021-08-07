<?php

namespace Themes\Storefront\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequestsPostRequest extends FormRequest
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
            'request_for' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('storefront::requests_form.validation.name'),
            'email.required' => trans('storefront::requests_form.validation.email'),
            'email.email' => 'Should be an email',
            'address.required' => trans('storefront::requests_form.validation.address'),
            'city.required' => trans('storefront::requests_form.validation.city'),
            'postal_code.required' => trans('storefront::requests_form.validation.postal_code'),
            'telephone.required' => trans('storefront::requests_form.validation.telephone'),
            'request_for.required' => 'Should be choose one'
        ];
    }
}
