<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MasterUserController;

Route::prefix('master_user')->group(function () {
    Route::get('/', [MasterUserController::class, 'index'])->name('master_user.index');
    Route::get('/add_user', [MasterUserController::class, 'createUser'])->name('master_user.add_user');
    Route::post('/save_user', [MasterUserController::class, 'saveUser'])->name('master_user.save');
    Route::get('/edit/{id}', [MasterUserController::class, 'editUser'])->name('master_user.edit');
    Route::delete('/delete/{id}', [MasterUserController::class, 'deleteUser'])->name('master_user.delete');
});
