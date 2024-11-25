<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/sales', function () {
    return view('sales');
})->middleware(['auth', 'verified'])->name('sales');
Route::get('/stock', function () {
    return view('stock');
})->middleware(['auth', 'verified'])->name('stock');

//errors
Route::get('/error/{statusCode}', [ErrorController::class, 'showError']);
Route::get('/error/404', [ErrorController::class, 'notFound']);
Route::get('/error/500', [ErrorController::class, 'internalServerError']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



