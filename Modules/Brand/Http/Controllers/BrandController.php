<?php

namespace Modules\Brand\Http\Controllers;

use Modules\Brand\Entities\Brand;
use Modules\Brand\Entities\BrandTranslation;

class BrandController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.brands.index', [
            'brands' => Brand::all()->SortBy('name'),
            'routeArray' => $this->getUrl(),

        ]);
    }

    public function getUrl()
    {
        $routeArray = [];
        foreach (supported_locales() as $locale => $language) {
            $routeArray[$locale] = trans('brand::routes.brands', [], $locale);
        }
        return $routeArray;
    }
}
