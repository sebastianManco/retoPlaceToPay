<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use Illuminate\Http\Response;

class ExportProductController extends Controller
{
    /**
     * @param ProductExport $productExport
     * @return Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(ProductExport $productExport)
    {
        return $productExport->download( 'Product.xlsx');
    }

}
