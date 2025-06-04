<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoadSoftDeletes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:soft-deletes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to load the soft-deletes data in to the pdf view';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedRecords = [];
        $tables = ['categories', 'fish', 'products', 'roles', 'transactions', 'typewaters', 'users'];

        foreach ($tables as $table) {
            if (! \Schema::hasColumn($table, 'deleted_at')) {
                $this->error("The deleted_at column does not exist in the {$table} table.");

                continue;
            }

            $deleted = \DB::table($table)->whereNotNull('deleted_at')->get();

            if ($deleted->isNotEmpty()) {
                $deletedRecords[$table] = $deleted;
            } else {
                $this->info("No deleted records found in the {$table} table.");
            }
        }

        return $deletedRecords;
    }
}
