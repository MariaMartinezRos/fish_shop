<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
            $secondProduct->name,
            $thirdProduct->name,
        ]);
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

it('shows a message when no products are available', function () {
    // Act
    get(route('stock'))
        ->assertOk()
        ->assertSee('No se encontraron productos.');
});

it('paginates the stock list', function () {
    // Arrange
    Product::factory()->count(50)->create();

    // Act
    get(route('stock.index'))
        ->assertOk()
        ->assertSee('Next')
        ->assertSee('Previous');
});

it('searches products by name', function () {
    // Arrange
    $product = Product::factory()->create(['name' => 'UniqueProductName']);

    // Act
    get(route('stock.index', ['search' => 'UniqueProductName']))
        ->assertOk()
        ->assertSee($product->name);
});

it('sorts products by name', function () {
    // Arrange
    $productA = Product::factory()->create(['name' => 'Apple']);
    $productB = Product::factory()->create(['name' => 'Banana']);

    // Act
    get(route('stock.index', ['sort' => 'name']))
        ->assertOk()
        ->assertSeeInOrder([$productA->name, $productB->name]);
});

it('filters products by category', function () {
    // Arrange
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    // Act
    get(route('stock.index', ['category' => $category->id]))
        ->assertOk()
        ->assertSee($product->name);
});
