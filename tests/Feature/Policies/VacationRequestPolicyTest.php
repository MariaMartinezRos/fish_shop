<?php

use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use App\Policies\VacationRequestPolicy;

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
        'status' => 'pending'
    ]);

    $this->policy = new VacationRequestPolicy();
});

it('allows admin to view any vacation requests', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue();
});

it('prevents employee from viewing any vacation requests', function () {
    expect($this->policy->viewAny($this->employee))->toBeFalse();
});

it('allows admin to view any vacation request', function () {
    expect($this->policy->view($this->admin, $this->vacationRequest))->toBeTrue();
});

it('allows employee to view their own vacation request', function () {
    expect($this->policy->view($this->employee, $this->vacationRequest))->toBeTrue();
});

it('prevents employee from viewing other employees vacation requests', function () {
    expect($this->policy->view($this->otherEmployee, $this->vacationRequest))->toBeFalse();
});

it('allows employee to create vacation requests', function () {
    expect($this->policy->create($this->employee))->toBeTrue();
});

it('prevents admin from creating vacation requests', function () {
    expect($this->policy->create($this->admin))->toBeFalse();
});

it('allows admin to update any vacation request', function () {
    expect($this->policy->update($this->admin, $this->vacationRequest))->toBeTrue();
});

it('allows employee to update their own pending vacation request', function () {
    expect($this->policy->update($this->employee, $this->vacationRequest))->toBeTrue();
});

it('prevents employee from updating approved vacation request', function () {
    $this->vacationRequest->status = 'approved';
    expect($this->policy->update($this->employee, $this->vacationRequest))->toBeFalse();
});

it('prevents employee from updating other employees vacation requests', function () {
    expect($this->policy->update($this->otherEmployee, $this->vacationRequest))->toBeFalse();
});

it('allows admin to delete any vacation request', function () {
    expect($this->policy->delete($this->admin, $this->vacationRequest))->toBeTrue();
});

it('allows employee to delete their own pending vacation request', function () {
    expect($this->policy->delete($this->employee, $this->vacationRequest))->toBeTrue();
});

it('prevents employee from deleting approved vacation request', function () {
    $this->vacationRequest->status = 'approved';
    expect($this->policy->delete($this->employee, $this->vacationRequest))->toBeFalse();
});

it('prevents employee from deleting other employees vacation requests', function () {
    expect($this->policy->delete($this->otherEmployee, $this->vacationRequest))->toBeFalse();
});

it('allows admin to approve vacation requests', function () {
    expect($this->policy->approve($this->admin))->toBeTrue();
});

it('prevents employee from approving vacation requests', function () {
    expect($this->policy->approve($this->employee))->toBeFalse();
});

it('allows admin to reject vacation requests', function () {
    expect($this->policy->reject($this->admin))->toBeTrue();
});

it('prevents employee from rejecting vacation requests', function () {
    expect($this->policy->reject($this->employee))->toBeFalse();
}); 