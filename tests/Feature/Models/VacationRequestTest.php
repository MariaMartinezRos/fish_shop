<?php

use App\Models\User;
use App\Models\VacationRequest;
use Carbon\Carbon;

it('can create a vacation request with all attributes', function () {
    $user = User::factory()->create();
    $startDate = now();
    $endDate = now()->addDays(5);

    $request = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'comments' => 'Vacation request for family trip',
        'status' => 'pending'
    ]);

    expect($request)
        ->user_id->toBe($user->id)
        ->start_date->format('Y-m-d')->toBe($startDate->format('Y-m-d'))
        ->end_date->format('Y-m-d')->toBe($endDate->format('Y-m-d'))
        ->comments->toBe('Vacation request for family trip')
        ->status->toBe('pending');
});

it('casts dates correctly', function () {
    $request = VacationRequest::create([
        'user_id' => User::factory()->create()->id,
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-05',
        'comments' => 'Vacation request for family trip',
        'status' => 'pending'
    ]);

    expect($request->start_date)->toBeInstanceOf(Carbon::class)
        ->and($request->end_date)->toBeInstanceOf(Carbon::class);
});

it('can be associated with a user', function () {
    $user = User::factory()->create();
    $request = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Vacation request for family trip',
        'status' => 'pending'
    ]);

    expect($request->user)
        ->id->toBe($user->id);
});

it('calculates total days correctly', function () {
    $request = VacationRequest::create([
        'user_id' => User::factory()->create()->id,
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-05',
        'comments' => 'Vacation request for family trip',
        'status' => 'pending'
    ]);

    expect($request->totalDays())->toBe(5.0);
});

it('can update status', function () {
    $request = VacationRequest::create([
        'user_id' => User::factory()->create()->id,
        'start_date' => now(),
        'end_date' => now(),
        'comments' => 'Vacation request for family trip',
        'status' => 'pending'
    ]);

    $request->update(['status' => 'approved']);

    expect($request->fresh())
        ->status->toBe('approved');
});

it('can update comments', function () {
    $request = VacationRequest::create([
        'user_id' => User::factory()->create()->id,
        'start_date' => now(),
        'end_date' => now(),
        'status' => 'pending',
        'comments' => 'Initial comment'
    ]);

    $request->update(['comments' => 'Updated comment']);

    expect($request->fresh())
        ->comments->toBe('Updated comment');
});
