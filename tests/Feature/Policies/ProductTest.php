<?php

use App\Models\User;
use App\Policies\ProductPolicy;

beforeEach(function () {
    $this->role_admin = \App\Models\Role::factory()->create(['name' => 'admin']);
    $this->role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 3]);

    $this->admin = User::factory()->create(['role_id' => $this->role_admin->id]);
    $this->client = User::factory()->create(['role_id' => $this->role_customer->id]);

    $this->productPolicy = new ProductPolicy;
});

it('allows only admin to create products', function () {
    expect($this->productPolicy->create($this->admin))->toBeTrue()
        ->and($this->productPolicy->create($this->client))->toBeFalse();
});

it('allows only admin to update products', function () {
    expect($this->productPolicy->update($this->admin))->toBeTrue()
        ->and($this->productPolicy->update($this->client))->toBeFalse();
});

it('allows only admin to delete products', function () {
    expect($this->productPolicy->delete($this->admin))->toBeTrue()
        ->and($this->productPolicy->delete($this->client))->toBeFalse();
});

it('allows only admin to authorize product actions', function () {
    expect($this->productPolicy->authorize($this->admin))->toBeTrue()
        ->and($this->productPolicy->authorize($this->client))->toBeFalse();
});

it('allows anyone to view products', function () {
    expect($this->productPolicy->view($this->admin))->toBeTrue()
        ->and($this->productPolicy->view($this->client))->toBeTrue();
});

it('allows anyone to view client products', function () {
    expect($this->productPolicy->viewClient())->toBeTrue();
});

it('allows only admin to restore products', function () {
    expect($this->productPolicy->restore($this->admin))->toBeTrue()
        ->and($this->productPolicy->restore($this->client))->toBeFalse();
});

it('allows only admin to force delete products', function () {
    expect($this->productPolicy->forceDelete($this->admin))->toBeTrue()
        ->and($this->productPolicy->forceDelete($this->client))->toBeFalse();
});
