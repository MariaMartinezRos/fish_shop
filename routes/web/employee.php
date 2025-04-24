<?php

use App\Http\Controllers\{
    ProductController,
    ProfileController,
    TransactionController
};
use App\Http\Middleware\EmployeeMiddleware;
use App\Livewire\TransactionSearcher;
use Illuminate\Support\Facades\Route;

// =====================================================
// RUTAS PARA EMPLEADOS (AUTENTICADO + EMPLOYEE)
// =====================================================

Route::middleware(['auth', EmployeeMiddleware::class])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee dashboard
    Route::get('/employees/{user}', function () {
        return view('employees.main');
    })->name('main');

    // Sales and transactions
    Route::get('/sales', [TransactionController::class, 'showSales'])->name('sales');
    Route::get('/transaction', TransactionSearcher::class)->name('transaction');

    // Products
    Route::get('/stock', [ProductController::class, 'index'])->name('stock');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
});

