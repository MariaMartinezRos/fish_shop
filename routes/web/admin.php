<?php

use App\Http\Controllers\{
    CategoryController,
    PdfController,
    ProductController,
    ProfileController,
    TransactionController,
    UserController
};
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\TransactionSearcher;
use Illuminate\Support\Facades\Route;

// =====================================================
// RUTAS PARA ADMINISTRADORES (AUTENTICADO + ADMIN)
// =====================================================

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Sales and transactions
    Route::get('/sales', [TransactionController::class, 'showSales'])->name('sales');
    Route::get('/transaction', TransactionSearcher::class)->name('transaction');

    // Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Products
    Route::resource('products', ProductController::class);
    Route::get('/stock', [ProductController::class, 'index'])->name('stock');
    Route::get('/products/add', function () {
        return view('products.create');
    })->name('products.add-form');
    Route::post('/products/add', [ProductController::class, 'add'])->name('products.add');
    Route::post('/products/delete-all', [ProductController::class, 'deleteAll'])->name('products.delete-all');
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/products/pdf', [PdfController::class, 'generatePdf'])->name('products.pdf');

    // Users
    Route::resource('users', UserController::class);
});

