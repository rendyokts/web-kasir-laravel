<?php

use App\Http\Controllers\produk\MasterProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MasterUserController;

//Master User
Route::get('/master_produk', [MasterProdukController::class, 'index'])->name('master_produk.index');
Route::get('/add_produk', [MasterProdukController::class, 'createProduk'])->name('master_produk.add_produk');
Route::post('/save_produk', [MasterProdukController::class, 'saveProduk'])->name('master_produk.save');
Route::get('/edit_produk/{id}', [MasterProdukController::class, 'editProduk'])->name('master_produk.edit');
Route::delete('/delete_produk/{id}', [MasterProdukController::class, 'deleteProduk'])->name('master_produk.delete');