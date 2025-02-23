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
        /**
         * SQLite no tiene la función HOUR() para extraer la hora de un campo datetime
         * por lo que se usa strftime('%H', date_time) para extraer la hora
         */
        $connection = DB::connection()->getDriverName();
        $today = now()->format('Y-m-d');

        if ($connection === 'sqlite') {
            $salesData = DB::table('transactions')
                ->select(DB::raw('strftime(\'%H\', date_time) as hour'), DB::raw('SUM(amount) as total'))
                ->whereDate('date_time', $today)
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();
        } else {
            $salesData = DB::table('transactions')
                ->select(DB::raw('HOUR(date_time) as hour'), DB::raw('SUM(amount) as total'))
                ->whereDate('date_time', $today)
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();
        }

        $hours = $salesData->pluck(__('hour'))->toArray();
        $totals = $salesData->pluck(__('total'))->toArray();

        $this->labels($hours);
        $this->dataset(__('Sales per Hour'), 'line', $totals)
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1,
            ]);

    }
}
