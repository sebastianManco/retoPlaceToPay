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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = Payment::with('order')
            ->where('status','PENDING')
            ->get();

        foreach ($payments as $payment) {
            $order = $payment->order;
            dispatch(new PlaceToPayPendingJob($order));
        }

    }
}
