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
     * Muestra la lista de transacciones.
     */
    public function index()
    {
        $this->authorize('view', Transaction::class);

        $transactions = DB::table('transactions')->get();

        if ($transactions->isEmpty()) {
            return view('transactions', ['transactions' => []]);
        }

        event(new PageAccessed('Has accedido a la página correctamente.'));
        return view('transactions', compact('transactions'));
    }

    /**
     * Filtra las transacciones por fecha y cantidad.
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

        event(new PageAccessed('Has accedido a la página correctamente.'));
        return view('sales', compact('totalAmount', 'totalClients', 'chartHour', 'chartWeek'));
    }

    /**
     * Muestra gráficos de ventas por hora.
     */
    public function showGraphicHour()
    {
        $this->authorize('view', Transaction::class);

        $chartHour = new SalesPerHourChart;
        $chartHour->build();

        return $chartHour;
    }

    /**
     * Muestra gráficos de ventas por semana.
     */
    public function showGraphicWeek()
    {
        $this->authorize('view', Transaction::class);

        $chartWeek = new SalesPerWeekChart;
        $chartWeek->build();

        return $chartWeek;
    }
}
