<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use App\Models\MasterProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'user_id' => 'required|integer',
            'pembayaran' => 'required|numeric|max:' . $request->total,
            'detail' => 'required|array|min:1',
            'detail.*.barang_id' => 'required|integer',
            'detail.*.qty' => 'required|integer|min:1',
            'detail.*.harga_satuan' => 'required|numeric',
            'detail.*.subtotal' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // Validasi pembayaran tidak boleh melebihi total
            $this->validatePayment($request->total, $request->pembayaran);

            // Validasi stok sebelum transaksi
            $this->validateStock($request->detail);

            $transaksi = TransaksiModel::create([
                'kode_transaksi' => $this->generateKodeTransaksi(),
                'tanggal' => $request->tanggal,
                'total' => $request->total,
                'user_id' => $request->user_id,
                'pembayaran' => $request->pembayaran
            ]);

            // Simpan setiap item detail dan kurangi stok
            foreach ($request->detail as $item) {
                // Simpan detail transaksi
                TransaksiDetailModel::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Kurangi stok barang
                $this->updateStock($item['barang_id'], $item['qty']);
            }

            DB::commit();
            return response()->json([
                'message' => 'Transaksi berhasil disimpan dan stok berhasil diperbarui',
                'data' => $transaksi->load('details')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal simpan transaksi', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'message' => 'Gagal menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validasi pembayaran tidak boleh melebihi total
     */
    private function validatePayment($total, $pembayaran)
    {
        if ($pembayaran < $total) {
            throw new \Exception("Pembayaran tidak boleh kurang dari total transaksi. Total: " . number_format($total, 0, ',', '.') . ", Pembayaran: " . number_format($pembayaran, 0, ',', '.'));
        }
    }

    /**
     * Validasi stok barang sebelum transaksi
     */
    private function validateStock($details)
    {
        foreach ($details as $item) {
            $barang = MasterProdukModel::find($item['barang_id']);

            if (!$barang) {
                throw new \Exception("Barang dengan ID {$item['barang_id']} tidak ditemukan");
            }

            if ($barang->stok < $item['qty']) {
                throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok}, diminta: {$item['qty']}");
            }
        }
    }

    /**
     * Update stok barang
     */
    private function updateStock($barangId, $qty)
    {
        $barang = MasterProdukModel::find($barangId);

        if (!$barang) {
            throw new \Exception("Barang dengan ID {$barangId} tidak ditemukan");
        }

        // Kurangi stok
        $barang->stok -= $qty;
        $barang->save();

        // Log perubahan stok
        Log::info("Stok barang berhasil dikurangi", [
            'barang_id' => $barangId,
            'nama_barang' => $barang->nama_barang,
            'qty_dikurangi' => $qty,
            'stok_sebelum' => $barang->stok + $qty,
            'stok_setelah' => $barang->stok
        ]);
    }

    private function generateKodeTransaksi()
    {
        $prefix = 'TRX-' . date('Ymd') . '-';
        $last = TransaksiModel::whereDate('tanggal', now()->toDateString())
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
