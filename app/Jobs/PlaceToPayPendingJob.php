<?php

namespace App\Jobs;

use App\Http\Controllers\CheckoutController;
use App\Order;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PlaceToPayPendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;


    /**
     * Create a new job instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.

     */
    public function handle()
    {

        $placeToPay = new CheckoutController();

        $order = $this->order;

            $response = $response = $placeToPay->updatePayment( $order);

            foreach ($response->payment as $payments) {
                $payment = $payments;
            }
            $status = $response->status->status;
            $internalReference = $payment->internalReference;

            $paymentUpdate = Payment::update([
                'internalReference' => $internalReference,
                'status' => $status
                ]);

            logger()->channel('stack')->info('pruebas desde chekout', ['status' =>$payment->status]);



    }

}
