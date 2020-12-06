<?php

namespace App\Console\Commands;

use App\Jobs\PlaceToPayPendingJob;
use App\Order;
use App\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PlaceToPayPendingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'placeToPay:orderPending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pending order update ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $payments = Payment::with('order')
            ->where('status', 'PENDING')
            ->get();

        foreach ($payments as $payment) {
            $order = $payment->order;
            dispatch(new PlaceToPayPendingJob($order));
        }
    }
}
