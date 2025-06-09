<?php

use App\Models\User;
use App\Policies\PdfPolicy;

beforeEach(function () {
    $this->policy = new PdfPolicy;
    $this->regularUser = User::factory()->create(['role_id' => 3]);
    $this->employee = User::factory()->create(['role_id' => 2]);
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('allows pdf generation to regular user', function () {
    expect($this->policy->generate($this->regularUser))->toBeTrue();
});

it('allows pdf generation to employee', function () {
    expect($this->policy->generate($this->employee))->toBeTrue();
});

it('allows pdf generation to admin', function () {
    expect($this->policy->generate($this->admin))->toBeTrue();
});
