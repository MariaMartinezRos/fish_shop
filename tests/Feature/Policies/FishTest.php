<?php

use App\Models\User;
use App\Policies\FishPolicy;

beforeEach(function () {
    $this->role_admin = \App\Models\Role::factory()->create(['name' => 'admin']);
    $this->role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 3]);

    $this->admin = User::factory()->create(['role_id' => $this->role_admin->id]);
    $this->client = User::factory()->create(['role_id' => $this->role_customer->id]);

    $this->policy = new FishPolicy();
});

it('allows anyone to view any fish', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue()
        ->and($this->policy->viewAny($this->client))->toBeTrue();
});

it('allows anyone to view individual fish', function () {
    expect($this->policy->view($this->admin))->toBeTrue()
        ->and($this->policy->view($this->client))->toBeTrue();
});

it('allows only admin to create fish', function () {
    expect($this->policy->create($this->admin))->toBeTrue()
        ->and($this->policy->create($this->client))->toBeFalse();
});

it('allows only admin to update fish', function () {
    expect($this->policy->update($this->admin))->toBeTrue()
        ->and($this->policy->update($this->client))->toBeFalse();
});

it('allows only admin to delete fish', function () {
    expect($this->policy->delete($this->admin))->toBeTrue()
        ->and($this->policy->delete($this->client))->toBeFalse();
});

it('allows only admin to restore fish', function () {
    expect($this->policy->restore($this->admin))->toBeTrue()
        ->and($this->policy->restore($this->client))->toBeFalse();
});

it('allows only admin to force delete fish', function () {
    expect($this->policy->forceDelete($this->admin))->toBeTrue()
        ->and($this->policy->forceDelete($this->client))->toBeFalse();
});
