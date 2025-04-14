<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

it('uses SoftDeletes on User model', function () {
    expect(class_uses_recursive(User::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in users table', function () {
    expect(Schema::hasColumn('users', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on Category model', function () {
    expect(class_uses_recursive(\App\Models\Category::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in categories table', function () {
    expect(Schema::hasColumn('categories', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on Fish model', function () {
    expect(class_uses_recursive(\App\Models\Fish::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in fishes table', function () {
    expect(Schema::hasColumn('fishes', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on Product model', function () {
    expect(class_uses_recursive(\App\Models\Product::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in products table', function () {
    expect(Schema::hasColumn('products', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on Role model', function () {
    expect(class_uses_recursive(\App\Models\Role::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in roles table', function () {
    expect(Schema::hasColumn('roles', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on Transaction model', function () {
    expect(class_uses_recursive(\App\Models\Transaction::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in transactions table', function () {
    expect(Schema::hasColumn('transactions', 'deleted_at'))->toBeTrue();
});

it('uses SoftDeletes on TypeWater model', function () {
    expect(class_uses_recursive(\App\Models\TypeWater::class))->toContain(SoftDeletes::class);
});

it('has deleted_at column in type_water table', function () {
    expect(Schema::hasColumn('type_water', 'deleted_at'))->toBeTrue();
});


