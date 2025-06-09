<?php

// =====================================================
// PUBLIC
// =====================================================

// Category routes (public)
use App\Http\Controllers\Api\v2\CategoryController;
use App\Http\Controllers\Api\v2\ProductController;

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

// Product routes (public read)
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
