<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{

    public function model(array $row)
    {
        return new Product([
            'category_id' => $row[0],
            'name' => $row[1],
            'description' => $row[2],
            'price' => $row[3],
            'stock' => $row[4],
        ]);
    }
}
