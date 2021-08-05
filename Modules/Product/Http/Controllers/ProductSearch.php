<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\Attribute;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Events\ShowingProductList;

trait ProductSearch
{
    /**
     * Search products for the request.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function searchProducts(Product $model, ProductFilter $productFilter)
    {
        $productIds = [];

        if (request()->filled('query')) {
            $model = $model->search(request('query'));
            $productIds = $model->keys();
        }

        $query = $model->filter($productFilter);

        if (request()->filled('category')) {
            $productIds = (clone $query)->select('products.id')->resetOrders()->pluck('id');
        }

        if (request()->filled('promotions')) {
            $products = $query->get();
            $newProduct = array();
            /**
             * @var $product Product
             */
            foreach ($products as $product) {
                if ($product->hasSpecialPrice()) {
                    $newProduct[] = $product;
                }
            }
            $products = $this->paginatePromotions($newProduct, request('perPage', 30));
        } else {
            $products = $query->paginate(request('perPage', 30));
        }


        event(new ShowingProductList($products));

        return response()->json([
            'products' => $products,
            'attributes' => $this->getAttributes($productIds),
        ]);
    }

    private function getAttributes($productIds)
    {
        if (!request()->filled('category') || $this->filteringViaRootCategory()) {
            return collect();
        }

        return Attribute::with('values')
            ->where('is_filterable', true)
            ->whereHas('categories', function ($query) use ($productIds) {
                $query->whereIn('id', $this->getProductsCategoryIds($productIds));
            })
            ->get();
    }

    private function filteringViaRootCategory()
    {
        return Category::where('slug', request('category'))
            ->firstOrNew([])
            ->isRoot();
    }

    private function getProductsCategoryIds($productIds)
    {
        return DB::table('product_categories')
            ->whereIn('product_id', $productIds)
            ->distinct()
            ->pluck('category_id');
    }

    /**
     * Set a pagination that will be used for promotions, since paginate function doesn't support Array|Collection;.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int|null $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginatePromotions($items, int $perPage = 15, $page = null, array $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
