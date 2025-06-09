<?php

use App\Models\User;
use App\Policies\EmployeeHomePolicy;

beforeEach(function () {
    $this->policy = new EmployeeHomePolicy;
    $this->regularUser = User::factory()->create(['role_id' => 3]);
    $this->employee = User::factory()->create(['role_id' => 2]);
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('denies access to null user', function () {
    expect($this->policy->view(null))->toBeFalse();
});

it('denies access to regular user', function () {
    expect($this->policy->view($this->regularUser))->toBeFalse();
});

it('allows access to employee', function () {
    expect($this->policy->view($this->employee))->toBeTrue();
});

it('allows access to admin', function () {
    expect($this->policy->view($this->admin))->toBeTrue();
});
