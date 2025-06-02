<?php

use App\Http\Controllers\{Admin\ProductController,
    Admin\SoftDeletesController,
    Admin\TransactionController,
    Admin\UserController,
    CategoryController,
    Employee\HomeController};
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Livewire\TransactionSearcher;
use Illuminate\Support\Facades\Route;

// =====================================================
// RUTAS PARA EMPLEADOS (AUTENTICADO + EMPLOYEE)
// =====================================================

Route::middleware([EmployeeMiddleware::class])->group(function () {

    Route::get('/employee/home', [HomeController::class, 'index'])->name('employees.home');

    Route::get('/employee/transactions', function () {
        return view('employee.transactions');
    })->name('employee.transactions');

});

