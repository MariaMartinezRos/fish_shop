<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

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
            if (!\Schema::hasColumn($table, 'deleted_at')) {
                $this->error("The deleted_at column does not exist in the {$table} table.");
                continue;
            }

            $deleted = \DB::table($table)->whereNotNull('deleted_at')->get();

            if ($deleted->isNotEmpty()) {
                $deletedRecords[$table] = $deleted;
            }
        }

        return $deletedRecords;




        //Checks the tables and if the soft deltes column exists IN CATEGORY, FISH, PRODUCT, ROLE, TRANSACTION,
        // TYPEWATER, AND USER, it will create the pdf view
        // Check if the table exists
//        if (! \Schema::hasTable('categories')) {
//            $this->error('The categories table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('fish')) {
//            $this->error('The fish table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('products')) {
//            $this->error('The products table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('roles')) {
//            $this->error('The roles table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('transactions')) {
//            $this->error('The transactions table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('typewaters')) {
//            $this->error('The typewaters table does not exist.');
//
//            return;
//        }
//        if (! \Schema::hasTable('users')) {
//            $this->error('The users table does not exist.');
//
//            return;
//        }
//        // Check if the soft deletes column exists
//        if (! \Schema::hasColumn('categories', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the categories table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('fish', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the fish table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('products', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the products table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('roles', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the roles table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('transactions', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the transactions table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('typewaters', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the typewaters table.');
//
//            return;
//        }
//        if (! \Schema::hasColumn('users', 'deleted_at')) {
//            $this->error('The deleted_at column does not exist in the users table.');
//
//            return;
//        }
//
//
//
//
//        // Create the admin user
//        try {
//            $this->info('Soft deletes report created successfully!');
//        } catch (\Exception $e) {
//            $this->error('Failed to create soft deletes report: '.$e->getMessage());
//        }
    }
}
