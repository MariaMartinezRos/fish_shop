<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create admin user
    $this->admin = User::factory()->create([
        'role_id' => 1 // Assuming 1 is admin role
    ]);

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

it('shows transactions without scope when checkbox is unchecked', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.transactions.index'));

    $response->assertStatus(200)
        ->assertViewHas('transactions', function ($transactions) {
            return $transactions->count() === 3;
        });
});

it('applies transaction metrics scope when checkbox is checked', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.transactions.index', [
            'use_transaction_metrics' => true,
            'start_date' => '2024-03-15 09:00:00',
            'end_date' => '2024-03-15 11:30:00',
            'min_amount' => 75.00,
            'operation_types' => ['SALE']
        ]));

    $response->assertStatus(200)
        ->assertViewHas('transactions', function ($transactions) {
            return $transactions->count() === 1
                && $transactions->first()->id === $this->transaction1->id;
        });
});

it('includes user metrics when requested', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.transactions.index', [
            'use_transaction_metrics' => true,
            'include_user_metrics' => true
        ]));

    $response->assertStatus(200)
        ->assertViewHas('transactions', function ($transactions) {
            $transaction = $transactions->first();
            return $transaction->user->total_user_transactions === 3
                && (float)$transaction->user->transactions_sum_amount === 350.0;
        });
}); 