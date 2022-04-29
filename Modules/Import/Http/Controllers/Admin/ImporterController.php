<?php

namespace Modules\Import\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Excel;
use Modules\Import\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;
use Modules\Import\Http\Requests\StoreImporterRequest;
use Modules\Product\Entities\Product;
use Modules\Support\Money;

class ImporterController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('import::admin.importer.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreImporterRequest $request
     * @return RedirectResponse
     */
    public function store(StoreImporterRequest $request): RedirectResponse
    {
        @set_time_limit(0);

        $importers = ['product' => ProductImport::class];

        ExcelFacade::import(new $importers[$request->import_type], $request->file('csv_file'), null, Excel::CSV);

        if (session()->has('importer_errors')) {
            return back()->with('error', trans('import::messages.there_was_an_error_on_rows', [
                'rows' => implode(', ', session()->pull('importer_errors', [])),
            ]));
        }

        return back()->with('success', trans('import::messages.the_importer_has_been_run_successfully'));
    }

    public function updatePrices()
    {
        /**
         * @var Product $product
         */
        foreach (Product::query()->get() as $product) {
            if ($product->hasSpecialPrice() && !$product->hasPercentageSpecialPrice()) {
                $prices = [
                    'price' => $this->finalPrice($product->price->amount()),
                    'special_price' => $this->finalPrice($product->getSpecialPrice()->amount()),
                    'selling_price' => $this->finalPrice($product->selling_price->amount()),
                ];
            } else {
                $prices = [
                    'price' => $this->finalPrice($product->price->amount()),
                    'selling_price' => $this->finalPrice($product->selling_price->amount()),
                ];
            }
            $product->updateQuietly($prices);
        }
        return back()->with('success', trans('import::messages.update_prices_has_been_run_successfully'));
    }

    public function indexUpdatePrices()
    {
        return view('import::admin.importer.updatePrices');
    }

    private function finalPrice($price)
    {
        $marge = (request()->marge / 100) * $price;

        if (request()->increase_or_decrease === '1') {
            return $price + $marge;
        }
        return $price - $marge;
    }

    private function explode($values)
    {
        if (trim($values) == '') {
            return false;
        }

        return array_map('trim', explode(',', $values));
    }
}
