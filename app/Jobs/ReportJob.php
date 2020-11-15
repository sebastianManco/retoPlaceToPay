<?php

namespace App\Jobs;

use App\Order;
use App\Pdf as pdfModel;
use App\User;
use Barryvdh\DomPDF\Facade as PDFS;
use App\Mail\DailyReportMail;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReportJob implements  ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $dateFrom, $dateTo, $user;

    /**
     * ReportJob constructor.
     * @param $dateFrom
     * @param $dateTo
     * @param User $user
     */
    public function __construct($dateFrom, $dateTo, User $user)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->user = $user;
    }

    /**
     *
     */
    public function handle()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $user = $this->user;

        $orders = Order::with('user', 'products', 'payment')
            ->dateRange($dateFrom, $dateTo)
            ->get();

        $name = 'report-'. time().'s.pdf';

        $pdf = PDFS::loadView('Reports.customReports', [
            'order' => $orders,
        ])->save(storage_path('app/public/'). $name);

         $user->pdfs()->create([
            'name' => $name,
            'user_id' => $user
        ]);

    }
}
