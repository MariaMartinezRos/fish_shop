<?php

use App\Jobs\VacationRequestEmailJob;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create admin role and user
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $this->admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Create employee role and user
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $this->employee = User::factory()->create(['role_id' => $employeeRole->id]);

    // Create another employee
    $this->otherEmployee = User::factory()->create(['role_id' => $employeeRole->id]);

    // Create a vacation request
    $this->vacationRequest = VacationRequest::factory()->create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'status' => 'pending'
    ]);
});

it('shows all vacation requests to admin', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('vacation-requests.index'));

    $response->assertStatus(200)
        ->assertViewIs('vacation-requests.index')
        ->assertViewHas('vacationRequests');
});

it('shows only own vacation requests to employee', function () {
    // Create a vacation request for another employee
    VacationRequest::factory()->create([
        'user_id' => $this->otherEmployee->id
    ]);

    $response = $this->actingAs($this->employee)
        ->get(route('vacation-requests.index'));

    $response->assertStatus(200)
        ->assertViewIs('vacation-requests.index')
        ->assertViewHas('vacationRequests')
        ->assertViewHas('vacationRequests', function ($vacationRequests) {
            return $vacationRequests->count() === 1 && 
                   $vacationRequests->first()->user_id === $this->employee->id;
        });
});

it('shows create form to employee', function () {
    $response = $this->actingAs($this->employee)
        ->get(route('vacation-requests.create'));

    $response->assertStatus(200)
        ->assertViewIs('vacation-requests.create');
});

it('prevents admin from accessing create form', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('vacation-requests.create'));

    $response->assertStatus(403);
});

it('stores new vacation request', function () {
    Queue::fake();

    $vacationData = [
        'start_date' => now()->addDays(5)->format('Y-m-d'),
        'end_date' => now()->addDays(10)->format('Y-m-d'),
        'comments' => 'Test vacation request',
        'policy_acknowledged' => true
    ];

    $response = $this->actingAs($this->employee)
        ->post(route('vacation-requests.store'), $vacationData);

    $response->assertRedirect(route('vacation-requests.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('vacation_requests', [
        'user_id' => $this->employee->id,
        'comments' => 'Test vacation request',
        'status' => 'pending'
    ]);

    Queue::assertPushed(VacationRequestEmailJob::class);
});

it('shows vacation request details', function () {
    $response = $this->actingAs($this->employee)
        ->get(route('vacation-requests.show', $this->vacationRequest));

    $response->assertStatus(200)
        ->assertViewIs('vacation-requests.show')
        ->assertViewHas('vacationRequest');
});

it('prevents viewing other employees vacation requests', function () {
    $response = $this->actingAs($this->otherEmployee)
        ->get(route('vacation-requests.show', $this->vacationRequest));

    $response->assertStatus(403);
});

it('shows edit form for own pending vacation request', function () {
    $response = $this->actingAs($this->employee)
        ->get(route('vacation-requests.edit', $this->vacationRequest));

    $response->assertStatus(200)
        ->assertViewIs('vacation-requests.edit')
        ->assertViewHas('vacationRequest');
});

it('prevents editing approved vacation request', function () {
    $this->vacationRequest->update(['status' => 'approved']);

    $response = $this->actingAs($this->employee)
        ->get(route('vacation-requests.edit', $this->vacationRequest));

    $response->assertStatus(403);
});

it('updates vacation request', function () {
    $updateData = [
        'start_date' => now()->addDays(6)->format('Y-m-d'),
        'end_date' => now()->addDays(11)->format('Y-m-d'),
        'comments' => 'Updated vacation request',
        'policy_acknowledged' => true
    ];

    $response = $this->actingAs($this->employee)
        ->put(route('vacation-requests.update', $this->vacationRequest), $updateData);

    $response->assertRedirect(route('vacation-requests.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('vacation_requests', [
        'id' => $this->vacationRequest->id,
        'comments' => 'Updated vacation request'
    ]);
});

it('deletes vacation request', function () {
    $response = $this->actingAs($this->employee)
        ->delete(route('vacation-requests.destroy', $this->vacationRequest));

    $response->assertRedirect(route('vacation-requests.index'))
        ->assertSessionHas('success');

    $this->assertSoftDeleted('vacation_requests', [
        'id' => $this->vacationRequest->id
    ]);
});

it('prevents deleting approved vacation request', function () {
    $this->vacationRequest->update(['status' => 'approved']);

    $response = $this->actingAs($this->employee)
        ->delete(route('vacation-requests.destroy', $this->vacationRequest));

    $response->assertStatus(403);
}); 