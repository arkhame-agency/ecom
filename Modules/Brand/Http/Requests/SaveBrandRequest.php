<?php

namespace Modules\Brand\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveBrandRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'brand::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'slug' => ['required'],
        ];
    }
}
