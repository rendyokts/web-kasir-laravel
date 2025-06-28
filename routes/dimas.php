<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


//Auth
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginProses'])->name('loginProses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'create'])->name('registerProses');


//guest
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [LoginController::class, 'passwordRequest'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'passwordEmail'])->name('password.email');
    Route::get('reset-password/{token}', [LoginController::class, 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'passwordUpdate'])->name('password.update');
});
