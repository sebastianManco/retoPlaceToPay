<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings
{
    use exportable;
    public function headings(): array
    {
        return [
            'id',
            'category',
            'name',
            'description',
            'price',
            'stock',
            'status',
            'Date',
        ];
    }


    public function query()
    {
        return Product::query();
    }
}
