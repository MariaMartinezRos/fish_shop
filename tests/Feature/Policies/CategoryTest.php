<?php

use App\Models\User;
use App\Policies\CategoryPolicy;

beforeEach(function () {
    $this->role_admin = \App\Models\Role::factory()->create(['name' => 'admin']);
    $this->role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 3]);

    $this->admin = User::factory()->create(['role_id' => $this->role_admin->id]);
    $this->client = User::factory()->create(['role_id' => $this->role_customer->id]);

    $this->policy = new CategoryPolicy();
});

it('allows anyone to view any categories', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue()
        ->and($this->policy->viewAny($this->client))->toBeTrue();
});

it('allows anyone to view individual categories', function () {
    expect($this->policy->view($this->admin))->toBeTrue()
        ->and($this->policy->view($this->client))->toBeTrue();
});

it('allows only admin to create categories', function () {
    expect($this->policy->create($this->admin))->toBeTrue()
        ->and($this->policy->create($this->client))->toBeFalse();
});

it('allows only admin to update categories', function () {
    expect($this->policy->update($this->admin))->toBeTrue()
        ->and($this->policy->update($this->client))->toBeFalse();
});

it('allows only admin to delete categories', function () {
    $category = \App\Models\Category::factory()->create();
    expect($this->policy->delete($this->admin, $category))->toBeTrue()
        ->and($this->policy->delete($this->client, $category))->toBeFalse();
});

it('allows only admin to restore categories', function () {
    expect($this->policy->restore($this->admin))->toBeTrue()
        ->and($this->policy->restore($this->client))->toBeFalse();
});

it('allows only admin to force delete categories', function () {
    $category = \App\Models\Category::factory()->create();
    expect($this->policy->forceDelete($this->admin, $category))->toBeTrue()
        ->and($this->policy->forceDelete($this->client, $category))->toBeFalse();
});
