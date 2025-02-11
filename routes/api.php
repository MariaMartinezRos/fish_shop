<?php
// routes/api.php

use App\Http\Controllers\Api\FishController;

// A simple route to fetch all pescados
Route::get('fishes', [FishController::class, 'index']);

// A resource controller to handle CRUD operations
Route::apiResource('fishes', FishController::class);
