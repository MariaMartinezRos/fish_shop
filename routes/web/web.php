<?php

use App\Http\Controllers\{
    ContactController,
    ProductController,
    RecipeController
};
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// =====================================================
// RUTAS PÚBLICAS
// =====================================================

Route::get('/about', function () {
    return view('dashboard.about');
})->name('about');

Route::get('/contact', function () {
    return view('dashboard.contact');
})->name('contact');

Route::get('/privacy', function () {
    return view('auth.policy.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('auth.policy.terms');
})->name('terms');

Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit');

Route::get('/recipes', [RecipeController::class, 'showRecipes'])
    ->name('recipes');

Route::get('/shops', function () {
    return view('dashboard.shops');
})->name('shops');

Route::get('/stock-client', [ProductController::class, 'indexClient'])
    ->name('stock-client');

Route::get('/products-client/{id}', [ProductController::class, 'showClient'])
    ->name('products.show-client');

// =====================================================
// INCLUSIÓN DE ARCHIVOS DE RUTAS
// =====================================================
require __DIR__ . '/admin.php';
require __DIR__ . '/employee.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/../auth.php';

