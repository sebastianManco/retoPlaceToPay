<?php

namespace App\Console\Commands;

use App\Mail\DailyReportMail;
use App\Order;
use App\Payment;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SendEmailWithDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reportDaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command sends daily transaction reports';

    /**

     * @param Request $request
     * @return int
     */
    public function handle(): int
    {
        $order = Order::with('user', 'products', 'payment')
            ->whereDate('created_at', '=', now()
                ->format('Y-m-d'))
            ->get();

        Mail::to('sebastian.manco1997@gmailcom')
            ->send(new DailyReportMail($order));
        return 0;
    }
}
