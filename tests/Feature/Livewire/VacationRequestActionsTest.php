<?php

use App\Livewire\VacationRequestActions;
use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Role;
use Livewire\Livewire;

beforeEach(function () {
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->admin = User::factory()->create(['role_id' => $adminRole->id]);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);
});

it('shows modal for approval', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->call('showVacationModal', $request->id, 'approve')
        ->assertSet('showModal', true)
        ->assertSet('action', 'approve')
        ->assertSet('requestId', $request->id);
});

it('approves vacation request', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', $request->id)
        ->set('comments', 'Approved with comments')
        ->call('approveRequest')
        ->assertSet('showModal', false);

    expect(VacationRequest::find($request->id))->status->toBe('approved');
});

it('rejects vacation request', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', $request->id)
        ->set('comments', 'Rejected with comments')
        ->call('rejectRequest')
        ->assertSet('showModal', false);

    expect(VacationRequest::find($request->id))->status->toBe('rejected');
});

it('does not approve without comments', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', $request->id)
        ->call('approveRequest')
        ->assertHasErrors(['comments']);
});

it('does not reject without comments', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', $request->id)
        ->call('rejectRequest')
        ->assertHasErrors(['comments']);
});

it('validates required comments', function () {
    // TODO: Fix ModelNotFoundException for invalid-type
    // Error: No query results for model [App\Models\VacationRequest] invalid-type
    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', 'invalid-type')
        ->call('approveRequest')
        ->assertHasErrors(['comments']);
});

it('closes modal', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('showModal', true)
        ->set('requestId', $request->id)
        ->call('closeModal')
        ->assertSet('showModal', false)
        ->assertSet('requestId', null);
});

it('shows correct modal title', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->call('showVacationModal', $request->id, 'approve')
        ->assertSee('Aprobar Solicitud de Vacaciones');
});

it('dispatches event after update', function () {
    // TODO: Fix ModelNotFoundException for pending status
    // Error: No query results for model [App\Models\VacationRequest] pending
    $request = VacationRequest::factory()->create([
        'status' => 'pending',
        'user_id' => $this->employee->id
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestActions::class)
        ->set('requestId', $request->id)
        ->set('comments', 'Approved with comments')
        ->call('approveRequest')
        ->assertDispatched('vacationRequestUpdated');
}); 