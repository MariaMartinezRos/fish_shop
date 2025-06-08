<?php

use App\Models\User;
use App\Policies\FishPolicy;

beforeEach(function () {
    $this->admin = User::factory()->create(['role_id' => 1]);
    $this->client = User::factory()->create(['role_id' => 4]);

    $this->policy = new FishPolicy;
});

it('allows only admin to view any fish', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue()
        ->and($this->policy->viewAny($this->client))->toBeFalse();
});

it('allows admin to view individual fish', function () {
    expect($this->policy->view($this->admin))->toBeTrue()
        ->and($this->policy->view($this->client))->toBeFalse();
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
