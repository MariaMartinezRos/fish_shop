<?php
// routes/api.php

use App\Http\Controllers\Api\FishController;
use Illuminate\Support\Facades\Route;

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














//// A simple route to fetch all fishes
//Route::get('fish', [FishController::class, 'index']);
//
//// A resource controller to handle CRUD operations
//Route::apiResource('fish', FishController::class);
//
//// A route to modify one fish
//Route::put('fish/{fish}', [FishController::class, 'update']);
//
//// A route to delete one fish
//Route::delete('fish/{fish}', [FishController::class, 'destroy']);
//
//// A route to delete all fishes
//Route::delete('fish', [FishController::class, 'destroyAll']);
//
//
//
//
/////
//Route::post('/fish', [FishController::class, 'store']);
//
//// A route to upload a fish
//Route::post('/fish/upload', [FishController::class, 'upload']);
//
//// A route to delete all records of fishes
//Route::delete('/fish/delete-all', [FishController::class, 'deleteAll']);
