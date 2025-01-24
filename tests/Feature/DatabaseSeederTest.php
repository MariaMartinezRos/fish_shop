<?php


use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('adds given category', function () {
    //Assert
    $this->assertDatabaseCount(Category::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(Category::class, 4);
    $this->assertDatabaseHas(Category::class, ['name' => 'fresh']);
    $this->assertDatabaseHas(Category::class, ['name' => 'frozen']);
    $this->assertDatabaseHas(Category::class, ['name' => 'cut']);
    $this->assertDatabaseHas(Category::class, ['name' => 'seafood']);

});

it('adds given category only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Category::class, 4);
});

it('adds given product', function () {
    //Assert
    $this->assertDatabaseCount(Product::class, 0);

    //Act
    $this->artisan('db:seed');

    //Assert
    $this->assertDatabaseCount(Product::class, 31);
    $this->assertDatabaseHas(Product::class, ['name' => 'lubina']);
    $this->assertDatabaseHas(Product::class, ['name' => 'salmón']);
    $this->assertDatabaseHas(Product::class, ['name' => 'bacalao']);
    $this->assertDatabaseHas(Product::class, ['name' => 'merluza']);
    $this->assertDatabaseHas(Product::class, ['name' => 'mejillones']);
    $this->assertDatabaseHas(Product::class, ['name' => 'calamar']);
    $this->assertDatabaseHas(Product::class, ['name' => 'atún']);
    $this->assertDatabaseHas(Product::class, ['name' => 'trucha']);
    $this->assertDatabaseHas(Product::class, ['name' => 'rodaballo']);
    $this->assertDatabaseHas(Product::class, ['name' => 'rape']);
    $this->assertDatabaseHas(Product::class, ['name' => 'jurel']);
    $this->assertDatabaseHas(Product::class, ['name' => 'caballa']);
    $this->assertDatabaseHas(Product::class, ['name' => 'pez limón']);
    $this->assertDatabaseHas(Product::class, ['name' => 'pez espada']);
    $this->assertDatabaseHas(Product::class, ['name' => 'langosta']);
    $this->assertDatabaseHas(Product::class, ['name' => 'almejas']);
    $this->assertDatabaseHas(Product::class, ['name' => 'ostra']);
    $this->assertDatabaseHas(Product::class, ['name' => 'camarón']);
    $this->assertDatabaseHas(Product::class, ['name' => 'pargo']);
    $this->assertDatabaseHas(Product::class, ['name' => 'tilapia']);
    $this->assertDatabaseHas(Product::class, ['name' => 'sardinas']);
    $this->assertDatabaseHas(Product::class, ['name' => 'preparado']);
    $this->assertDatabaseHas(Product::class, ['name' => 'pulpo']);
    $this->assertDatabaseHas(Product::class, ['name' => 'sepia']);
    $this->assertDatabaseHas(Product::class, ['name' => 'gambas']);
    $this->assertDatabaseHas(Product::class, ['name' => 'cigalas']);
    $this->assertDatabaseHas(Product::class, ['name' => 'bogavante']);
    $this->assertDatabaseHas(Product::class, ['name' => 'vieiras']);
    $this->assertDatabaseHas(Product::class, ['name' => 'cangrejo']);
    $this->assertDatabaseHas(Product::class, ['name' => 'carabineros']);
    $this->assertDatabaseHas(Product::class, ['name' => 'salmonete']);

});

it('adds given product only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(Product::class, 31);
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
    $this->assertDatabaseCount(User::class, 1);
    $this->assertDatabaseHas(User::class, ['email' => 'admin@admin.com']);
});

it('adds given user only once', function () {
    //Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    //Act && Assert
    $this->assertDatabaseCount(User::class, 1);
});

