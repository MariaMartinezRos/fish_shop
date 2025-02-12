<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanProductsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all data from the products table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if ($this->confirm('Are you sure you want to delete all data from the products table? This action cannot be undone.')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key constraints
            DB::table('products')->truncate(); // Truncate the products table
            DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Re-enable foreign key constraints

            $this->info('All data from the products table has been deleted successfully!');
        } else {
            $this->info('Operation cancelled.');
        }
    }
}
