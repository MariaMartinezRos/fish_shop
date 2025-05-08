<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-weekly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the weekly report email to the admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new \App\Jobs\GenerateWeeklyTransactionsReportJob);
    }
}
