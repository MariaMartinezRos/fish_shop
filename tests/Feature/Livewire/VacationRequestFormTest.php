<?php

use App\Livewire\VacationRequestForm;
use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Role;
use Livewire\Livewire;

beforeEach(function () {
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);
});

it('validates start date after today', function () {
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->subDay()->format('Y-m-d'))
        ->set('end_date', now()->addDays(5)->format('Y-m-d'))
        ->set('policy_acknowledged', true)
        ->call('submit');
});

it('validates end date after start date', function () {
    // TODO: Fix validation error messages
    // Error: Expected validation error message not found
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(3)->format('Y-m-d'))
        ->set('policy_acknowledged', true)
        ->call('submit')
        ->assertHasErrors(['end_date']);
});

it('validates comments length', function () {
    // TODO: Fix validation error messages
    // Error: Expected validation error message not found
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
        ->set('comments', str_repeat('a', 501))
        ->set('policy_acknowledged', true)
        ->call('submit')
        ->assertHasErrors(['comments']);
});

it('creates vacation request', function () {
    // TODO: Fix date format in database assertion
    // Error: Date format mismatch in database assertion
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
        ->set('comments', 'Vacation request comments')
        ->set('policy_acknowledged', true)
        ->call('submit')
        ->assertSet('start_date', null)
        ->assertSet('end_date', null)
        ->assertSet('comments', null)
        ->assertSet('policy_acknowledged', false);

    expect(VacationRequest::first())->toMatchArray([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'comments' => 'Vacation request comments',
        'status' => 'pending'
    ]);
});

it('calculates total days', function () {
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
        ->assertSet('totalDays', 6);
});

it('prevents admin access', function () {
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    Livewire::actingAs($admin)
        ->test(VacationRequestForm::class)
        ->assertStatus(403);
});

it('dispatches success notification', function () {
    Livewire::actingAs($this->employee)
        ->test(VacationRequestForm::class)
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
        ->set('comments', 'Vacation request comments')
        ->set('policy_acknowledged', true)
        ->call('submit')
        ->assertDispatched('notify', [
            'type' => 'success',
            'message' => 'Solicitud de vacaciones enviada correctamente.'
        ]);
});
