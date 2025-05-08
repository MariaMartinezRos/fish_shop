<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CleanTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all caches including views, route, config, log, and application cache. Then ejecutes the tests';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Clearing caches...');

        Artisan::call('app:clean-all-cache');

        $this->info('All caches cleared successfully!');
        $this->info('Running tests...');

        Artisan::call('test', [], $this->getOutput());

        $this->info('All tests ejecuted successfully!');

    }
}
