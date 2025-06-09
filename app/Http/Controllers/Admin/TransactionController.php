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
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Shows the list of transactions.
     */
    public function index(Request $request)
    {
        $this->authorize('view', Transaction::class);

        $query = Transaction::query();

        // Apply existing scopes based on checkboxes
        if ($request->boolean('use_search_scope') && $request->filled('tpv')) {
            $query->search($request->tpv);
        }

        if ($request->boolean('use_terminal_scope') && $request->filled('terminal_number')) {
            $query->byTerminal($request->terminal_number);
        }

        if ($request->boolean('use_operation_scope') && $request->filled('operation')) {
            $query->byOperation($request->operation);
        }

        if ($request->boolean('use_date_scope') && ($request->filled('date_from') || $request->filled('date_to'))) {
            $query->byDateRange($request->date_from, $request->date_to);
        }

        // Apply metrics scope if requested
        if ($request->boolean('use_transaction_metrics')) {
            $query->byTransactionMetrics(
                startDate: $request->input('start_date'),
                endDate: $request->input('end_date'),
                minAmount: $request->input('min_amount'),
                operationTypes: $request->input('operation_types'),
                includeUserMetrics: $request->boolean('include_user_metrics')
            );
        }

        $transactions = $query->paginate(10)->withQueryString();

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
