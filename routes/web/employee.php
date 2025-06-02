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

    Route::get('/employee/vacation-request', function () {
        return view('employee.vacation-request');
    })->name('employee.vacation-request');

    Route::post('/employee/vacation-request/submit', [App\Livewire\Employee\VacationRequestForm::class, 'submit'])
        ->name('employee.vacation-request.submit');

    Route::post('/employee/vacation-request/pdf', [App\Livewire\Employee\VacationRequestForm::class, 'downloadPdf'])
        ->name('employee.vacation-request.pdf');

});

