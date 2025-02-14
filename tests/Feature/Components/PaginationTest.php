<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('displays a list of products paginated for the admin', function () {
    // Arrange
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => $role->id]);

    // Act && Assert
    $this->actingAs($admin);

    get(route('stock'))
        ->assertStatus(200)
        ->assertSee('Anterior')
        ->assertSee('Siguiente')
        ->assertSee('30');
});



it('displays a list of products paginated for the client', function () {
    // Arrange
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();
    $role = Role::factory()->create(['id' => 2]);
    $employee = User::factory()->create(['role_id' => $role->id]);

    // Act && Assert
    $this->actingAs($employee);

    get(route('stock-client'))
        ->assertStatus(200)
        ->assertSee('Anterior')
        ->assertSee('Siguiente')
        ->assertSee('30');
});
