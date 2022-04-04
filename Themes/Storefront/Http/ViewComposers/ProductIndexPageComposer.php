<?php

namespace Themes\Storefront\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Modules\Product\Entities\SearchTerm;
use Modules\Support\Money;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class ProductIndexPageComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->categories(),
            'maxPrice' => $this->maxPrice(),
            'mostSearchedKeywords' => $this->getMostSearchedKeywords(),
            'latestProducts' => $this->latestProducts(),
        ]);
    }

    private function categories()
    {
        return Category::tree();
    }

    private function maxPrice()
    {
        return Money::inDefaultCurrency(Product::max('selling_price'))
            ->convertToCurrentCurrency()
            ->ceil()
            ->amount();
    }

    private function latestProducts()
    {
        return Product::forCard()->take(5)->latest()->get()->map->clean();
    }

    private function getMostSearchedKeywords()
    {
        return Cache::remember('most_searched_keywords', now()->addHour(), function () {
            return SearchTerm::select('term')->orderByDesc('hits')->take(5)->pluck('term');
        });
    }
}
