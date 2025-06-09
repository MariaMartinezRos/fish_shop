<?php

// =====================================================
// AUTHORIZED (ADMIN + SUPPLIER + EMPLOYEE)
// =====================================================

use App\Http\Controllers\Api\v2\admin\CategoryController;
use App\Http\Controllers\Api\v2\admin\FishController;
use App\Http\Controllers\Api\v2\admin\ProductController;
use App\Http\Controllers\Api\v2\admin\TransactionController;

Route::middleware('auth:sanctum')->group(function () {
    // =====================================================
    // AUTHORIZED SUPPLIER
    // =====================================================
    // Product routes
    Route::post('products', [ProductController::class, 'store']);

    // Fish routes
    Route::post('fishes', [FishController::class, 'store']);
    Route::put('fishes/{fish}', [FishController::class, 'update']);
    Route::delete('fishes/{fish}', [FishController::class, 'destroy']);
    Route::get('fishes', [FishController::class, 'index']);
    Route::get('fishes/{fish}', [FishController::class, 'show']);

    // =====================================================
    // AUTHORIZED EMPLOYEE
    // =====================================================
    // Transaction routes
    Route::apiResource('transactions', TransactionController::class);

    // =====================================================
    // ONLY ADMIN
    // =====================================================
    // Product routes
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);

    // Category routes
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

});


