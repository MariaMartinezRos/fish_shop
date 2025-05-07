<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

// uses(RefreshDatabase::class);

it('returns a successful response for stock client page', function () {
    $response = $this->get('stock-client');

    $response->assertStatus(200);
});

it('shows stock client overview', function () {
    // Arrange
    $category = Category::factory()->create();
    $firstProduct = Product::factory()->create(['category_id' => $category->id]);
    $secondProduct = Product::factory()->create(['category_id' => $category->id]);
    $thirdProduct = Product::factory()->create(['category_id' => $category->id]);

    // Act
    get(route('stock-client'))
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
    get(route('stock-client'))
        ->assertOk()
        ->assertSee('Cerrar Sesión')
        ->assertSee(route('logout'));
});

it('includes product links', function () {
    // Arrange
    $category = Category::factory()->create();
    $firstProduct = Product::factory()->create(['category_id' => $category->id]);
    $secondProduct = Product::factory()->create(['category_id' => $category->id]);
    $thirdProduct = Product::factory()->create(['category_id' => $category->id]);

    // Act
    get(route('stock-client'))
        ->assertOk()
        ->assertSee([
            route('products.show-client', $firstProduct),
            route('products.show-client', $secondProduct),
            route('products.show-client', $thirdProduct),
        ]);
});

it('shows a message when no products are available', function () {
    // Arrange
    get(route('stock-client'))
        ->assertOk()
        ->assertSee('No se encontraron productos.');
});

it('paginates the stock client list', function () {
    // Arrange
    $category = Category::factory()->create();
    Product::factory()->count(50)->create(['category_id' => $category->id]);

    // Act
    get(route('stock-client'))
        ->assertOk()
        ->assertSee('Anterior')
        ->assertSee('Siguiente');
});

it('searches products by name', function () {
    // Arrange
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id, 'name' => 'UniqueProductName']);

    // Act
    get(route('stock-client', ['search' => 'UniqueProductName']))
        ->assertOk()
        ->assertSee($product->name);
});

it('can be downloaded as a PDF file', function () {
    // Arrange
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    // Act
    $response = get(route('products.pdf'));

    // Assert
    $response->assertOk()
        ->assertHeader('Content-Type', 'application/pdf')
        ->assertHeader('Content-Disposition', 'attachment; filename=products.pdf');
});
