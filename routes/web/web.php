<?php

use App\Http\Controllers\{Admin\SoftDeletesReportController,
    CategoryController,
    ContactController,
    SoftDeletesController,
    ProductController,
    ProfileController,
    RecipeController,
    TransactionController,
    UserController};
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\TransactionSearcher;
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
// RUTAS PARA ADMINISTRADORES (AUTENTICADO + ADMIN)
// =====================================================

    Route::middleware([AdminMiddleware::class])->group(function () {

        Route::get('/sales', [TransactionController::class, 'showSales'])->name('sales');
        Route::get('/transaction', TransactionSearcher::class)->name('transaction');

        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

        Route::resource('products', ProductController::class);
        Route::get('/stock', [ProductController::class, 'index'])->name('stock');

        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/products/{id}', [ProductController::class, 'show'])->middleware(['auth', 'verified'])->name('products.show');

        Route::get('/products/add', function () {
            return view('products.create');
        })->name('products.add-form');

        Route::post('/products/add', [ProductController::class, 'add'])->name('products.add');

        Route::post('/products/delete-all', [ProductController::class, 'deleteAll'])->name('products.delete-all');

        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
//        Route::get('/products/pdf', [PdfController::class, 'generatePdf'])->name('products.pdf');

        Route::resource('users', UserController::class);

        Route::post('/pdf/soft-deletes', [SoftDeletesController::class, 'generate'])
        ->name('soft-deletes');

    });

// =====================================================
// INCLUSIÓN DE ARCHIVO DE AUTENTICACIÓN
// =====================================================
require __DIR__ . '/../auth.php';

