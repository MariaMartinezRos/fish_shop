<?php

use App\Http\Middleware\CustomerMiddleware;
use App\Http\Controllers\{
    ProductController,
    ProfileController,
    TransactionController
};
use Illuminate\Support\Facades\Route;

// =====================================================
// RUTAS PARA CLIENTES (AUTENTICADO + CUSTOMER)
// =====================================================

Route::middleware(['auth', CustomerMiddleware::class])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer dashboard
    Route::get('/customers/{user}', function () {
        return view('customers.main');
    })->name('main');

    // Products
    Route::get('/stock-client', [ProductController::class, 'indexClient'])->name('stock-client');
    Route::get('/products-client/{id}', [ProductController::class, 'showClient'])->name('products.show-client');

    // Transactions
    Route::get('/my-transactions', [TransactionController::class, 'showMyTransactions'])->name('my-transactions');
});

