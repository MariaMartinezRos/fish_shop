<?php

use App\Models\Product;

it('displays a list of products', function () {
    // Arrange
    $products = Product::factory()->count(3)->create();

    // Act
    $view = $this->blade('<x-products-list :products="$products" />', ['products' => $products]);

    // Assert
    foreach ($products as $product) {
        $view->assertSee($product->name);
    }
});

it('shows a message when no products are available', function () {
    // Act
    $view = $this->blade('<x-products-list :products="collect()" />');

    // Assert
    $view->assertSee('No hay productos disponibles.');
});

it('includes product links', function () {
    // Arrange
    $products = Product::factory()->count(3)->create();

    // Act
    $view = $this->blade('<x-products-list :products="$products" />', ['products' => $products]);

    // Assert
    foreach ($products as $product) {
        $view->assertSee(route('products.show', $product));
    }
});
