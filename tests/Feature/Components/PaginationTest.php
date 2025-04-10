<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\View\Components\Pagination;

use function Pest\Laravel\get;
beforeEach(function () {
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();
});

it('renders the pagination component', function () {
    // Arrange
    $component = new Pagination;

    // Act
    $view = $component->render();

    // Assert
    $this->assertEquals('components.pagination', $view->name());
    $this->assertTrue(View::exists($view->name()));

});

it('displays a list of products paginated for the admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => $role->id]);

    // Act && Assert
    $this->actingAs($admin)
        ->get(route('stock'))
        ->assertStatus(200)
        ->assertSee('Anterior')
        ->assertSee('Siguiente')
        ->assertSee('10');
})->todo();

it('displays a list of products paginated for the client', function () {
    // Act && Assert
    get(route('stock-client'))
        ->assertStatus(200)
        ->assertSee('Anterior')
        ->assertSee('Siguiente')
        ->assertSee('10');
});
