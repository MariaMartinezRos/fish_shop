<?php

namespace App\Charts;

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
        $salesData = DB::table('transactions')
            ->whereDate('date_time', '>=', now()->subDays(7))  // Se filtra los datos para los últimos 7 días
            ->select(DB::raw('DAY(date_time) as day'), DB::raw('SUM(amount) as total'))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $hours = $salesData->pluck('day')->toArray();
        $totals = $salesData->pluck('total')->toArray();

        $this->labels($hours);
        $this->dataset('Sales per Day', 'line', $totals)
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ]);
    }
}
