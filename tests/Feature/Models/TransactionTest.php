<?php

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

it('can create a transaction with all attributes', function () {
    $transaction = Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '****1234',
        'date_time' => now(),
        'transaction_number' => 'TRX001',
        'sale_id' => 1
    ]);

    expect($transaction)
        ->tpv->toBe('TPV001')
        ->serial_number->toBe('SN123456')
        ->terminal_number->toBe('TN789')
        ->operation->toBe('VENTA')
        ->amount->toBe(100.50)
        ->card_number->toBe('****1234')
        ->transaction_number->toBe('TRX001')
        ->sale_id->toBe(1);
});

it('can be associated with a user', function () {
    $user = User::factory()->create(['name' => 'TPV001']);
    $transaction = Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '****1234',
        'date_time' => now(),
        'transaction_number' => 'TRX001',
        'sale_id' => 1
    ]);

    expect($transaction->user)
        ->id->toBe($user->id)
        ->name->toBe('TPV001');
});

it('can search transactions by tpv', function () {
    Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '****1234',
        'date_time' => now(),
        'transaction_number' => 'TRX001',
        'sale_id' => 1
    ]);

    Transaction::create([
        'tpv' => 'TPV002',
        'serial_number' => 'SN789012',
        'terminal_number' => 'TN456',
        'operation' => 'VENTA',
        'amount' => 200.75,
        'card_number' => '****5678',
        'date_time' => now(),
        'transaction_number' => 'TRX002',
        'sale_id' => 2
    ]);

    $results = Transaction::search('TPV001')->get();

    expect($results)->toHaveCount(1)
        ->and($results->first())
        ->tpv->toBe('TPV001');
});

it('can get today transactions', function () {
    $today = now();
    $yesterday = now()->subDay();

    // Today's transaction
    Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '****1234',
        'date_time' => $today,
        'transaction_number' => 'TRX001',
        'sale_id' => 1
    ]);

    // Yesterday's transaction
    Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN789012',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 200.75,
        'card_number' => '****5678',
        'date_time' => $yesterday,
        'transaction_number' => 'TRX002',
        'sale_id' => 2
    ]);

    $todayTransactions = Transaction::today()->get();

    expect($todayTransactions)->toHaveCount(1)
        ->and($todayTransactions->first())
        ->date_time->format('Y-m-d')->toBe($today->format('Y-m-d'));
})->todo();

it('can be soft deleted', function () {
    $transaction = Transaction::create([
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '****1234',
        'date_time' => now(),
        'transaction_number' => 'TRX001',
        'sale_id' => 1
    ]);

    $transactionId = $transaction->id;
    $transaction->delete();

    expect(Transaction::find($transactionId))->toBeNull()
        ->and(Transaction::withTrashed()->find($transactionId))->not->toBeNull();
});
