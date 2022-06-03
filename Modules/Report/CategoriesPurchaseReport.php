<?php

namespace Modules\Report;

use Modules\Category\Entities\Category;

class CategoriesPurchaseReport extends Report
{
    protected $date = 'orders.created_at';

    protected function view()
    {
        return 'report::admin.reports.categories_purchase_report.index';
    }

    protected function query()
    {
        return Category::withoutGlobalScope('active')
            ->select('categories.id')
            ->selectRaw('SUM(order_products.qty) as qty')
            ->selectRaw('SUM(order_products.line_total) as total')
            ->join('product_categories', 'product_categories.category_id', '=', 'categories.id')
            ->join('products', 'products.id', '=', 'product_categories.product_id')
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->when(request()->has('category'), function ($query) {
                $query->whereTranslationLike('name', request('category') . '%');
            })
            ->groupBy('categories.id');
    }
}
