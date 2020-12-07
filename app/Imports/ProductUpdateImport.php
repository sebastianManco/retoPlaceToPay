<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductUpdateImport implements ToCollection, WithValidation
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::where('id', $row[0])
               ->update([
                   'name' => $row[2],
                   'category_id' => $row[1],
                   'description' => $row[3],
                   'price' => $row[4],
                   'stock' => $row[5]
               ]);
        }
    }

    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'min:1|max:50',
            'description' => 'min:1|max:100',
            'category' => 'numeric',
            'price' => '|numeric|min:1',
            'stock' => 'numeric|min:1'
        ];
    }
}
