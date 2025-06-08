<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

it('displays a list of products', function () {
    // Arrange
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();

    // Act
    $view = $this->blade('<x-products-list :products="$products" />', ['products' => $products]);

    // Assert
    foreach ($products as $product) {
        $view->assertSee($product['id']);
    }
});

it('shows a message when no products are available', function () {
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();

    // Act
    $view = $this->blade('<x-products-list :products="collect()" />');

    // Assert
    $view->assertSee('No hay productos disponibles.');
});

it('includes product links for the client', function () {
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();

    // Act
    $view = $this->blade('<x-products-list :products="$products" />', ['products' => $products]);

    // Assert
    foreach ($products as $product) {
        $view->assertSee(route('products.show-client', $product['id']));
    }
});

it('includes product links for the admin', function () {
    $categories = Category::factory()->count(5)->create();
    $products = Product::factory()->count(30)->create();

    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act
    $view = $this->actingAs($admin)->blade('<x-products-list :products="$products" />', ['products' => $products]);

    // Assert
    foreach ($products as $product) {
        $view->assertSee(route('products.show', $product['id']));
    }
});
