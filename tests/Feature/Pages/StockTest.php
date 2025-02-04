<?php

use App\Models\Product;
use App\Models\User;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);


it('returns a successful response for stock page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('stock');
    $response->assertStatus(200);
});

it('shows stock overview', function () {
    // Arrange
    $firstProduct = Product::factory()->create();
    $secondProduct = Product::factory()->create();
    $thirdProduct = Product::factory()->create();

    // Act
    get(route('stock.index'))
        ->assertSeeText([
            $firstProduct->name,
            $firstProduct->quantity,
            $secondProduct->name,
            $secondProduct->quantity,
            $thirdProduct->name,
            $thirdProduct->quantity,
        ]);
});

it('shows only available stock', function () {
    // Arrange
    $availableProduct = Product::factory()->create(['quantity' => 10]);
    $unavailableProduct = Product::factory()->create(['quantity' => 0]);

    // Act
    get(route('stock.index'))
        ->assertSeeText($availableProduct->name)
        ->assertDontSeeText($unavailableProduct->name);
});

it('shows stock by quantity', function () {
    // Arrange
    $lowProduct = Product::factory()->create(['quantity' => 5]);
    $highProduct = Product::factory()->create(['quantity' => 20]);

    // Act
    get(route('stock.index'))
        ->assertSeeTextInOrder([
            $highProduct->name,
            $lowProduct->name,
        ]);
});

it('includes login if not logged in', function () {
    // Act & Assert
    get(route('stock.index'))
        ->assertOk()
        ->assertSee('Login')
        ->assertSee(route('login'));
});

it('includes logout if logged in', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act
    get(route('stock'))
        ->assertOk()
        ->assertSee('Finalizar sesión') // Spanish for "Logout" CHECK
        ->assertSee(route('logout'));
});

it('includes product links', function () {
    // Arrange
    $firstProduct = Product::factory()->create();
    $secondProduct = Product::factory()->create();
    $thirdProduct = Product::factory()->create();

    // Act
    get(route('stock.index'))
        ->assertOk()
        ->assertSee([
            route('products.show', $firstProduct),
            route('products.show', $secondProduct),
            route('products.show', $thirdProduct),
        ]);
});
