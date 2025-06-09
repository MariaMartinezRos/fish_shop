<?php

//
// use App\Models\Role;
// use App\Models\User;
// use App\Models\VacationRequest;
// use App\Policies\VacationRequestPolicy;
//
// beforeEach(function () {
//    $this->adminRole = Role::factory()->create(['name' => 'admin']);
//    $this->employeeRole = Role::factory()->create(['name' => 'employee']);
//
//    $this->admin = User::factory()->create(['role_id' => $this->adminRole->id]);
//    $this->employee = User::factory()->create(['role_id' => $this->employeeRole->id]);
//
//    $this->policy = new VacationRequestPolicy();
// });
//
// it('allows admin to view any vacation request', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->view($this->admin, $vacationRequest))->toBeTrue();
// });
//
// it('allows employees to view their own vacation requests', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->view($this->employee, $vacationRequest))->toBeTrue();
// });
//
// it('prevents employees from viewing other employees vacation requests', function () {
//    $otherEmployee = User::factory()->create(['role_id' => $this->employeeRole->id]);
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $otherEmployee->id
//    ]);
//
//    expect($this->policy->view($this->employee, $vacationRequest))->toBeFalse();
// });
//
// it('allows admin to create vacation requests for any employee', function () {
//    expect($this->policy->create($this->admin))->toBeTrue();
// });
//
// it('allows employees to create their own vacation requests', function () {
//    expect($this->policy->create($this->employee))->toBeTrue();
// });
//
// it('allows admin to update any vacation request', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->update($this->admin, $vacationRequest))->toBeTrue();
// });
//
// it('prevents employees from updating vacation requests', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->update($this->employee, $vacationRequest))->toBeFalse();
// });
//
// it('allows admin to delete any vacation request', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->delete($this->admin, $vacationRequest))->toBeTrue();
// });
//
// it('prevents employees from deleting vacation requests', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->delete($this->employee, $vacationRequest))->toBeFalse();
// });
//
// it('allows admin to restore any vacation request', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->restore($this->admin, $vacationRequest))->toBeTrue();
// });
//
// it('prevents employees from restoring vacation requests', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->restore($this->employee, $vacationRequest))->toBeFalse();
// });
//
// it('allows admin to force delete any vacation request', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->forceDelete($this->admin, $vacationRequest))->toBeTrue();
// });
//
// it('prevents employees from force deleting vacation requests', function () {
//    $vacationRequest = VacationRequest::factory()->create([
//        'user_id' => $this->employee->id
//    ]);
//
//    expect($this->policy->forceDelete($this->employee, $vacationRequest))->toBeFalse();
// });

use App\Models\User;
use App\Models\VacationRequest;
use App\Policies\VacationRequestPolicy;

beforeEach(function () {
    $this->policy = new VacationRequestPolicy;
    $this->regularUser = User::factory()->create(['role_id' => 3]);
    $this->employee = User::factory()->create(['role_id' => 2]);
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('denies regular user from viewing all vacation requests', function () {
    expect($this->policy->viewAny($this->regularUser))->toBeFalse();
});

it('denies employee from viewing all vacation requests', function () {
    expect($this->policy->viewAny($this->employee))->toBeFalse();
});

it('allows admin to view all vacation requests', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue();
});

it('denies regular user from creating vacation requests', function () {
    expect($this->policy->create($this->regularUser))->toBeFalse();
});

it('allows employee to create vacation requests', function () {
    expect($this->policy->create($this->employee))->toBeTrue();
});

it('allows admin to create vacation requests', function () {
    expect($this->policy->create($this->admin))->toBeTrue();
});

it('denies regular user from updating vacation requests', function () {
    expect($this->policy->update($this->regularUser))->toBeFalse();
});

it('allows employee to update vacation requests', function () {
    expect($this->policy->update($this->employee))->toBeTrue();
});

it('allows admin to update vacation requests', function () {
    expect($this->policy->update($this->admin))->toBeTrue();
});

it('denies regular user from deleting vacation requests', function () {
    expect($this->policy->delete($this->regularUser))->toBeFalse();
});

it('allows employee to delete vacation requests', function () {
    expect($this->policy->delete($this->employee))->toBeTrue();
});

it('allows admin to delete vacation requests', function () {
    expect($this->policy->delete($this->admin))->toBeTrue();
});
