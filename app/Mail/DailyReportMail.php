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

    /**
     * @return $this
     */
    public function build()
    {
        $payment = Payment::whereDate('created_at','=', now()
            ->format('Y-m-d'))
            ->get();

        $pdf = PDF::loadView('Reports.dailyReport', compact('payment'));

        return $this->view('Mail.DailyReport')
            ->attachData($pdf->output(), 'DailyReport.pdf');
    }
}
