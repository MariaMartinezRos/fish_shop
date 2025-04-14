<?php


use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CategoryController;


it('returns the category view with empty array when there are no categories', function () {
    // Arrange
    loginAsAdmin();
    Category::truncate();

    // Act
    $response = $this->get('/category');

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('category');
    $response->assertViewHas('categories', []);
});

it('returns the category view with categories when they exist', function () {
    // Arrange
    loginAsAdmin();
    $categories = Category::factory()->count(3)->create();

    // Act
    $response = $this->get('/category');

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('category');
    $response->assertViewHas('categories', function ($viewData) use ($categories) {
        return $viewData->count() === $categories->count();
    });
});

it('renders the correct view manually from controller', function () {
    loginAsAdmin();
    $controller = new CategoryController();

    $response = $controller->index();

    expect($response->getName())->toBe('category');
});
