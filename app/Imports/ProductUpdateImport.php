<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProductUpdateImport implements ToCollection
{

    /**
     * @param Collection $rows
     * @return
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
           Product::where('id', $row[0])->update([
                    'category_id' => $row[1],
                   'name' => $row[2],
                    'description' => $row[3],
                    'price' => $row[4],
                   'stock' => $row[5]
                ]);
        }
    }
}
