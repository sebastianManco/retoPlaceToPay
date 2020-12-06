<?php

namespace App\Jobs;

use App\Order;
use App\User;
use Barryvdh\DomPDF\Facade as PDFS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    private $dateFrom;
    private $dateTo;
    private $user;

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

        $name = 'report-' . time() . 's.pdf';

        $pdf = PDFS::loadView('Reports.customReports', [
            'order' => $orders,
        ])->save(storage_path('app/pdf/') . $name);

         $user->pdfs()->create([
            'name' => $name,
            'user_id' => $user
         ]);

         Log::info('documento generado ');
    }
}
