<?php

use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    $this->request = new UpdateTransactionRequest;
});

it('passes with all valid fields', function () {
    $data = [
        'tpv' => 'TPV-001',
        'serial_number' => 'SN123456',
        'terminal_number' => 'T001',
        'operation' => 'payment',
        'amount' => 99.99,
        'card_number' => '1234567812345678',
        'date_time' => now()->toDateTimeString(),
        'transaction_number' => 'TXN1001',
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->passes())->toBeTrue();
});

it('fails if card_number is less than 4 characters', function () {
    $data = ['card_number' => '123'];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('card_number'))->toBeTrue();
});

it('fails if amount is negative', function () {
    $data = ['amount' => -5];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('amount'))->toBeTrue();
});

it('fails if date_time is not a valid date', function () {
    $data = ['date_time' => 'not-a-date'];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('date_time'))->toBeTrue();
});
