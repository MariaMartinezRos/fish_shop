<?php

use App\Http\Controllers\ProfileController;

// =====================================================
// RUTAS DE PERFIL (AUTENTICADO)
// =====================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// DESCARGA PDF DE PRODUCTOS
// =====================================================
Route::get('/products/pdf', [\App\Http\Controllers\PdfController::class, 'generatePdf'])
    ->name('products.pdf');
