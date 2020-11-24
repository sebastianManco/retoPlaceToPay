<?php

namespace App\Imports;

use App\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel,  WithHeadingRow, WithValidation
{
    use importable;
    /**
     * @param array $row
     * @return Product
     */
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row['category'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'stock' => $row['stock'],

        ]);
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:50',
            'description' => 'required|min:1|max:100',
            'category' => 'required',
            'price' => 'required||numeric|min:1',
            'stock' => 'required|numeric|min:1'
        ];
    }
}
