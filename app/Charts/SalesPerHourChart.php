<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class SalesPerHourChart extends Chart
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
        $salesData = DB::table('transactions')
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('SUM(amount) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hours = $salesData->pluck('hour')->toArray();
        $totals = $salesData->pluck('total')->toArray();

        $this->labels($hours);
        $this->dataset('Sales per Hour', 'line', $totals)
//            ->backgroundColor('rgba(54, 162, 235, 0.2)')
//            ->borderColor('rgba(54, 162, 235, 1)')
//            ->borderWidth(1);
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ]);
    }
}
