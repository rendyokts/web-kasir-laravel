<?php

use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('mobile')->group(function() {
    //Login
    Route::post('/loginApi', [ApiLoginController::class, 'loginAPi']);
    
    //GET PRODUK dan KATEGORI
    Route::get('/list_produk', [ProdukController::class, 'listProduk']);
    Route::get('/list_kategori', [ProdukController::class, 'kategoriList']);

    // dummy transaksi
    Route::post('/transaksi', [TransaksiController::class, 'store']);
});