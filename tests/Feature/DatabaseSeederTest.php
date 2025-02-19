<?php

use App\Models\Category;
use App\Models\Fish;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\TypeWater;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

//uses(RefreshDatabase::class);

it('adds given category', function () {
    //Assert
    $this->assertDatabaseCount(Category::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(Category::class, 5);
    $this->assertDatabaseHas(Category::class, ['name' => 'fresh']);
    $this->assertDatabaseHas(Category::class, ['name' => 'frozen']);
    $this->assertDatabaseHas(Category::class, ['name' => 'cut']);
    $this->assertDatabaseHas(Category::class, ['name' => 'seafood']);
    $this->assertDatabaseHas(Category::class, ['name' => 'other']);

});

it('adds given category only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Category::class, 5);
});

it('adds given product', function () {
    //Assert
    $this->assertDatabaseCount(Product::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(Product::class, 30);

});

it('adds given product only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Product::class, 30);
});

it('adds given role', function () {
    //Assert
    $this->assertDatabaseCount(Role::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(Role::class, 5);
    $this->assertDatabaseHas(Role::class, ['name' => 'admin']);
    $this->assertDatabaseHas(Role::class, ['name' => 'tpv']);
    $this->assertDatabaseHas(Role::class, ['name' => 'employee']);
    $this->assertDatabaseHas(Role::class, ['name' => 'customer']);
    $this->assertDatabaseHas(Role::class, ['name' => 'guest']);
});

it('adds given role only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Role::class, 5);
});

it('adds given transaction', function () {
    //Act
    $this->assertDatabaseCount(Transaction::class, 0);

    //Act
    $this->artisan('db:seed');
    $this->assertDatabaseCount(Transaction::class, 40);
    $this->assertDatabaseHas(Transaction::class, ['sale_id' => '101']);
});

it('adds given transaction only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Transaction::class, 40);
});

it('adds given user', function () {
    //Assert
    $this->assertDatabaseCount(User::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(User::class, 3);
    $this->assertDatabaseHas(User::class, ['email' => 'admin@admin.com']);
});

it('adds given user only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(User::class, 3);
});

it('adds given fish', function () {
    //Act
    $this->assertDatabaseCount(Fish::class, 0);

    //Act
    $this->artisan('db:seed');
    $this->assertDatabaseCount(Fish::class, 20);
});

it('adds given fish only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Fish::class, 20);
});

it('adds type of water', function () {
    //Act
    $this->assertDatabaseCount(TypeWater::class, 0);

    //Act
    $this->artisan('db:seed');
    $this->assertDatabaseHas(TypeWater::class, ['type' => 'Freshwater']);
    $this->assertDatabaseHas(TypeWater::class, ['type' => 'Saltwater']);
});

it('adds type of water only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(TypeWater::class, 2);
});
