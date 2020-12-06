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
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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

            $response = $placeToPay->placeToPay('create', $order);

        if ($response->payment === null) {
            $status = $response->status->status;

            $order->payment->update([
                'status' => $status
            ]);
            return logger()->channel('stack')
                ->info('ta por aqui-' . $order->id);
        } elseif ($response->payment[0]->status->status  !== 'APPROVED') {
            $status = $response->payment[0]->status->status;

            $order->payment->update([
                'status' => $status
            ]);
            return logger()->channel('stack')
                ->info('o por aqui-' . $order->id);
        } elseif ($response->payment[0]->status->status  === 'APPROVED') {
            foreach ($response->payment as $payments) {
                $pay = $payments;
            }

            $status = $response->status->status;
            $internalReference = $pay->internalReference;

            $order->payment->update([
                'internalReference' => $internalReference,
                'status'            => $status,
            ]);
        }
        return logger()->channel('stack')
            ->info('pago actualizado -' . $status);
    }
}
