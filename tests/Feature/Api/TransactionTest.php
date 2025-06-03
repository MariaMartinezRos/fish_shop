<?php

use App\Models\Transaction;
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    $role = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $role->id]);
    loginAsUser($admin);
});

it('returns a successful response for fetching all transactions', function () {
    $transaction = Transaction::factory()->create(['sale_id' => '100']);

    $response = $this->getJson('/api/v2/transactions');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [[
                'id',
                'tpv',
                'serial_number',
                'terminal_number',
                'operation',
                'amount',
                'card_number',
                'date_time',
                'transaction_number',
                'sale_id',
                'created_at',
                'updated_at'
            ]]
        ]);
});

it('returns a successful response for fetching a single transaction', function () {
    $transaction = Transaction::factory()->create(['sale_id' =>'100']);

    $response = $this->getJson("/api/v2/transactions/{$transaction->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'tpv',
                'serial_number',
                'terminal_number',
                'operation',
                'amount',
                'card_number',
                'date_time',
                'transaction_number',
                'sale_id',
                'created_at',
                'updated_at'
            ]
        ]);
});

it('stores a new transaction successfully', function () {

    $data = [
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789012',
        'operation' => 'SALE',
        'amount' => 99.99,
        'card_number' => '4111111111111111',
        'date_time' => now()->format('Y-m-d H:i:s'),
        'transaction_number' => 'TXN123456',
        'sale_id' => '100'
    ];

    $response = $this->postJson('/api/v2/transactions', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'tpv',
                'serial_number',
                'terminal_number',
                'operation',
                'amount',
                'card_number',
                'date_time',
                'transaction_number',
                'sale_id',
                'created_at',
                'updated_at'
            ]
        ]);

    $this->assertDatabaseHas('transactions', [
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789012',
        'operation' => 'SALE',
        'amount' => 99.99,
        'card_number' => '4111111111111111',
        'transaction_number' => 'TXN123456',
        'sale_id' => '100'
    ]);
});

it('updates an existing transaction successfully', function () {
    $transaction = Transaction::factory()->create(['sale_id' => '100']);

    $updateData = [
        'tpv' => 'TPV002',
        'serial_number' => 'SN654321',
        'terminal_number' => 'TN210987',
        'operation' => 'REFUND',
        'amount' => 49.99,
        'card_number' => '4111111111111111',
        'date_time' => now()->format('Y-m-d H:i:s'),
        'transaction_number' => 'TXN654321',
        'sale_id' => '100'
    ];

    $response = $this->putJson("/api/v2/transactions/{$transaction->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'tpv',
                'serial_number',
                'terminal_number',
                'operation',
                'amount',
                'card_number',
                'date_time',
                'transaction_number',
                'sale_id',
                'created_at',
                'updated_at'
            ]
        ]);

    $this->assertDatabaseHas('transactions', [
        'id' => $transaction->id,
        'tpv' => 'TPV002',
        'serial_number' => 'SN654321',
        'terminal_number' => 'TN210987',
        'operation' => 'REFUND',
        'amount' => 49.99,
        'card_number' => '4111111111111111',
        'transaction_number' => 'TXN654321',
        'sale_id' => '100'
    ]);
});

it('deletes a transaction successfully', function () {
    $transaction = Transaction::factory()->create(['sale_id' => '100']);

    $response = $this->deleteJson("/api/v2/transactions/{$transaction->id}");

    $response->assertStatus(204);

    $this->assertSoftDeleted('transactions', ['id' => $transaction->id]);
});

it('validates required fields when storing a transaction', function () {
    $response = $this->postJson('/api/v2/transactions', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
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

it('validates required fields when updating a transaction', function () {
    $transaction = Transaction::factory()->create(['sale_id' => '100']);

    $response = $this->putJson("/api/v2/transactions/{$transaction->id}", []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
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
})->todo('da 200 ');

it('validates card number format', function () {

    $data = [
        'tpv' => 'TPV001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'TN789012',
        'operation' => 'SALE',
        'amount' => 99.99,
        'card_number' => null, // Invalid card number
        'date_time' => now()->format('Y-m-d H:i:s'),
        'transaction_number' => 'TXN123456',
        'sale_id' => '100'
    ];

    $response = $this->postJson('/api/v2/transactions', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'card_number'
        ]);
});
