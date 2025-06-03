<?php

use App\Charts\SalesPerHourChart;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    // Create test transactions for today
    $today = now()->format('Y-m-d');
    Transaction::factory()->create([
        'date_time' => $today . ' 10:00:00',
        'amount' => 100
    ]);
    Transaction::factory()->create([
        'date_time' => $today . ' 10:30:00',
        'amount' => 200
    ]);
    Transaction::factory()->create([
        'date_time' => $today . ' 15:00:00',
        'amount' => 300
    ]);
});

it('builds chart with correct data structure', function () {
    $chart = new SalesPerHourChart();
    $chart->build();

    expect($chart->labels)->toBeArray()
        ->and($chart->datasets)->toBeArray()
        ->and($chart->datasets[0]->data)->toBeArray()
        ->and($chart->datasets[0]->options)->toBeArray();
})->todo();

it('aggregates sales by hour correctly', function () {
    $chart = new SalesPerHourChart();
    $chart->build();

    // Get the data from the chart
    $data = $chart->datasets[0]->data;
    $labels = $chart->labels;

    // Find the index for hour 10 (should have 300 total - 100 + 200)
    $hour10Index = array_search('10', $labels);
    expect($data[$hour10Index])->toBe(300.0);

    // Find the index for hour 15 (should have 300)
    $hour15Index = array_search('15', $labels);
    expect($data[$hour15Index])->toBe(300.0);
})->todo();

it('handles empty data correctly', function () {
    // Clear all transactions
    Transaction::query()->delete();

    $chart = new SalesPerHourChart();
    $chart->build();

    expect($chart->labels)->toBeArray();
    expect($chart->datasets)->toBeArray();
    expect($chart->datasets[0]->data)->toBeArray();
    expect($chart->datasets[0]->data)->toBeEmpty();
})->todo();

it('uses correct chart options', function () {
    $chart = new SalesPerHourChart();
    $chart->build();

    $options = $chart->datasets[0]->options;
    expect($options)->toHaveKey('backgroundColor', 'rgba(54, 162, 235, 0.2)');
    expect($options)->toHaveKey('borderColor', 'rgba(54, 162, 235, 1)');
    expect($options)->toHaveKey('borderWidth', 1);
})->todo();
