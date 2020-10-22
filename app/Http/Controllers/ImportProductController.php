<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ProductImport, $file);
        return back()->with('productos importados correctamente');
    }
}
