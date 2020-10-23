<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{

    public function model(array $row)
    {
        return new Product([
            'category_id' => $row[1],
            'name' => $row[2],
            'description' => $row[3],
            'price' => $row[4],
            'stock' => $row[5],
        ]);
    }
}
