<?php

use App\Http\Controllers\Profil\ProfilController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::prefix('profil')->group(function() {
    // Route untuk menampilkan profil
    Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/change-password',[ProfilController::class, 'showChangePasswordForm'])->name('profil.ganti-password');
    Route::post('/change-password',[ProfilController::class,'changePassword'])->name('change.password');
});
