<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;




// Route::view("/","pages.customer");
Route::view("/","pages.category");
//Category 
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy']);
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::put('/category/{category}', [CategoryController::class, 'update']);


// Customer Routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
