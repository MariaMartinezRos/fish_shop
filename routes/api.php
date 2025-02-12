<?php
// routes/api.php

use App\Http\Controllers\Api\FishController;

// A simple route to fetch all fishes
Route::get('fish', [FishController::class, 'index']);

// A resource controller to handle CRUD operations
Route::apiResource('fish', FishController::class);

// A route to modify one fish
Route::put('fish/{fish}', [FishController::class, 'update']);

// A route to delete one fish
Route::delete('fish/{fish}', [FishController::class, 'destroy']);

// A route to delete all fishes
Route::delete('fish', [FishController::class, 'destroyAll']);




///
Route::post('/fish', [FishController::class, 'store']);

// A route to upload a fish
Route::post('/fish/upload', [FishController::class, 'upload']);

// A route to delete all records of fishes
Route::delete('/fish/delete-all', [FishController::class, 'deleteAll']);
