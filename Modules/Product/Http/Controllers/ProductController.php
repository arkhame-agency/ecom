<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Product\Events\ProductViewed;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Middleware\SetProductSortOption;
use Modules\Review\Entities\Review;

class ProductController extends Controller
{
    use ProductSearch;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        return view('public.products.index');
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /**
         * @var $product Product
         */
        $product = Product::findBySlug($slug);

        $routeArray = $product->getUrls();
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $downloadFiles = $product->getDownloadsAttribute();
        $review = $this->getReviewData($product);

        event(new ProductViewed($product));

        return view('public.products.show', compact('routeArray', 'product', 'relatedProducts', 'upSellProducts', 'review', 'downloadFiles'));
    }

    private function getReviewData(Product $product)
    {
        if (!setting('reviews_enabled')) {
            return;
        }

        return Review::countAndAvgRating($product);
    }

    /**
     * Display a listing of promotions.
     *
     * @param string $slug
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function promotions(Product $model, ProductFilter $productFilter)
    {
        request()->merge(['promotions' => true]);

        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        return view('public.products.index', [
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
