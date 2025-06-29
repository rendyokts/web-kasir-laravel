<?php

use App\Http\Controllers\Laporan\LaporanKeuanganController;
use Illuminate\Support\Facades\Route;

Route::prefix('laporan_keuangan')->group(function() {
    Route::get('/index', [LaporanKeuanganController::class, 'index'])->name('laporan_keuangan.index');
    Route::get('/uang_masuk', [LaporanKeuanganController::class, 'uang_masuk'])->name('laporan_keuangan.uang_masuk');
    Route::get('/tambah_pemasukan', [LaporanKeuanganController::class, 'index_uang_masuk'])->name('laporan_keuangan.tambah_pemasukan');
    Route::post('/tambah_pemasukan/save', [LaporanKeuanganController::class, 'save_pemasukan'])->name('laporan_keuangan.tambah_pemasukan.save');
    Route::get('/ubah_pemasukan/{id}', [LaporanKeuanganController::class, 'edit_uang_masuk'])->name('laporan_keuangan.ubah_pemasukan.edit');
    Route::delete('/hapus_pemasukan/{id}', [LaporanKeuanganController::class, 'delete_uang_masuk'])->name('laporan_keuangan.hapus_pemasukan.delete');
    
    
    
    
    Route::get('/uang_keluar', [LaporanKeuanganController::class, 'uang_keluar'])->name('laporan_keuangan.uang_keluar');
    Route::get('/tambah_pengeluaran', [LaporanKeuanganController::class, 'index_uang_keluar'])->name('laporan_keuangan.tambah_pengeluaran');
    Route::post('/tambah_pengeluaran/save', [LaporanKeuanganController::class, 'save_pengeluaran'])->name('laporan_keuangan.tambah_pengeluaran.save');
    Route::get('/ubah_pengeluaran/{id}', [LaporanKeuanganController::class, 'edit_uang_keluar'])->name('laporan_keuangan.ubah_pengeluaran.edit');
    Route::delete('/hapus_pengeluaran/{id}', [LaporanKeuanganController::class, 'delete_uang_keluar'])->name('laporan_keuangan.hapus_pengeluaran.delete');
});