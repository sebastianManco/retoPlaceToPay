<?php

namespace App\Listeners;

use App\Events\soldOutEvent;
use App\Mail\DailyReportMail;
use App\Mail\soldOutEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SoldOutListener implements ShouldQueue
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
     * @param  soldOutEvent  $event
     * @return void
     */
    public function handle(soldOutEvent $event)
    {
        $product = $event->product;

        Mail::to('sebastian.manco1997@gmailcom')
            ->send(new SoldOutEmailNotification($product));
    }
}
