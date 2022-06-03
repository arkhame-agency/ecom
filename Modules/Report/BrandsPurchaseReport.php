<?php

namespace Modules\Report;

use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;

class BrandsPurchaseReport extends Report
{

    protected function view()
    {
        return 'report::admin.reports.brands_purchase_report.index';
    }

    protected function query()
    {
        return Brand::withoutGlobalScope('active')
            ->select('brands.id')
            ->selectRaw('SUM(order_products.qty) as qty')
            ->selectRaw('SUM(order_products.line_total) as total')
            ->join('products', 'brand_id', '=', 'brands.id')
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->when(request()->has('brand'), function ($query) {
                $query->whereTranslationLike('name', request('brand') . '%');
            })
            ->groupBy('brands.id');
    }
}
