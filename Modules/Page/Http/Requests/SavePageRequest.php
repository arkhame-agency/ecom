<?php

namespace Modules\Page\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SavePageRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var array
     */
    protected $availableAttributes = 'page::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'required',
            'name' => 'required',
            'body' => 'required',
            'is_active' => 'required|boolean',
        ];
    }
}
