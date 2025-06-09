<?php

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

it('validates required fields', function () {
    $request = new LoginRequest;
    $rules = $request->rules();

    expect($rules)->toHaveKey('email')
        ->and($rules['email'])->toContain('required')
        ->and($rules)->toHaveKey('password')
        ->and($rules['password'])->toContain('required');
});

it('validates email format', function () {
    $request = new LoginRequest;
    $rules = $request->rules();

    expect($rules['email'])->toContain('email');
});

it('passes validation with correct data', function () {
    $request = new LoginRequest;

    $data = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->passes())->toBeTrue();
});

it('fails validation with missing required fields', function () {
    $request = new LoginRequest;

    $data = [
        'email' => '',
        'password' => '',
    ];

    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('email'))->toBeTrue();
    expect($validator->errors()->has('password'))->toBeTrue();
});

it('fails validation with invalid email format', function () {
    $request = new LoginRequest;

    $data = [
        'email' => 'invalid-email',
        'password' => 'password',
    ];

    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('email'))->toBeTrue();
});

it('has custom error messages', function () {
    $request = new LoginRequest;
    $messages = $request->messages();

    expect($messages)->toHaveKey('email.required')
        ->and($messages)->toHaveKey('email.email')
        ->and($messages)->toHaveKey('password.required');
})->todo();

it('validates remember me field', function () {
    $request = new LoginRequest;
    $rules = $request->rules();

    expect($rules)->toHaveKey('remember')
        ->and($rules['remember'])->toContain('boolean');
})->todo();

it('passes validation with remember me checked', function () {
    $request = new LoginRequest;

    $data = [
        'email' => 'test@example.com',
        'password' => 'password',
        'remember' => true,
    ];

    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->passes())->toBeTrue();
});
