<?php

namespace Modules\Import\Imports;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Product\Entities\Product;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductExport implements FromCollection, FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{

    public function collection()
    {
        return Product::all();
    }

    public function query()
    {
        return Product::query();
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Quantity',
            'Price',
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->sku,
            $product->qty,
            $product->price,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
