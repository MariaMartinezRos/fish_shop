<?php

use App\Livewire\TransactionManager;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('updates existing transaction', function () {
    $transaction = Transaction::factory()->create();
    
    Livewire::actingAs($this->user)
        ->test(TransactionManager::class)
        ->set('tpv', 'Updated TPV')
        ->set('serial_number', 'SN123456')
        ->set('terminal_number', 'TERM-001')
        ->set('operation', 'sale')
        ->set('amount', 100.50)
        ->set('card_number', '1234567890123456')
        ->set('date_time', now()->format('Y-m-d\TH:i'))
        ->set('transaction_number', 'TXN-001')
        ->set('sale_id', 1)
        ->set('transactionId', $transaction->id)
        ->set('editing', true)
        ->call('update')
        ->assertSessionHas('message', 'Transaction updated successfully.');
});

it('deletes transaction', function () {
    $transaction = Transaction::factory()->create();
    
    Livewire::actingAs($this->user)
        ->test(TransactionManager::class)
        ->call('delete', $transaction->id)
        ->assertSessionHas('message', 'Transaction deleted successfully.');
});

it('validates required fields', function () {
    Livewire::actingAs($this->user)
        ->test(TransactionManager::class)
        ->set('tpv', '')
        ->set('serial_number', '')
        ->set('terminal_number', '')
        ->set('operation', '')
        ->set('amount', '')
        ->set('card_number', '')
        ->set('date_time', '')
        ->set('transaction_number', '')
        ->set('sale_id', '')
        ->call('store')
        ->assertHasErrors([
            'tpv',
            'serial_number',
            'terminal_number',
            'operation',
            'amount',
            'card_number',
            'date_time',
            'transaction_number',
            'sale_id'
        ]);
}); 