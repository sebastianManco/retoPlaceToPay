<?php

namespace App\Mail;

use App\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;


    /**
     *cuando creo el $payment de tipo Paiment, me arroja error
     * @param Payment $payment
     *
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('Reports.dailyReport', [
            'order' => $this->order,
        ]);

        return $pdf->stream('prueba.pdf');
    }
}
