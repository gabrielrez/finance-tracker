<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/me', fn() => view('app.profile.index'))->name('profile.index');    
    Route::put('/me', [UsersController::class, 'update'])->name('profile.update');
    Route::patch('/me/profile-picture', [UsersController::class, 'updateProfilePicture'])->name('profile.picture.update');

    Route::get('/categories', fn() => view('app.categories.new'))->name('categories.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');

    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/new', fn() => view('app.transactions.new'))->name('transactions.create');
    Route::get('/transactions/{id}', [TransactionsController::class, 'show']);
    Route::post('/transactions', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{id}', [TransactionsController::class, 'delete'])->name('transactions.delete'); 

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
