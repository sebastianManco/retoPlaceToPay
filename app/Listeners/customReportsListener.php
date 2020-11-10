<?php

namespace App\Listeners;

use App\Events\customReportsEvent;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class customReportsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  customReportsEvent  $event
     * @return void
     */
    public function handle(customReportsEvent $event)
    {
            $dateFrom = $event->dateFrom;
            $dateTo = $event->dateTo;


        $orders = Order::with('user', 'products', 'payment')
            ->dateRange($dateFrom, $dateTo)
            ->get();
        foreach ($orders as $order){
            log::info('reporte personalizado', [ 'usuario'=>$orders[0]->user->name]);
        }


        /*$pdf = PDF::loadView('Reports.customReports');
        return $pdf->download('prueba.pdf');*/
    }
}
