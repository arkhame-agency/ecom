<?php

namespace Modules\Import\Http\Controllers\Admin;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Import\Imports\ProductExport;

class DownloadCsvController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function index()
    {
        $import_types = ['product' => 'products.csv'];

        if (array_key_exists(request('import_type'), $import_types)) {
            return Excel::download(new ProductExport, 'product.csv', \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
            ]);
        }
    }
}
