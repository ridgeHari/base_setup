<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:web'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware(['auth:web'])->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
