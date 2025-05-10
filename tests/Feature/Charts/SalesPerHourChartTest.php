<?php

use App\Charts\SalesPerHourChart;
use Illuminate\Support\Facades\DB;

    it('builds chart data and sets labels/datasets', function () {
        // Mock the DB query to return some test data
        DB::shouldReceive('connection->getDriverName')
            ->andReturn('sqlite');

        DB::shouldReceive('table->select->whereDate->groupBy->orderBy->get')
            ->andReturn(collect([
                (object)['hour' => '10', 'total' => 100],
                (object)['hour' => '11', 'total' => 200],
            ]));

        $chart = new SalesPerHourChart();
        $chart->build();

        expect($chart->labels)->toBe(['10', '11']);
        expect($chart->datasets)->toHaveCount(1);
    })->todo();

    it('handles empty data gracefully', function () {
        // Mock the DB query to return empty data
        DB::shouldReceive('connection->getDriverName')
            ->andReturn('sqlite');

        DB::shouldReceive('table->select->whereDate->groupBy->orderBy->get')
            ->andReturn(collect([]));

        $chart = new SalesPerHourChart();
        $chart->build();

        expect($chart->labels)->toBe([]);
        expect($chart->datasets)->toHaveCount(1);
    })->todo();
