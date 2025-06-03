<?php

use App\Http\Requests\VacationRequestFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    // Create employee role and user
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);
});

it('authorizes all users', function () {
    $request = new VacationRequestFormRequest();
    expect($request->authorize())->toBeTrue();
});

it('validates required fields', function () {
    $validator = Validator::make([], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('start_date'))->toBeTrue();
    expect($validator->errors()->has('end_date'))->toBeTrue();
    expect($validator->errors()->has('comments'))->toBeTrue();
    expect($validator->errors()->has('policy_acknowledged'))->toBeTrue();
});

it('validates start date is after today', function () {
    $validator = Validator::make([
        'start_date' => now()->subDay()->format('Y-m-d'),
        'end_date' => now()->addDays(5)->format('Y-m-d'),
        'comments' => 'Test vacation request',
        'policy_acknowledged' => true
    ], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('start_date'))->toBeTrue();
});

it('validates end date is after or equal to start date', function () {
    $validator = Validator::make([
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(3)->format('Y-m-d'),
        'comments' => 'Test vacation request',
        'policy_acknowledged' => true
    ], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('end_date'))->toBeTrue();
});

it('validates comments minimum length', function () {
    $validator = Validator::make([
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'comments' => 'Short',
        'policy_acknowledged' => true
    ], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('comments'))->toBeTrue();
});

it('validates policy acknowledgment', function () {
    $validator = Validator::make([
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'comments' => 'Test vacation request',
        'policy_acknowledged' => false
    ], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('policy_acknowledged'))->toBeTrue();
});

it('passes validation with valid data', function () {
    $validator = Validator::make([
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'comments' => 'Test vacation request with sufficient length',
        'policy_acknowledged' => true
    ], (new VacationRequestFormRequest())->rules());

    expect($validator->fails())->toBeFalse();
});

it('has correct validation messages', function () {
    $request = new VacationRequestFormRequest();
    $messages = $request->messages();

    expect($messages['start_date.required'])->toBe('La fecha de inicio es requerida.');
    expect($messages['start_date.after'])->toBe('La fecha de inicio debe ser posterior a hoy.');
    expect($messages['end_date.required'])->toBe('La fecha de fin es requerida.');
    expect($messages['end_date.after_or_equal'])->toBe('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
    expect($messages['comments.required'])->toBe('Los comentarios son requeridos.');
    expect($messages['comments.min'])->toBe('Los comentarios deben tener al menos 10 caracteres.');
    expect($messages['policy_acknowledged.required'])->toBe('Debe aceptar la política de vacaciones.');
    expect($messages['policy_acknowledged.accepted'])->toBe('Debe aceptar la política de vacaciones.');
}); 