<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function list_transaksi()
    {
        $data = TransaksiModel::orderBy('tanggal', 'desc')->get();
        return view('transaksi.index', compact('data'));
    }

    public function detail_transaksi($id)
    {
        $transaksi = TransaksiModel::with(['details.produk'])->findOrFail($id);
        // dd($transaksi);
        return view('transaksi.detail', compact('transaksi'));
    }

    public function listByTanggal(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);

        $transaksi = TransaksiModel::whereDate('tanggal', $request->tanggal)->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar transaksi pada tanggal ' . $request->tanggal,
            'data' => $transaksi
        ]);
    }

    // Detail transaksi berdasarkan ID
    public function detailTransaksi($id)
    {
        $transaksi = TransaksiModel::with('details')->find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail transaksi',
            'data' => $transaksi
        ]);
    }
}
