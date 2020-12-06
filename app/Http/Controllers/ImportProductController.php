<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportProduct;
use App\Http\Requests\ImportProductUpdateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\ProductImport;
use App\Imports\ProductUpdateImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(ImportProduct $request): RedirectResponse
    {
        $file = $request->file('file');
        (new ProductImport)->queue($file);
        return redirect()->back()->with('productos importados correctamente');
    }

    /**
     * @param ImportProductUpdateRequest $request
     * @return RedirectResponse
     */
    public function importUpdateProduct(ImportProductUpdateRequest  $request): RedirectResponse
    {
        $file = $request->file('updateFile');
        Excel::import(new ProductUpdateImport, $file);
        return redirect()->back()->with('productos importados correctamente');

    }


}
