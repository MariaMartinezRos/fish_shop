<?php

use App\Http\Requests\VacationRequestActionRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;

it('authorizes admin users', function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    Auth::login($admin);

    $request = new VacationRequestActionRequest();
    expect($request->authorize())->toBeTrue();
});

it('does not authorize non-admin users', function () {
    // Create regular user
    $user = User::factory()->create();

    Auth::login($user);

    $request = new VacationRequestActionRequest();
    expect($request->authorize())->toBeFalse();
});

it('validates required fields', function () {
    $request = new VacationRequestActionRequest();
    $rules = $request->rules();

    expect($rules)->toHaveKey('requestId')
        ->and($rules['requestId'])->toContain('required')
        ->and($rules)->toHaveKey('type')
        ->and($rules['type'])->toContain('required');
});

it('validates requestId exists in vacation_requests table', function () {
    $request = new VacationRequestActionRequest();
    $rules = $request->rules();

    expect($rules['requestId'])->toContain('exists:vacation_requests,id');
});

it('validates type is one of allowed values', function () {
    $request = new VacationRequestActionRequest();
    $rules = $request->rules();

    expect($rules['type'])->toContain('in:pending,approved');
});

it('has custom error messages', function () {
    $request = new VacationRequestActionRequest();
    $messages = $request->messages();

    expect($messages)->toHaveKey('requestId.required')
        ->and($messages)->toHaveKey('requestId.exists')
        ->and($messages)->toHaveKey('type.required')
        ->and($messages)->toHaveKey('type.in');
});

it('validates request data correctly', function () {
    // Create vacation request
    $request = new VacationRequestActionRequest();
    $validator = validator([
        'requestId' => 1,
        'type' => 'pending'
    ], $request->rules());

    expect($validator->passes())->toBeTrue();
})->todo();

it('fails validation with invalid data', function () {
    $request = new VacationRequestActionRequest();
    $validator = validator([
        'requestId' => 999999, // Non-existent ID
        'type' => 'invalid_type'
    ], $request->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('requestId'))->toBeTrue()
        ->and($validator->errors()->has('type'))->toBeTrue();
});
