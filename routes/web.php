<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/export', [BookController::class, 'export'])->name('books.export');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::get('/categories', [BookCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [BookCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [BookCategoryController::class, 'store'])->name('categories.store');

    Route::group(['middleware' => AdminMiddleware::class], function () {
        Route::get('/categories/{bookCategory}/edit', [BookCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{bookCategory}', [BookCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{bookCategory}', [BookCategoryController::class, 'destroy'])->name('categories.destroy');
    });
});
