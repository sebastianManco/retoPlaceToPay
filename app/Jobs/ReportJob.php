<?php

namespace App\Jobs;

use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\DailyReportMail;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $dateFrom, $dateTo;

    /**
     * Create a new job instance.
     * @param string $dateForm,
     * @param $dateTo,
     */
    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;

        $orders = Order::with('user', 'products', 'payment')
            ->dateRange($dateFrom, $dateTo)
            ->get();

        $pdf = PDF::loadView('Reports.customReports');
         return $pdf->download('prueba.pdf');


    }
}
