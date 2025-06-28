<?php

use App\Http\Controllers\Profil\ProfilController;
use Illuminate\Support\Facades\Route;

Route::prefix('profil')->group(function() {
    // Route untuk menampilkan profil
    Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
    
    // Route untuk edit profil
    Route::get('/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/update', [ProfilController::class, 'update'])->name('profil.update');
    
    // Route untuk ganti password
    Route::get('/ganti-password', [ProfilController::class, 'showChangePasswordForm'])->name('profil.ganti_password');
    Route::post('/ganti-password', [ProfilController::class, 'changePassword'])->name('profil.ganti_password.post');
    
    // Route untuk upload foto profil
    Route::post('/upload-foto', [ProfilController::class, 'uploadFoto'])->name('profil.upload_foto');
});