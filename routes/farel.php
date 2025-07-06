<?php

use App\Http\Controllers\Profil\ProfilController;
use Illuminate\Support\Facades\Route;

Route::prefix('profil')->group(function() {
    // Route untuk menampilkan profil
    Route::get('/{id}', [ProfilController::class, 'index'])->name('profil.index');
});