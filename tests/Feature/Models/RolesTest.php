<?php

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has a HasMany relation with users', function () {
    $role = new Role;
    expect($role->users())->toBeInstanceOf(HasMany::class);
});

it('can be created with fillable fields', function () {
    $data = [
        'name' => 'admin',
        'display_name' => 'Administrator',
        'description' => 'Full access',
    ];

    $role = Role::create($data);

    expect($role->name)->toBe($data['name'])
        ->and($role->display_name)->toBe($data['display_name'])
        ->and($role->description)->toBe($data['description']);
});
