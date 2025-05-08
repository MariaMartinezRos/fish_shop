<?php

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

it('validates product name is required', function () {
    // Arrange
    $request = new StoreProductRequest();

    // Act
    $data = [
        'category_id' => 1,
        'price_per_kg' => 10,
        'stock_kg' => 100,
        'description' => 'A description of the product',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('name'))->toBeTrue();
});

it('validates category_id exists in the database', function () {
    // Arrange
    $request = new StoreProductRequest();
    // Asegúrate de crear una categoría en la base de datos si es necesario
    Category::create(['id' => 1, 'name' => 'Test Category']);

    // Act
    $data = [
        'name' => 'Test Product',
        'category_id' => 999, // Una categoría que no existe
        'price_per_kg' => 10,
        'stock_kg' => 100,
        'description' => 'A description of the product',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('category_id'))->toBeTrue();
});

it('validates price_per_kg is numeric and not negative', function () {
    // Arrange
    $request = new StoreProductRequest();

    // Act
    $data = [
        'name' => 'Test Product',
        'category_id' => 1,
        'price_per_kg' => -10, // Precio negativo
        'stock_kg' => 100,
        'description' => 'A description of the product',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('price_per_kg'))->toBeTrue();
});

it('validates stock_kg is numeric and not negative', function () {
    // Arrange
    $request = new StoreProductRequest();

    // Act
    $data = [
        'name' => 'Test Product',
        'category_id' => 1,
        'price_per_kg' => 10,
        'stock_kg' => -50,
        'description' => 'A description of the product',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('stock_kg'))->toBeTrue();
});

