<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
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

Route::get('/products/pdf', [\App\Http\Controllers\PdfController::class, 'generatePdf'])
    ->name('products.pdf');

// =====================================================
// RUTAS DE PERFIL (AUTENTICADO)
// =====================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// INCLUSIÓN DE ARCHIVOS DE RUTAS Y AUTENTICACIÓN
// =====================================================
require __DIR__.'/../auth.php';

require __DIR__.'/admin.php';
require __DIR__.'/customer.php';
require __DIR__.'/employee.php';
