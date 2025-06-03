<?php

use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;

beforeEach(function () {
    // Create employee role and user
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);
});

it('creates vacation request with correct attributes', function () {
    $vacationRequest = VacationRequest::create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    expect($vacationRequest->user_id)->toBe($this->employee->id);
    expect($vacationRequest->start_date)->toBeInstanceOf(\Carbon\Carbon::class);
    expect($vacationRequest->end_date)->toBeInstanceOf(\Carbon\Carbon::class);
    expect($vacationRequest->comments)->toBe('Test vacation request');
    expect($vacationRequest->status)->toBe('pending');
});

it('belongs to a user', function () {
    $vacationRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id
    ]);

    expect($vacationRequest->user)->toBeInstanceOf(User::class);
    expect($vacationRequest->user->id)->toBe($this->employee->id);
});

it('casts dates correctly', function () {
    $vacationRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10)
    ]);

    expect($vacationRequest->start_date)->toBeInstanceOf(\Carbon\Carbon::class);
    expect($vacationRequest->end_date)->toBeInstanceOf(\Carbon\Carbon::class);
});

it('has fillable attributes', function () {
    $vacationRequest = new VacationRequest();
    $fillable = $vacationRequest->getFillable();

    expect($fillable)->toContain('user_id');
    expect($fillable)->toContain('start_date');
    expect($fillable)->toContain('end_date');
    expect($fillable)->toContain('comments');
    expect($fillable)->toContain('status');
}); 