<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {   //ARREGLAR EN EL FUTURO Y CAMBIAR POR HOME
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sales', [TransactionController::class, 'showSales'])
    ->middleware(['auth', 'verified'])
    ->name('sales');

Route::get('/stock', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('stock');

Route::get('/transaction', [TransactionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('transaction');

Route::get('/category', [CategoryController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('category');

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



