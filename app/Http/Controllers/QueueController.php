<?php

namespace App\Http\Controllers;

use App\Jobs\ReportJob;
use App\Mail\DailyReportMail;
use App\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QueueController extends Controller
{
    /**
     * @param Request $request
     */
    public function pruebaColas(Request $request)
    {
        Mail::to($request->user()->email)
            ->queue(new DailyReportMail());


    }
}
