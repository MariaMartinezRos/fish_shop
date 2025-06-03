<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacationRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_middleware')
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware([
        'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    // Vacation Request Routes
    Route::resource('vacation-requests', VacationRequestController::class);
    Route::get('/vacation-requests/{vacationRequest}', function (VacationRequest $vacationRequest) {
        if (!auth()->user()->isAdmin() && auth()->id() !== $vacationRequest->user_id) {
            abort(403);
        }
        return view('vacation-requests.show', compact('vacationRequest'));
    })->name('vacation-requests.show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_middleware')
])->group(function () {
    // ... existing routes ...
}); 