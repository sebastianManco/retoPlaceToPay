<?php

namespace App\Http\Controllers;

use App\Jobs\ReportJob;
use App\Order;
use App\Pdf;
use App\Pdf as pdfModel;
use App\User;
use Barryvdh\DomPDF\Facade as PDFS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReportController extends Controller
{
    private $user;

    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function customReport(Request $request): RedirectResponse
    {
        $user = User::find(auth()->id());
        $dateFrom = $request->get('dateFrom');
        $dateTo = $request->get('dateTo');

        dispatch(new reportJob($dateFrom, $dateTo, $user));

        return redirect(url('/businessManagement'));
    }

    /**
     * @return View
     */
    public function show(): View
    {
        $idUser = auth()->id();
        $pdf = Pdf::with('user')
            ->where('user_id', '=', $idUser)
            ->get();

        return view('Reports.indexReportsPdf', [
            'pdf' => $pdf
        ]);
    }
}
