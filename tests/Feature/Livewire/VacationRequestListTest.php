<?php

use App\Livewire\VacationRequestList;
use App\Models\User;
use App\Models\VacationRequest;
use Livewire\Livewire;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->employee = User::factory()->create(['is_admin' => false]);
});

it('displays vacation requests for admin', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    $request = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->assertSee($this->employee->name)
        ->assertSee($request->start_date->format('d/m/Y'))
        ->assertSee($request->end_date->format('d/m/Y'))
        ->assertSee('Pendiente');
});

it('displays only own requests for employee', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    $ownRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'pending'
    ]);

    $otherRequest = VacationRequest::factory()->create([
        'user_id' => $this->admin->id,
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->employee)
        ->test(VacationRequestList::class)
        ->assertSee($ownRequest->start_date->format('d/m/Y'))
        ->assertDontSee($otherRequest->start_date->format('d/m/Y'));
});

it('filters by status', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'pending'
    ]);

    VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'approved'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->set('status', 'pending')
        ->assertSee('Pendiente')
        ->assertDontSee('Aprobada')
        ->set('status', 'approved')
        ->assertSee('Aprobada')
        ->assertDontSee('Pendiente');
});

it('sorts by start date', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    $request1 = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(10),
        'status' => 'pending'
    ]);

    $request2 = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->call('sortBy', 'start_date')
        ->assertSeeInOrder([
            $request2->start_date->format('d/m/Y'),
            $request1->start_date->format('d/m/Y')
        ]);
});

it('sorts by end date', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    $request1 = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'end_date' => now()->addDays(10),
        'status' => 'pending'
    ]);

    $request2 = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'end_date' => now()->addDays(5),
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->call('sortBy', 'end_date')
        ->assertSeeInOrder([
            $request2->end_date->format('d/m/Y'),
            $request1->end_date->format('d/m/Y')
        ]);
});

it('sorts by status', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'rejected'
    ]);

    VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'approved'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->call('sortBy', 'status')
        ->assertSeeInOrder(['Aprobada', 'Rechazada']);
});

it('paginates results', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    VacationRequest::factory()->count(15)->create([
        'user_id' => $this->employee->id,
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->assertSee('Pendiente')
        ->assertDontSee('Página 2');
});

it('refreshes on vacation request update', function () {
    // TODO: Fix user display in view
    // Error: Expected user not found in view
    $request = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'status' => 'pending'
    ]);

    Livewire::actingAs($this->admin)
        ->test(VacationRequestList::class)
        ->assertSee('Pendiente')
        ->dispatch('vacationRequestUpdated')
        ->assertSee('Pendiente');
}); 