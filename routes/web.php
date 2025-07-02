<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\TransaksiDetailModel;
use Illuminate\Support\Facades\Route;

// Bikin View nya dulu di Resources View
// Bikin Controller di app/http/controllers pake `php artisan make:controller NamaFolder\NamaFileController` Nama Folder Awal Kapitar, Nama File AwalKapital + Controller
// Bikin Routes nya di web.php
// Bikin Models di app\models pake `php artisan make:model NamaFolder\NamaFile`


//Users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


include_once('farel.php');
include_once('ilham.php');
include_once('rakha.php');
include_once('habib.php');
include_once('rendi.php');
include_once('dimas.php');
