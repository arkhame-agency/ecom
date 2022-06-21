<?php

namespace Modules\Import\Imports;

use Maatwebsite\Excel\Row;
use Illuminate\Support\Collection;
use Modules\Product\Entities\Product;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements OnEachRow, WithChunkReading, WithHeadingRow
{
    public function chunkSize(): int
    {
        return 200;
    }

    public function onRow(Row $row)
    {
        $product = $this->normalize($row->toArray());

        try {
            Product::where('sku', $product['sku'])->withoutGlobalScope('active')->update($product);
        } catch (QueryException | ValidationException $e) {
            session()->push('importer_errors', $product['sku']);
        }
    }

    public function onRow2(Row $row)
    {
        $data = $this->normalize($row->toArray());

        request()->merge($data);

        try {
            Product::create($data);
        } catch (QueryException | ValidationException $e) {
            session()->push('importer_errors', $row->getIndex());
        }
    }

    // @TODO optimisation des conditions dans cette function
    private function normalize(array $data)
    {
        return array_filter([
            'name' => $data['name'] ?? null,
            'sku' => (string)$data['sku'],
            'description' => $data['description'] ?? null,
            'short_description' => $data['short_description'] ?? null,
            'is_active' => $this->isActive($data),
            'brand_id' => $data['brand'] ?? null,
            'categories' => $this->explode($data['categories'] ?? null),
            'tax_class_id' => $data['tax_class'] ?? null,
            'tags' => $this->explode($data['tags'] ?? null),
            'price' => $data['price'] ?? null,
            'special_price' => $data['special_price'] ?? null,
            'special_price_type' => $data['special_price_type'] ?? null,
            'special_price_start' => $data['special_price_start'] ?? null,
            'special_price_end' => $data['special_price_end'] ?? null,
            'selling_price' => $this->getSellingPrice($data),
            'manage_stock' => $data['manage_stock'] ?? null,
            'qty' => isset($data['quantity']) ? (int)$data['quantity'] : null,
            'in_stock' => $this->inStock($data),
            'new_from' => $data['new_from'] ?? null,
            'new_to' => $data['new_to'] ?? null,
            'up_sells' => $this->explode($data['up_sells'] ?? null),
            'cross_sells' => $this->explode($data['cross_sells'] ?? null),
            'related_products' => $this->explode($data['related_products'] ?? null),
            'files' => $this->normalizeFiles($data),
            'meta' => $this->normalizeMetaData($data),
            'attributes' => $this->normalizeAttributes($data),
            'options' => $this->normalizeOptions($data),
        ], static function ($value, $key) use ($data) {
            if ($key === 'special_price' && isset($data['price']) && !isset($data['special_price'])) {
                return true;
            }
            return $value || is_numeric($value);
        }, ARRAY_FILTER_USE_BOTH);
    }

    private function inStock($data)
    {
        if (isset($data['in_stock'])) {
            return $data['in_stock'];
        }
        if (isset($data['quantity'])) {
            if ($data['quantity'] > 0) {
                return 1;
            }
            if (isset($data['manage_stock'])) {
                if(!$data['manage_stock'] && !$data['quantity']) {
                    return 1;
                }
            }
            return 0;
        }
        return null;
    }

    private function getSellingPrice($data): ?float
    {
        if (isset($data['price']) && !isset($data['special_price'])) {
            return (float)$data['price'];
        }

        if (isset($data['special_price'])) {
            return (float)$data['special_price'];
        }

        return null;

    }

    private function isActive($data): ?int
    {
        if (isset($data['active'])) {
            return $data['active'];
        }
        if (isset($data['price'])) {
            if ((float)$data['price'] > 0) {
                return 1;
            }
            return 0;
        }
        return null;
    }

    private function explode($values)
    {
        if (trim($values) == '') {
            return false;
        }

        return array_map('trim', explode(',', $values));
    }

    private function normalizeFiles(array $data)
    {
        if (is_null($data['base_image'] ?? null)) {
            return false;
        }

        return [
            'base_image' => $data['base_image'],
            'additional_images' => $this->explode($data['additional_images'] ?? null),
        ];
    }

    private function normalizeMetaData($data)
    {
        if (is_null($data['meta_title'] ?? null)) {
            return false;
        }

        return [
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'] ?? null,
        ];

    }

    private function normalizeAttributes(array $data)
    {
        $attributes = [];

        foreach ($this->findAttributes($data) as $attributeNumber => $attributeId) {
            $attributes[] = [
                'attribute_id' => $attributeId,
                'values' => $this->findAttributeValues($data, $attributeNumber),
            ];
        }

        return $attributes;
    }

    private function findAttributes(array $data)
    {
        return collect($data)->filter(function ($value, $column) {
            preg_match('/^attribute_\d$/', $column, $matches);

            return !empty($matches);
        })->filter();
    }

    private function findAttributeValues(array $data, $attributeNumber)
    {
        return collect($data)->filter(function ($value, $column) use ($attributeNumber) {
            return $column === "{$attributeNumber}_values";
        })->map(function ($values) {
            return $this->explode($values);
        })->flatten()->toArray();
    }

    private function normalizeOptions(array $data)
    {
        $options = [];

        foreach ($this->findOptionPrefixes($data) as $optionPrefix) {
            $option = $this->findOptionAttributes($data, $optionPrefix);

            if (is_null($option['name'])) {
                continue;
            }

            $options[] = [
                'name' => $option['name'],
                'type' => $option['type'],
                'is_required' => $option['is_required'],
                'values' => $this->findOptionValues($option),
            ];
        }

        return $options;
    }

    private function findOptionPrefixes(array $data)
    {
        return collect($data)->filter(function ($value, $column) {
            preg_match('/^option_\d_name$/', $column, $matches);

            return !empty($matches);
        })->keys()->map(function ($column) {
            return str_replace('_name', '', $column);
        });
    }

    private function findOptionAttributes(array $data, $optionPrefix)
    {
        return collect($data)->filter(function ($value, $column) use ($optionPrefix) {
            preg_match("/{$optionPrefix}_.*/", $column, $matches);

            return !empty($matches);
        })->mapWithKeys(function ($value, $column) use ($optionPrefix) {
            $column = str_replace("{$optionPrefix}_", '', $column);

            return [$column => $value];
        });
    }

    private function findOptionValues(Collection $option)
    {
        $values = [];

        foreach ($this->findOptionValuePrefixes($option) as $valuePrefix) {
            $value = $this->findOptionValueAttributes($option, $valuePrefix);

            if (is_null($value['label'])) {
                continue;
            }

            $values[] = [
                'label' => $value['label'],
                'price' => $value['price'],
                'price_type' => $value['price_type'],
            ];
        }

        return $values;
    }

    private function findOptionValuePrefixes(Collection $option)
    {
        return $option->filter(function ($value, $column) {
            preg_match('/value_\d_.+/', $column, $matches);

            return !empty($matches);
        })->keys()->map(function ($column) {
            preg_match('/value_\d/', $column, $matches);

            return $matches[0];
        })->unique();
    }

    private function findOptionValueAttributes(Collection $option, $valuePrefix)
    {
        return $option->filter(function ($value, $column) use ($valuePrefix) {
            preg_match("/{$valuePrefix}_.*/", $column, $matches);

            return !empty($matches);
        })->mapWithKeys(function ($value, $column) use ($valuePrefix) {
            $column = str_replace("{$valuePrefix}_", '', $column);

            return [$column => $value];
        })->toArray();
    }
}
