<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'user_id' => 'required|integer',
            'detail' => 'required|array|min:1',
            'detail.*.barang_id' => 'required|integer',
            'detail.*.qty' => 'required|integer|min:1',
            'detail.*.harga_satuan' => 'required|numeric',
            'detail.*.subtotal' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Simpan transaksi utama
            $transaksi = TransaksiModel::create([
                'kode_transaksi' => $this->generateKodeTransaksi(),
                'tanggal' => $request->tanggal,
                'total' => $request->total,
                'user_id' => $request->user_id,
            ]);

            // Simpan setiap item detail
            foreach ($request->detail as $item) {
                TransaksiDetailModel::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil disimpan',
                'data' => $transaksi->load('details')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal simpan transaksi', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'message' => 'Gagal menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function generateKodeTransaksi()
    {
        $prefix = 'TRX-' . date('Ymd') . '-';

        $last = \App\Models\TransaksiModel::whereDate('tanggal', now()->toDateString())
            ->orderBy('id', 'desc')
            ->first();

        $number = 1;

        if ($last) {
            $lastNumber = (int) substr($last->kode_transaksi, -5);
            $number = $lastNumber + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
