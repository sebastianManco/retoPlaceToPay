<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;

class ExportProductController extends Controller
{

    public function export(ProductExport $productExport)
    {
        return $productExport->download( 'Product.xlsx');
    }

}
