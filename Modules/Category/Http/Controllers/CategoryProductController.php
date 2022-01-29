<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Modules\Category\Entities\Category;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Controllers\ProductSearch;

class CategoryProductController
{
    use ProductSearch;

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Product $model, ProductFilter $productFilter)
    {
        request()->merge(['category' => $slug]);

        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        $category = Category::findBySlug($slug);

        return view('public.products.index', [
            'categoryName' => $category->name,
            'categoryBanner' => $category->banner->path,
            'routeArray' => $category->getUrls(),
            'logo' => $this->getHeaderLogo(),
        ]);
    }

    private function getHeaderLogo()
    {
        return $this->getMedia(setting('storefront_header_logo'))->path;
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }
}
