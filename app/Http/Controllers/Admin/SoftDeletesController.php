<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SoftDeletesController extends Controller
{
    use AuthorizesRequests;
    /**
     * Descarga todos los productos en un archivo PDF
     */
    public function generate()
    {
        $this->authorize('view', User::class);

        // Get the current date for the report
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        $tables = ['categories', 'fish', 'products', 'roles', 'transactions', 'typewaters', 'users'];
        $deletedRecords = [];

        // Check if the table has de soft deletes column
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

        // Pass the data to the pdf view
        $pdf = Pdf::loadView('pdf.soft-deletes', [
            'tables' => $deletedRecords,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        return $pdf->download('soft-deletes-report.pdf');
    }
}

