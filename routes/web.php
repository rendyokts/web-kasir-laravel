<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MasterUserController;

// Bikin View nya dulu di Resources View
// Bikin Controller di app/http/controllers pake `php artisan make:controller NamaFolder\NamaFileController` Nama Folder Awal Kapitar, Nama File AwalKapital + Controller
// Bikin Routes nya di web.php 
// Bikin Models di app\models pake `php artisan make:model NamaFolder\NamaFile`


//Master User
Route::get('/master_user', [MasterUserController::class, 'index'])->name('master_user.index');
Route::get('/add_user', [MasterUserController::class, 'createUser'])->name('master_user.add_user');
Route::post('/save_user', [MasterUserController::class, 'saveUser'])->name('master_user.save');
Route::get('/edit/{id}', [MasterUserController::class, 'editUser'])->name('master_user.edit');



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

//Users
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('frontend.dashboard.index');
    })->name('dashboard');
});
