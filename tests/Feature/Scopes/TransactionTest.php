<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    // Create test user
    $this->user = User::factory()->create([
        'name' => 'Test TPV'
    ]);

    // Create test transactions
    $this->transaction1 = Transaction::factory()->create([
        'tpv' => 'Test TPV',
        'terminal_number' => 'TERM001',
        'operation' => 'SALE',
        'amount' => 100.00,
        'date_time' => '2024-03-15 10:00:00'
    ]);

    $this->transaction2 = Transaction::factory()->create([
        'tpv' => 'Test TPV',
        'terminal_number' => 'TERM001',
        'operation' => 'REFUND',
        'amount' => 50.00,
        'date_time' => '2024-03-15 11:00:00'
    ]);

    $this->transaction3 = Transaction::factory()->create([
        'tpv' => 'Test TPV',
        'terminal_number' => 'TERM002',
        'operation' => 'SALE',
        'amount' => 200.00,
        'date_time' => '2024-03-15 12:00:00'
    ]);
});

it('filters transactions by date range', function () {
    $result = Transaction::byTransactionMetrics(
        startDate: '2024-03-15 09:00:00',
        endDate: '2024-03-15 11:30:00'
    )->get();

    expect($result)->toHaveCount(2)
        ->and($result->pluck('id')->toArray())->toContain($this->transaction1->id, $this->transaction2->id)
        ->and($result->pluck('id')->toArray())->not->toContain($this->transaction3->id);
});

it('filters transactions by minimum amount', function () {
    $result = Transaction::byTransactionMetrics(
        minAmount: 150.00
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->transaction3->id);
});

it('filters transactions by operation types', function () {
    $result = Transaction::byTransactionMetrics(
        operationTypes: ['SALE']
    )->get();

    expect($result)->toHaveCount(2)
        ->and($result->pluck('operation')->unique()->toArray())->toBe(['SALE']);
});

it('groups transactions by terminal with metrics', function () {
    $result = Transaction::byTransactionMetrics(
        groupByTerminal: true
    )->get();

    expect($result)->toHaveCount(2)
        ->and($result->first())->toHaveKeys([
            'terminal_number',
            'total_transactions',
            'total_amount',
            'average_amount',
            'first_transaction',
            'last_transaction'
        ]);
});

it('includes user metrics when requested', function () {
    $result = Transaction::byTransactionMetrics(
        includeUserMetrics: true
    )->first();

    expect($result->user)->toBeInstanceOf(User::class)
        ->and($result->user->total_user_transactions)->toBe(3)
        ->and((float)$result->user->transactions_sum_amount)->toBe(350.0);

//    ->and($result->user->transactions_sum_amount)->toBe(350.00);
});

it('combines multiple filters', function () {
    $result = Transaction::byTransactionMetrics(
        startDate: '2024-03-15 09:00:00',
        endDate: '2024-03-15 11:30:00',
        minAmount: 75.00,
        operationTypes: ['SALE']
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->transaction1->id);
});
