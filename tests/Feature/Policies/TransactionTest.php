<?php

use App\Models\User;
use App\Policies\TransactionPolicy;

beforeEach(function () {
    $this->role_admin = \App\Models\Role::factory()->create(['name' => 'admin']);
    $this->role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 3]);

    $this->admin = User::factory()->create(['role_id' => $this->role_admin->id]);
    $this->client = User::factory()->create(['role_id' => $this->role_customer->id]);

    $this->policy = new TransactionPolicy;
});

it('allows only admin to view any transactions', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue()
        ->and($this->policy->viewAny($this->client))->toBeFalse();
});

it('does not allows any authenticated user to create transactions', function () {
    expect($this->policy->create($this->admin))->toBeTrue()
        ->and($this->policy->create($this->client))->toBeFalse();
});

it('allows only admin to update transactions', function () {
    expect($this->policy->update($this->admin))->toBeTrue()
        ->and($this->policy->update($this->client))->toBeFalse();
});

it('allows only admin to delete transactions', function () {
    expect($this->policy->delete($this->admin))->toBeTrue()
        ->and($this->policy->delete($this->client))->toBeFalse();
});
