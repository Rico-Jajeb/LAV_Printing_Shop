<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryProductController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
    // Route::get('/products', function () {
    //     return Inertia::render('Admin/Products/Products');
    // })->name('products');
    Route::get('/setting', function () {
        return Inertia::render('Admin/Setting');
    })->name('setting');
});


#ADMIN
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/addProducts', [ProductController::class, 'productsAdd'])->name('addProducts');
Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/category', [CategoryProductController::class, 'index'])->name('category');
Route::post('/category/create', [CategoryProductController::class, 'store'])->name('category.create');
Route::put('/category/update/{id}', [CategoryProductController::class, 'update'])->name('category.update');
Route::patch('/category/{id}/status', [CategoryProductController::class, 'statusUpdate'])->name('category.updateStatus');
Route::delete('/category/{id}', [CategoryProductController::class, 'destroy'])->name('category.destroy');