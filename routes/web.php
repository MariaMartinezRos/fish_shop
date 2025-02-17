<?php

use App\Http\Controllers\FishController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

//rutas de usuario
Route::get('/about', function () {
    return view('dashboard.about');
})->name('about');

Route::get('/contact', function () {
    return view('dashboard.contact');
})->name('contact');

Route::get('/discover', [FishController::class, 'indexClient'])
    ->name('discover');

Route::get('/recipes', [RecipeController::class, 'showRecipes'])
    ->name('recipes');

Route::get('/shops', function () {
    return view('dashboard.shops');
})->name('shops');

Route::get('/stock-client', [ProductController::class, 'indexClient'])
    ->name('stock-client');
//admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware([AdminMiddleware::class])->group(function () {

        Route::get('/sales', [TransactionController::class, 'showSales'])->name('sales');
        Route::get('/stock', [ProductController::class, 'index'])->name('stock');
        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/fish', [FishController::class, 'index'])->name('fish');
        Route::resource('users', UserController::class);
    });
});

//Route::get('/sales', [TransactionController::class, 'showSales'])
//    ->middleware(['auth', 'verified'])
//    ->name('sales');
//
//Route::get('/stock', [ProductController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('stock');
//
//Route::get('/transaction', [TransactionController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('transaction');
//
//Route::get('/category', [CategoryController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('category');
//
//Route::get('/categories/{category}', [CategoryController::class, 'show'])
//    ->middleware(['auth', 'verified'])
//    ->name('categories.show');
//
//Route::get('/fish', [FishController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('fish');
//
//// CRUD users
//Route::resource('users', UserController::class);


// Route to add a single product

// Route to display the form
Route::get('/products/add', function () {
    return view('products.add');
})->middleware(['auth', 'verified'])->name('products.add-form');

// Route to handle the form submission
Route::post('/products/add', [ProductController::class, 'add'])
    ->middleware(['auth', 'verified'])
    ->name('products.add');


// Route to delete all products
Route::post('/products/delete-all', [ProductController::class, 'deleteAll'])
    ->middleware(['auth', 'verified'])
    ->name('products.delete-all');

//}

//else {
//    //redirect to dashboard
//    return view('dashboard');
//}

//download all products in PDF
Route::get('/products/pdf', [ProductController::class, 'downloadProductsPDF'])
    ->name('products.pdf');


// ruta para mostrar los productos filtrados
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
//para mostrar un producto concreto
Route::get('/products/{id}', [ProductController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('products.show');
//para mostrar un producto concreto al cliente
Route::get('/products-client/{id}', [ProductController::class, 'showClient'])
    ->name('products.show-client');

//rutas de politicas
Route::get('/privacy', function () {
    return view('auth.policy.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('auth.policy.terms');
})->name('terms');

//ruta para exportar e importar los productos
Route::get('products/export/', [ProductController::class, 'export'])
    ->name('products.export');
Route::post('/products/import', [ProductController::class, 'import'])
    ->name('products.import');

//errors
Route::get('/error/{statusCode}', [ErrorController::class, 'showError']);
Route::get('/error/404', [ErrorController::class, 'notFound']);
Route::get('/error/500', [ErrorController::class, 'internalServerError']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
