<?php

use App\Models\User;
use App\Policies\ContactPolicy;

beforeEach(function () {
    $this->policy = new ContactPolicy();
    $this->regularUser = User::factory()->create(['role_id' => 3]);
    $this->employee = User::factory()->create(['role_id' => 2]);
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('allows null user to submit contact form', function () {
    expect($this->policy->submit(null))->toBeTrue();
});

it('allows regular user to submit contact form', function () {
    expect($this->policy->submit($this->regularUser))->toBeTrue();
});

it('allows employee to submit contact form', function () {
    expect($this->policy->submit($this->employee))->toBeTrue();
});

it('allows admin to submit contact form', function () {
    expect($this->policy->submit($this->admin))->toBeTrue();
}); 