<?php

namespace App\Http\Controllers;

use App\Events\customReportsEvent;
use App\Jobs\ReportJob;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


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
    public function customReport(Request $request)
    {


        $dateFrom = $request->get('dateFrom');
        $dateTo = $request->get('dateTo');

        event(new customReportsEvent($dateFrom, $dateTo));

    }
}
