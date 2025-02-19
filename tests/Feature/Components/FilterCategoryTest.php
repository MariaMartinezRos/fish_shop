<?php

use App\Models\Category;
use App\Models\Product;

it('filters by categories', function () {
    // Arrange
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(3)->create();

    // Act
    $view = $this->blade('<x-filter-category :categories="$categories" />', ['categories' => $categories]);

    // Assert
    foreach ($categories as $category) {
        $view->assertSee($category['name']);
    }
})->todo();
