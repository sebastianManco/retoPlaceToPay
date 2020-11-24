<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\ProductImport;
use App\Imports\ProductUpdateImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportRequest $request)
    {

        $file = $request->file('file');
        (new ProductImport)->queue($file);
        return redirect()->back()->with('productos importados correctamente');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importUpdateProduct(Request $request)
    {
        $file = $request->file('archivo');
        Excel::import(new ProductUpdateImport, $file);
        return redirect()->back()->with('productos importados correctamente');
    }
}
