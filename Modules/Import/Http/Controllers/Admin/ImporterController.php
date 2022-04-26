<?php

namespace Modules\Import\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Excel;
use Modules\Import\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;
use Modules\Import\Http\Requests\StoreImporterRequest;
use Modules\Product\Entities\Product;

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
        foreach (Product::query()->get() as $product) {
            $product->updateQuietly([
                'price' => $this->finalPrice($product->price->amount()),
                'selling_price' => $this->finalPrice($product->selling_price->amount()),
            ]);
        }
        return back()->with('success', trans('import::messages.update_prices_has_been_run_successfully'));
    }

    public function indexUpdatePrices()
    {
        return view('import::admin.importer.updatePrices');
    }

    private function finalPrice($price)
    {
        if (request()->increase_or_decrease === '1') {
            return ((request()->marge / 100) * $price) + $price;
        }
        return $price - ((request()->marge / 100) * $price);
    }

    private function explode($values)
    {
        if (trim($values) == '') {
            return false;
        }

        return array_map('trim', explode(',', $values));
    }
}
