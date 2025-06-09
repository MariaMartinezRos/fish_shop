<?php


it('shows chekbox component', function () {
    $employee = \App\Models\User::factory()->create(['role_id' => 2]);
    $this->actingAs($employee)->get(route('employee.vacation-request'))
        ->assertSee('Reconozco que he leído y acepto la política de vacaciones de la empresa');
});
//
// use App\Models\Role;
// use App\Models\User;
// use App\Models\VacationRequest;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Livewire\Livewire;
//
// uses(RefreshDatabase::class);
//
// // Setup: roles y usuarios
// beforeEach(function () {
//    $employeeRole = Role::create([
//        'name' => 'employee',
//        'display_name' => 'Employee',
//        'description' => 'Employee role',
//    ]);
//
//    $adminRole = Role::create([
//        'name' => 'admin',
//        'display_name' => 'Administrator',
//        'description' => 'Administrator role',
//    ]);
//
//    $this->employee = User::factory()->create([
//        'role_id' => $employeeRole->id,
//    ]);
//
//    $this->admin = User::factory()->create([
//        'role_id' => $adminRole->id,
//    ]);
// });
//
// it('allows employee to submit vacation request', function () {
//    $this->actingAs($this->employee);
//
//    $response = Livewire::test('employee.vacation-request-form')
//        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
//        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
//        ->set('comments', 'I need a vacation for personal reasons')
//        ->set('policy_acknowledged', true)
//        ->call('submit');
//
//    $response->assertSee('Vacation request submitted successfully!');
//
//    $this->assertDatabaseHas('vacation_requests', [
//        'user_id' => $this->employee->id,
//        'status' => 'pending',
//    ]);
// });
//
// it('requires policy acknowledgment for vacation request', function () {
//    $this->actingAs($this->employee);
//
//    $response = Livewire::test('employee.vacation-request-form')
//        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
//        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
//        ->set('comments', 'I need a vacation for personal reasons')
//        ->set('policy_acknowledged', false)
//        ->call('submit');
//
//    $response->assertHasErrors(['policy_acknowledged']);
// });
//
// it('allows admin to approve vacation request', function () {
//    $this->actingAs($this->admin);
//
//    $vacationRequest = VacationRequest::create([
//        'user_id' => $this->employee->id,
//        'start_date' => now()->addDays(5),
//        'end_date' => now()->addDays(10),
//        'comments' => 'Test vacation request',
//        'status' => 'pending',
//    ]);
//
//    Livewire::test('vacation-request-actions')
//        ->call('showVacationModal', $vacationRequest->id, 'pending')
//        ->call('approveRequest');
//
//    $this->assertDatabaseHas('vacation_requests', [
//        'id' => $vacationRequest->id,
//        'status' => 'approved',
//    ]);
// });
//
// it('allows admin to reject vacation request', function () {
//    $this->actingAs($this->admin);
//
//    $vacationRequest = VacationRequest::create([
//        'user_id' => $this->employee->id,
//        'start_date' => now()->addDays(5),
//        'end_date' => now()->addDays(10),
//        'comments' => 'Test vacation request',
//        'status' => 'pending',
//    ]);
//
//    Livewire::test('vacation-request-actions')
//        ->call('showVacationModal', $vacationRequest->id, 'pending')
//        ->call('rejectRequest');
//
//    $this->assertDatabaseHas('vacation_requests', [
//        'id' => $vacationRequest->id,
//        'status' => 'rejected',
//    ]);
// });
//
// it('allows admin to view approved vacation details', function () {
//    $this->actingAs($this->admin);
//
//    $vacationRequest = VacationRequest::create([
//        'user_id' => $this->employee->id,
//        'start_date' => now()->addDays(5),
//        'end_date' => now()->addDays(10),
//        'comments' => 'Test vacation request',
//        'status' => 'approved',
//    ]);
//
//    $response = Livewire::test('vacation-request-actions')
//        ->call('showVacationModal', $vacationRequest->id, 'approved');
//
//    $response->assertSee($this->employee->name);
//    $response->assertSee($vacationRequest->start_date->format('Y-m-d'));
//    $response->assertSee($vacationRequest->end_date->format('Y-m-d'));
// });
//
// it('prevents employee from approving own vacation request', function () {
//    $this->actingAs($this->employee);
//
//    $vacationRequest = VacationRequest::create([
//        'user_id' => $this->employee->id,
//        'start_date' => now()->addDays(5),
//        'end_date' => now()->addDays(10),
//        'comments' => 'Test vacation request',
//        'status' => 'pending',
//    ]);
//
//    Livewire::test('vacation-request-actions')
//        ->call('showVacationModal', $vacationRequest->id, 'pending')
//        ->call('approveRequest');
//
//    $this->assertDatabaseHas('vacation_requests', [
//        'id' => $vacationRequest->id,
//        'status' => 'pending',
//    ]);
// });
//
// it('validates that vacation start date is not in the past', function () {
//    $this->actingAs($this->employee);
//
//    $response = Livewire::test('employee.vacation-request-form')
//        ->set('start_date', now()->subDays(1)->format('Y-m-d'))
//        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
//        ->set('comments', 'I need a vacation for personal reasons')
//        ->set('policy_acknowledged', true)
//        ->call('submit');
//
//    $response->assertHasErrors(['start_date']);
// });
//
// it('requires end date to be after start date', function () {
//    $this->actingAs($this->employee);
//
//    $response = Livewire::test('employee.vacation-request-form')
//        ->set('start_date', now()->addDays(10)->format('Y-m-d'))
//        ->set('end_date', now()->addDays(5)->format('Y-m-d'))
//        ->set('comments', 'I need a vacation for personal reasons')
//        ->set('policy_acknowledged', true)
//        ->call('submit');
//
//    $response->assertHasErrors(['end_date']);
// });
//
// it('requires comments with minimum length', function () {
//    $this->actingAs($this->employee);
//
//    $response = Livewire::test('employee.vacation-request-form')
//        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
//        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
//        ->set('comments', 'Short')
//        ->set('policy_acknowledged', true)
//        ->call('submit');
//
//    $response->assertHasErrors(['comments']);
// });
//
