<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $qtyHarian = $this->barangTerjualHarian();
        $terlaris = $this->terlaris();
        $transaksiHarian = $this->transaksiHarian();
        $trxHarian = $this->trxHarian();
        // dd($trxHarian);
        return view('frontend.dashboard.index', compact('qtyHarian', 'terlaris', 'transaksiHarian', 'trxHarian'));
    }

    public function barangTerjualHarian()
    {
        $totalQtyHariIni = DB::table('transaksi_detail as td')
            ->join('transaksi as t', 'td.transaksi_id', '=', 't.id')
            ->whereDate('t.tanggal', \Carbon\Carbon::today())
            ->sum('td.qty');

        return $totalQtyHariIni;
    }

    public function terlaris()
    {
        $barangLarisEloquent = DB::table('barang as b')
            ->join('transaksi_detail as td', 'b.id', '=', 'td.barang_id')
            ->join('transaksi as t', 'td.transaksi_id', '=', 't.id')
            ->whereBetween('t.tanggal', [
                now()->subDays(7)->startOfDay(),
                now()->endOfDay()
            ])
            ->select([
                'b.id',
                'b.kode_barang',
                'b.nama_barang',
                'b.gambar_produk',
                'b.harga_barang',
                DB::raw('SUM(td.qty) as total_terjual'),
                DB::raw('COUNT(DISTINCT t.id) as total_transaksi'),
                DB::raw('SUM(td.subtotal) as total_pendapatan')
            ])
            ->groupBy('b.id', 'b.kode_barang', 'b.nama_barang', 'b.gambar_produk', 'b.harga_barang')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();
        return $barangLarisEloquent;
    }

    public function transaksiHarian()
    {
        // total uang harian yang masuk
        $totalTransaksiHariIni = DB::table('transaksi')
            ->whereDate('tanggal', Carbon::today())
            ->sum('total');

        return $totalTransaksiHariIni;
    }

    public function trxHarian(){
        $totalTrxHarian = DB::table('transaksi')->whereDate('tanggal', Carbon::today())->count('id');
        return $totalTrxHarian;
    }
}
