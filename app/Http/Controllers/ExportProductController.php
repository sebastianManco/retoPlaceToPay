<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usersActive');
        $this->middleware('verified');
    }

    public function export()
    {
        return Excel::download(new ProductExport(),'Product.xlsx');
    }

}
