<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SoftDeletesController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\TransactionSearcher;
use Illuminate\Support\Facades\Route;

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

    Route::post('/run-command', function () {
        Artisan::call('app:clean-all-cache');

        return back()->with('status', 'success');
    })->name('run.command');

});
