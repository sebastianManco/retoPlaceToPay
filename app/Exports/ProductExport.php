<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings, ShouldQueue
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

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Product::query();
    }
}
