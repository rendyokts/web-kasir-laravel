<?php

use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Transaksi\TransaksiController as TransaksiTransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('mobile')->group(function () {

    //Login
    Route::post('/loginApi', [ApiLoginController::class, 'loginAPi']);

    //GET PRODUK dan KATEGORI
    Route::get('/list_produk', [ProdukController::class, 'listProduk']);

    Route::get('/list_kategori', [ProdukController::class, 'kategoriList']);

    // API TRANSAKSI
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::get('/transaksi/harian', [TransaksiController::class, 'totalTransaksiHariIni']);
        Route::get('/transaksi/bulan', [TransaksiController::class, 'totalTransaksiBulanan']);

        Route::get('/transaksi/list', [TransaksiTransaksiController::class, 'listByTanggal']);
        Route::get('/transaksi/list/{id}', [TransaksiTransaksiController::class, 'detailTransaksi']);

        Route::get('/transaksi/all', [TransaksiController::class, 'getAllDataTransaksi']);
    });
});
