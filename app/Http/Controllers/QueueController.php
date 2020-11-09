<?php

namespace App\Http\Controllers;

use App\Jobs\ReportJob;
use App\Mail\DailyReportMail;
use App\Order;
use App\Payment;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QueueController extends Controller
{
   private $user;

    public function __construct( User $user)
    {

        $this->user = $user;
    }
    /**
     * @param Request $request
     */
    public function pruebaColas(Request $request)
    {
        $dateFrom = $request->get('dateFrom');
        $dateTo = $request->get('dateTo');

        $orders = Order::with('user', 'products', 'payment')
            ->data($dateFrom, $dateTo)
            ->get();
        dd($orders);

    }
}
