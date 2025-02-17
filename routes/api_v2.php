<?php
// routes/api_v2.php

use App\Http\Controllers\Api\v2\FishController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

// Route to fetch all fishes
    Route::get('fishes', [FishController::class, 'index']);

// Route to fetch a single fish by ID
    Route::get('fishes/{fish}', [FishController::class, 'show']);

// Route to create a new fish
    Route::post('fishes', [FishController::class, 'store']);

// Route to update an existing fish
    Route::put('fishes/{fish}', [FishController::class, 'update']);

// Route to delete a single fish
    Route::delete('fishes/{fish}', [FishController::class, 'destroy']);

// Route to list all fishes
    Route::get('fishes/list', [FishController::class, 'list']);

// Route to filter fishes by type
    Route::get('fishes/filter/{type}', [FishController::class, 'filterByType']);

// Route to search for fishes
    Route::get('fishes/search', [FishController::class, 'search']);
});
