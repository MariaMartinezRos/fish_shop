<?php

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

it('validates tpv is required', function () {
    // Arrange
    $request = new StoreTransactionRequest();

    // Act
    $data = [
        'serial_number' => 'SN12345',
        'terminal_number' => 'TN12345',
        'operation' => 'purchase',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => '2025-05-08 12:00:00',
        'transaction_number' => 'TX123456789',
        'sale_id' => 100,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('tpv'))->toBeTrue();
});

it('validates serial_number is required', function () {
    // Arrange
    $request = new StoreTransactionRequest();

    // Act
    $data = [
        'tpv' => 'TPV123',
        'terminal_number' => 'TN12345',
        'operation' => 'purchase',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => '2025-05-08 12:00:00',
        'transaction_number' => 'TX123456789',
        'sale_id' => 1,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('serial_number'))->toBeTrue();
});

it('validates amount is numeric and not negative', function () {
    // Arrange
    $request = new StoreTransactionRequest();

    // Act
    $data = [
        'tpv' => 'TPV123',
        'serial_number' => 'SN12345',
        'terminal_number' => 'TN12345',
        'operation' => 'purchase',
        'amount' => -100.50, // Cantidad negativa
        'card_number' => '1234567890123456',
        'date_time' => '2025-05-08 12:00:00',
        'transaction_number' => 'TX123456789',
        'sale_id' => 1,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('amount'))->toBeTrue();
});

it('validates card_number is at least 4 digits', function () {
    // Arrange
    $request = new StoreTransactionRequest();

    // Act
    $data = [
        'tpv' => 'TPV123',
        'serial_number' => 'SN12345',
        'terminal_number' => 'TN12345',
        'operation' => 'purchase',
        'amount' => 100.50,
        'card_number' => '123',
        'date_time' => '2025-05-08 12:00:00',
        'transaction_number' => 'TX123456789',
        'sale_id' => 1,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('card_number'))->toBeTrue();
});

it('validates sale_id is required and numeric', function () {
    // Arrange
    $request = new StoreTransactionRequest();

    // Act
    $data = [
        'tpv' => 'TPV123',
        'serial_number' => 'SN12345',
        'terminal_number' => 'TN12345',
        'operation' => 'purchase',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => '2025-05-08 12:00:00',
        'transaction_number' => 'TX123456789',
        'sale_id' => 'invalid_value', // Sale ID no válido
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('sale_id'))->toBeTrue();
});

