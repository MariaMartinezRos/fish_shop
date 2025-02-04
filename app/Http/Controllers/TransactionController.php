<?php

namespace App\Http\Controllers;

use App\Charts\SalesPerHourChart;
use App\Charts\SalesPerWeekChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Muestra la lista de transacciones.
     */
    public function index()
    {
        $transactions = DB::table('transactions')->get();

        if ($transactions->isEmpty()) {
            return view('transactions', ['transactions' => []]);
        }

        return view('transactions', compact('transactions'));
    }

    /**
     * Filtra las transacciones por fecha y cantidad.
     */
    public function showSales()
    {
        $totalAmount = DB::table('transactions')
            ->whereDate('date_time', Carbon::today())
            ->sum('amount');

        $totalClients = DB::table('transactions')
            ->whereDate('date_time', Carbon::today())
            ->count();

        $chartHour = $this->showGraphicHour();
        $chartWeek = $this->showGraphicWeek();

        return view('sales', compact('totalAmount', 'totalClients', 'chartHour', 'chartWeek'));
    }

    /**
     * Muestra gráficos de ventas por hora.
     */
    public function showGraphicHour()
    {
        $chartHour = new SalesPerHourChart;
        $chartHour->build();

        return $chartHour;
    }

    /**
     * Muestra gráficos de ventas por semana.
     */
    public function showGraphicWeek()
    {
        $chartWeek = new SalesPerWeekChart;
        $chartWeek->build();

        return $chartWeek;
    }
}
