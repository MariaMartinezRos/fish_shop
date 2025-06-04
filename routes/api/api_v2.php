<?php

// routes/api_v2.php

use App\Http\Controllers\Api\v2\CategoryController;
use App\Http\Controllers\Api\v2\FishController;
use App\Http\Controllers\Api\v2\ProductController;
use App\Http\Controllers\Api\v2\TransactionController;
use Illuminate\Support\Facades\Route;

// =====================================================
// PUBLIC
// =====================================================

// Fish routes
Route::get('fishes', [FishController::class, 'index']);
// Route::get('fishes/list', [FishController::class, 'list']);
Route::get('fishes/{fish}', [FishController::class, 'show']);

// Category routes (public)
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

// Product routes (public read)
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);

// =====================================================
// ADMIN
// =====================================================

Route::middleware('auth:sanctum')->group(function () {
    // Fish routes (protected)
    Route::post('fishes', [FishController::class, 'store']);
    Route::put('fishes/{fish}', [FishController::class, 'update']);
    Route::delete('fishes/{fish}', [FishController::class, 'destroy']);

    // Category routes (protected)
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    // Product routes (protected)
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);

    // Transaction routes
    Route::apiResource('transactions', TransactionController::class);
});
