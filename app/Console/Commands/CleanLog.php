<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the laravel.log file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logFile = storage_path('logs/laravel.log');

        if (File::exists($logFile)) {
            File::put($logFile, '');
            $this->info('Log file cleaned successfully.');
        } else {
            $this->warn('No log file found.');
        }
    }
}
