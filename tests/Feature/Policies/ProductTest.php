<?php

use App\Models\User;
use App\Policies\ProductPolicy;

beforeEach(function () {
    $this->admin = User::factory()->create(['role_id' => 1]);
    $this->client = User::factory()->create(['role_id' => 4]);

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
