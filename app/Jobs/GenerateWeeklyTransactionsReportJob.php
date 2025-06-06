<?php

namespace App\Jobs;

use App\Mail\WeeklyTransactionsReportEmail;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
    public function handle(): void
    {
        try {
            \Log::info('Starting GenerateWeeklyTransactionsReportJob');

            $startDate = now()->startOfWeek();
            $endDate = now()->startOfWeek()->addDays(5);

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

            \Log::info('Sending weekly transactions report', [
                'period' => $startDate->toDateString() . ' to ' . $endDate->toDateString(),
                'total_sales' => $totalAmount,
                'transaction_count' => $count
            ]);

            Mail::to('mariaamartinezros@gmail.com')->send(new WeeklyTransactionsReportEmail($summary));
            
            \Log::info('Weekly transactions report sent successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to generate weekly transactions report: ' . $e->getMessage());
            throw $e;
        }
    }
}
