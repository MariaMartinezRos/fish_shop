<?php

use App\Http\Requests\VacationRequestActionRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $this->admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Create employee role and user
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);

    // Create a vacation request
    $this->vacationRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'pending'
    ]);
});

it('authorizes admin users', function () {
    Auth::login($this->admin);
    
    $request = new VacationRequestActionRequest();
    expect($request->authorize())->toBeTrue();
});

it('does not authorize non-admin users', function () {
    Auth::login($this->employee);
    
    $request = new VacationRequestActionRequest();
    expect($request->authorize())->toBeFalse();
});

it('validates required fields', function () {
    $validator = Validator::make([], (new VacationRequestActionRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('requestId'))->toBeTrue();
    expect($validator->errors()->has('type'))->toBeTrue();
});

it('validates requestId exists in vacation_requests table', function () {
    $validator = Validator::make([
        'requestId' => 999999,
        'type' => 'pending'
    ], (new VacationRequestActionRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('requestId'))->toBeTrue();
});

it('validates type is in allowed values', function () {
    $validator = Validator::make([
        'requestId' => $this->vacationRequest->id,
        'type' => 'invalid_type'
    ], (new VacationRequestActionRequest())->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('type'))->toBeTrue();
});

it('passes validation with valid data', function () {
    $validator = Validator::make([
        'requestId' => $this->vacationRequest->id,
        'type' => 'pending'
    ], (new VacationRequestActionRequest())->rules());

    expect($validator->fails())->toBeFalse();
});

it('has correct validation messages', function () {
    $request = new VacationRequestActionRequest();
    $messages = $request->messages();

    expect($messages['requestId.required'])->toBe('El ID de la solicitud es requerido.');
    expect($messages['requestId.exists'])->toBe('La solicitud de vacaciones no existe.');
    expect($messages['type.required'])->toBe('El tipo de acción es requerido.');
    expect($messages['type.in'])->toBe('El tipo de acción no es válido.');
}); 