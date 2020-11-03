<?php

namespace App\Jobs;

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

    /**
     * @var string
     */
    private string $userEmail;

    /**
     * Create a new job instance.
     * @param string $userEmail
     */
    public function __construct(string $userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $mail = new DailyReportMail();
        Mail::to($this->userEmail)->send($mail);

    }
}
