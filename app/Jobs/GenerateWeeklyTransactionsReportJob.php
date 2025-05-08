<?php

namespace App\Jobs;

use App\Mail\WeeklyTransactionsReportEmail;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class GenerateWeeklyTransactionsReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Get transactions from the past 7 days
        $startDate = now()->startOfWeek();       // Monday
        $endDate = now()->startOfWeek()->addDays(5); // Saturday

        $transactions = Transaction::whereBetween('date_time', [$startDate, $endDate])->get();

        $totalAmount = $transactions->sum('amount');
        $count = $transactions->count();

        $summary = [
            'start' => $startDate->toDateString(),
            'end' => $endDate->toDateString(),
            'total_sales' => $totalAmount,
            'transaction_count' => $count,
            'transactions' => $transactions,
        ];


        // Send report email to admin
        Mail::to('mariaamartinezros@gmail.com')->send(new WeeklyTransactionsReportEmail($summary));
    }
}
