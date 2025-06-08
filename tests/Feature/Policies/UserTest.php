<?php

use App\Models\User;
use App\Policies\UserPolicy;

beforeEach(function () {
    $this->admin = User::factory()->create(['role_id' => 1]);
    $this->client = User::factory()->create(['role_id' => 4]);

    $this->policy = new UserPolicy;
});

it('allows only admin to create users', function () {
    expect($this->policy->create($this->admin))->toBeTrue()
        ->and($this->policy->create($this->client))->toBeFalse();
});

it('allows only admin to update users', function () {
    expect($this->policy->update($this->admin))->toBeTrue()
        ->and($this->policy->update($this->client))->toBeFalse();
});

it('allows only admin to delete users', function () {
    expect($this->policy->delete($this->admin))->toBeTrue()
        ->and($this->policy->delete($this->client))->toBeFalse();
});

it('allows only admin to authorize', function () {
    expect($this->policy->authorize($this->admin))->toBeTrue()
        ->and($this->policy->authorize($this->client))->toBeFalse();
});

it('allows only admin to view users', function () {
    expect($this->policy->view($this->admin))->toBeTrue()
        ->and($this->policy->view($this->client))->toBeFalse();
});

it('allows anyone to view client section', function () {
    expect($this->policy->viewClient())->toBeTrue();
});

it('allows only admin to restore users', function () {
    expect($this->policy->restore($this->admin))->toBeTrue()
        ->and($this->policy->restore($this->client))->toBeFalse();
});

it('allows only admin to force delete users', function () {
    expect($this->policy->forceDelete($this->admin))->toBeTrue()
        ->and($this->policy->forceDelete($this->client))->toBeFalse();
});
