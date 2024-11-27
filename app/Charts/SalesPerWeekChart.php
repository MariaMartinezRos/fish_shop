<?php

namespace App\Charts;

use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class SalesPerWeekChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function build(): void
    {
        // crear una variable con la consulta a la base de datos
//        $salesData = DB::table('transactions')
//            ->whereDate('date_time', '>=', now()->subDays(5))  // Se filtra los datos para los últimos 7 días
//            ->select(DB::raw('DATE(date_time) as date'), DB::raw('SUM(amount) as total'))
//            ->groupBy('date')
//            ->orderBy('date')
//            ->limit(5)
//            ->get();
        $salesData = DB::table('transactions')
            ->whereDate('date_time', '>=', now()->startOfWeek()->addDays(1))  // martes
            ->whereDate('date_time', '<=', now()->startOfWeek()->addDays(5))  // sabado
            ->select(DB::raw('DATE(date_time) as date'), DB::raw('SUM(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
//            ->limit(5)
            ->get();

        // Formatear los días
        $days = $salesData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->locale('es')->isoFormat('dddd D');
        })->toArray();
        $totals = $salesData->pluck( __('total'))->toArray();

        $this->labels($days);
        $this->dataset( __('Sales per Week'), 'line', $totals)
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ]);
    }
}
