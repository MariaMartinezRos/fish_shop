<?php

use App\Livewire\TransactionSearcher;
use App\Models\Transaction;
use Livewire\Livewire;

it('renders the transaction searcher component', function () {
    Livewire::test(TransactionSearcher::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.transaction-searcher');
});

it('shows all transactions when no tpv filter is applied', function () {
    // Crear manualmente algunas transacciones con todos los campos
    Transaction::create([
        'tpv' => 'TPV-123',
        'serial_number' => 'SN-001',
        'terminal_number' => 'TN-001',
        'operation' => 'sale',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-001',
        'sale_id' => 1,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);
    Transaction::create([
        'tpv' => 'TPV-456',
        'serial_number' => 'SN-002',
        'terminal_number' => 'TN-002',
        'operation' => 'sale',
        'amount' => 200.75,
        'card_number' => '2345678901234567',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-002',
        'sale_id' => 2,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);
    Transaction::create([
        'tpv' => 'TPV-789',
        'serial_number' => 'SN-003',
        'terminal_number' => 'TN-003',
        'operation' => 'refund',
        'amount' => 300.00,
        'card_number' => '3456789012345678',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-003',
        'sale_id' => 3,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);

    // Test de que se muestran todas las transacciones cuando no se aplica un filtro
    Livewire::test(TransactionSearcher::class)
        ->assertViewHas('transactions', function ($transactions) {
            return $transactions->count() === 3;
        });
});

it('filters transactions by tpv value', function () {
    // Crear manualmente algunas transacciones con todos los campos
    Transaction::create([
        'tpv' => 'TPV-123',
        'serial_number' => 'SN-001',
        'terminal_number' => 'TN-001',
        'operation' => 'sale',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-001',
        'sale_id' => 1,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);
    Transaction::create([
        'tpv' => 'TPV-XYZ',
        'serial_number' => 'SN-002',
        'terminal_number' => 'TN-002',
        'operation' => 'sale',
        'amount' => 200.75,
        'card_number' => '2345678901234567',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-002',
        'sale_id' => 2,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);
    Transaction::create([
        'tpv' => 'NOT-MATCH',
        'serial_number' => 'SN-003',
        'terminal_number' => 'TN-003',
        'operation' => 'refund',
        'amount' => 300.00,
        'card_number' => '3456789012345678',
        'date_time' => Date::now(),
        'transaction_number' => 'TXN-003',
        'sale_id' => 3,
        'created_at' => Date::now(),
        'updated_at' => Date::now(),
    ]);

    // Test de filtro por valor de tpv
    Livewire::test(TransactionSearcher::class)
        ->set('tpv', 'TPV')
        ->assertViewHas('transactions', function ($transactions) {
            return $transactions->count() === 2 &&
                $transactions->pluck('tpv')->contains('TPV-123') &&
                $transactions->pluck('tpv')->contains('TPV-XYZ');
        });
});
