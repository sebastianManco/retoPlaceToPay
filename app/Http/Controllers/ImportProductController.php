<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Imports\ProductUpdateImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ProductImport, $file);
        return redirect()->back()->with('productos importados correctamente');
    }

    public function importUpdateProduct(Request $request)
    {
        $file = $request->file('archivo');
        Excel::import(new ProductUpdateImport, $file);
        return redirect()->back()->with('productos importados correctamente');
    }
}
