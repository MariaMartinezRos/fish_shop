<?php

namespace App\Http\Controllers\Admin;

use App\Charts\SalesPerHourChart;
use App\Charts\SalesPerWeekChart;
use App\Events\PageAccessed;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Shows the list of transactions.
     */
    public function index()
    {
        $this->authorize('view', Transaction::class);

        $transactions = DB::table('transactions')->get();

        if ($transactions->isEmpty()) {
            return view('transactions', ['transactions' => []]);
        }

        event(new PageAccessed(__('You have successfully accessed the page.')));
        return view('transactions', compact('transactions'));
    }

    /**
     * Filters transactions by date and amount.
     */
    public function showSales()
    {
        $this->authorize('view', Transaction::class);

        $totalAmount = DB::table('transactions')
            ->whereDate('date_time', Carbon::today())
            ->sum('amount');

        $totalClients = DB::table('transactions')
            ->whereDate('date_time', Carbon::today())
            ->count();

        $chartHour = $this->showGraphicHour();
        $chartWeek = $this->showGraphicWeek();

        event(new PageAccessed(__('You have successfully accessed the page.')));
        return view('sales', compact('totalAmount', 'totalClients', 'chartHour', 'chartWeek'));
    }

    /**
     * Shows sales charts by hour.
     */
    public function showGraphicHour()
    {
        $this->authorize('view', Transaction::class);

        $chartHour = new SalesPerHourChart;
        $chartHour->build();

        return $chartHour;
    }

    /**
     * Shows sales charts by week.
     */
    public function showGraphicWeek()
    {
        $this->authorize('view', Transaction::class);

        $chartWeek = new SalesPerWeekChart;
        $chartWeek->build();

        return $chartWeek;
    }
}
