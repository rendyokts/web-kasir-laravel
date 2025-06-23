<?php

use App\Http\Controllers\User\MasterUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.dashboard.index');
});


Route::get('/master_user', [MasterUserController::class, 'index'])->name('master_user.index');
Route::get('/add_user', [MasterUserController::class, 'createUser'])->name('master_user.add_user');
Route::post('/save_user', [MasterUserController::class, 'saveUser'])->name('master_user.save');
Route::get('/edit/{id}', [MasterUserController::class, 'editUser'])->name('master_user.edit');