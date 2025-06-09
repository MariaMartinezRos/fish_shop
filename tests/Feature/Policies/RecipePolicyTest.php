<?php

use App\Models\User;
use App\Policies\RecipePolicy;

beforeEach(function () {
    $this->policy = new RecipePolicy;
    $this->regularUser = User::factory()->create(['role_id' => 3]);
    $this->employee = User::factory()->create(['role_id' => 2]);
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('allows null user to view any recipes', function () {
    expect($this->policy->viewAny(null))->toBeTrue();
});

it('allows regular user to view any recipes', function () {
    expect($this->policy->viewAny($this->regularUser))->toBeTrue();
});

it('allows employee to view any recipes', function () {
    expect($this->policy->viewAny($this->employee))->toBeTrue();
});

it('allows admin to view any recipes', function () {
    expect($this->policy->viewAny($this->admin))->toBeTrue();
});

it('allows null user to view specific recipe', function () {
    expect($this->policy->view(null))->toBeTrue();
});

it('allows regular user to view specific recipe', function () {
    expect($this->policy->view($this->regularUser))->toBeTrue();
});

it('allows employee to view specific recipe', function () {
    expect($this->policy->view($this->employee))->toBeTrue();
});

it('allows admin to view specific recipe', function () {
    expect($this->policy->view($this->admin))->toBeTrue();
});
