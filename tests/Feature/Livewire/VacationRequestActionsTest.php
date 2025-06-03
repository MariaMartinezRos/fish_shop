<?php

use App\Livewire\VacationRequestActions;
use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;

it('shows vacation request modal', function () {
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    $employee = User::factory()->create();
    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Livewire::actingAs($admin)
        ->test(VacationRequestActions::class)
        ->call('showVacationModal', $vacationRequest->id, 'pending')
        ->assertSet('showModal', true)
        ->assertSet('modalType', 'pending')
        ->assertSet('requestId', $vacationRequest->id)
        ->assertSet('type', 'pending');

});

it('approves vacation request when admin', function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Create employee and vacation request
    $employee = User::factory()->create();
    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Livewire::actingAs($admin)
        ->test(VacationRequestActions::class)
        ->set('vacationRequest', $vacationRequest)
        ->call('approveRequest')
        ->assertSet('showModal', false)
        ->assertDispatched('vacationRequestUpdated');

    expect($vacationRequest->fresh()->status)->toBe('approved');
});

it('rejects vacation request when admin', function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Create employee and vacation request
    $employee = User::factory()->create();
    $vacationRequest = VacationRequest::create([
        'user_id' => $employee->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Livewire::actingAs($admin)
        ->test(VacationRequestActions::class)
        ->set('vacationRequest', $vacationRequest)
        ->call('rejectRequest')
        ->assertSet('showModal', false)
        ->assertDispatched('vacationRequestUpdated');

    expect($vacationRequest->fresh()->status)->toBe('rejected');
});

it('does not allow non-admin to approve request', function () {
    // Create regular user
    $user = User::factory()->create();

    // Create vacation request
    $vacationRequest = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Livewire::actingAs($user)
        ->test(VacationRequestActions::class)
        ->set('vacationRequest', $vacationRequest)
        ->call('approveRequest');

    expect($vacationRequest->fresh()->status)->toBe('pending');
});

it('does not allow non-admin to reject request', function () {
    // Create regular user
    $user = User::factory()->create();

    // Create vacation request
    $vacationRequest = VacationRequest::create([
        'user_id' => $user->id,
        'start_date' => now(),
        'end_date' => now()->addDays(5),
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Livewire::actingAs($user)
        ->test(VacationRequestActions::class)
        ->set('vacationRequest', $vacationRequest)
        ->call('rejectRequest');

    expect($vacationRequest->fresh()->status)->toBe('pending');
});
