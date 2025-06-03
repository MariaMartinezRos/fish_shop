<?php

use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Role;

it('can create a vacation request', function () {
    $user = User::factory()->create();
    $vacationRequest = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    expect($vacationRequest)->toBeInstanceOf(VacationRequest::class)
        ->and($vacationRequest->user_id)->toBe($user->id)
        ->and($vacationRequest->comments)->toBe('Test vacation request')
        ->and($vacationRequest->status)->toBe('pending');
});

it('casts dates correctly', function () {
    $user = User::factory()->create();
    $startDate = now();
    $endDate = now()->addDays(5);
    
    $vacationRequest = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    expect($vacationRequest->start_date)->toBeInstanceOf(\Carbon\Carbon::class)
        ->and($vacationRequest->end_date)->toBeInstanceOf(\Carbon\Carbon::class);
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $vacationRequest = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    expect($vacationRequest->user)->toBeInstanceOf(User::class)
        ->and($vacationRequest->user->id)->toBe($user->id);
});

it('validates required fields', function () {
    $vacationRequest = new VacationRequest();
    
    expect(fn() => $vacationRequest->save())->toThrow(\Illuminate\Database\QueryException::class);
}); 