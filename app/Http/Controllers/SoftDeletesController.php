<?php

namespace App\Http\Controllers;

use App\Console\Commands\LoadSoftDeletes;
use App\Models\Product;
use Artisan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SoftDeletesController extends Controller
{
    /**
     * Descarga todos los productos en un archivo PDF
     */
    public function generate()
    {
        // Get the current date for the report
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        // Get deleted records from all tables
        $tables = ['categories', 'fish', 'products', 'roles', 'transactions', 'typewaters', 'users'];
        $deletedRecords = [];

        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'deleted_at')) {
                $deleted = DB::table($table)
                    ->whereNotNull('deleted_at')
                    ->whereBetween('deleted_at', [$startDate, $endDate])
                    ->get();

                if ($deleted->isNotEmpty()) {
                    $deletedRecords[$table] = $deleted;
                }
            }
        }

        // Pass the data to the PDF view
        $pdf = Pdf::loadView('pdf.soft-deletes', [
            'tables' => $deletedRecords,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        return $pdf->download('soft-deletes-report.pdf');
    }
}

