<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use App\Models\MasterProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class TransaksiController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/mobile/transaksi",
     *     tags={"Transaksi"},
     *     summary="Simpan transaksi dan update stok barang",
     *     description="Menyimpan transaksi penjualan sekaligus mengurangi stok barang berdasarkan detail transaksi.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal", "total", "user_id", "pembayaran", "detail"},
     *             @OA\Property(property="tanggal", type="string", format="date", example="2025-07-06"),
     *             @OA\Property(property="total", type="number", format="float", example=50000),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="pembayaran", type="number", format="float", example=50000),
     *             @OA\Property(
     *                 property="detail",
     *                 type="array",
     *                 minItems=1,
     *                 @OA\Items(
     *                     type="object",
     *                     required={"barang_id", "qty", "harga_satuan", "subtotal"},
     *                     @OA\Property(property="barang_id", type="integer", example=1),
     *                     @OA\Property(property="qty", type="integer", example=2),
     *                     @OA\Property(property="harga_satuan", type="number", format="float", example=25000),
     *                     @OA\Property(property="subtotal", type="number", format="float", example=50000)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaksi berhasil disimpan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Transaksi berhasil disimpan dan stok berhasil diperbarui"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=12),
     *                 @OA\Property(property="kode_transaksi", type="string", example="TRX-20250706-00001"),
     *                 @OA\Property(property="tanggal", type="string", format="date", example="2025-07-06"),
     *                 @OA\Property(property="total", type="number", example=50000),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="pembayaran", type="number", example=50000),
     *                 @OA\Property(
     *                     property="details",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="barang_id", type="integer", example=1),
     *                         @OA\Property(property="qty", type="integer", example=2),
     *                         @OA\Property(property="harga_satuan", type="number", example=25000),
     *                         @OA\Property(property="subtotal", type="number", example=50000)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal (input tidak lengkap/benar)"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Gagal menyimpan transaksi",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Gagal menyimpan transaksi"),
     *             @OA\Property(property="error", type="string", example="Stok barang Kopi Hitam tidak mencukupi. Stok tersedia: 1, diminta: 3")
     *         )
     *     )
     * )
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal' => 'required|date',
    //         'total' => 'required|numeric',
    //         'user_id' => 'required|integer',
    //         'pembayaran' => 'required|numeric|max:' . $request->total,
    //         'detail' => 'required|array|min:1',
    //         'detail.*.barang_id' => 'required|integer',
    //         'detail.*.qty' => 'required|integer|min:1',
    //         'detail.*.harga_satuan' => 'required|numeric',
    //         'detail.*.subtotal' => 'required|numeric',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // Validasi pembayaran tidak boleh melebihi total
    //         $this->validatePayment($request->total, $request->pembayaran);

    //         // Validasi stok sebelum transaksi
    //         $this->validateStock($request->detail);

    //         $transaksi = TransaksiModel::create([
    //             'kode_transaksi' => $this->generateKodeTransaksi(),
    //             'tanggal' => $request->tanggal,
    //             'total' => $request->total,
    //             'user_id' => $request->user_id,
    //             'pembayaran' => $request->pembayaran
    //         ]);

    //         // Simpan setiap item detail dan kurangi stok
    //         foreach ($request->detail as $item) {
    //             // Simpan detail transaksi
    //             TransaksiDetailModel::create([
    //                 'transaksi_id' => $transaksi->id,
    //                 'barang_id' => $item['barang_id'],
    //                 'qty' => $item['qty'],
    //                 'harga_satuan' => $item['harga_satuan'],
    //                 'subtotal' => $item['subtotal'],
    //             ]);

    //             // Kurangi stok barang
    //             $this->updateStock($item['barang_id'], $item['qty']);
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'message' => 'Transaksi berhasil disimpan dan stok berhasil diperbarui',
    //             'data' => $transaksi->load('details')
    //         ], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Gagal simpan transaksi', [
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //             'request_data' => $request->all()
    //         ]);

    //         return response()->json([
    //             'message' => 'Gagal menyimpan transaksi',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'total' => 'required|numeric|min:0',
            'user_id' => 'required|integer',
            'pembayaran' => 'required|numeric|min:0',
            'detail' => 'required|array|min:1',
            'detail.*.barang_id' => 'required|integer',
            'detail.*.qty' => 'required|integer|min:1',
            'detail.*.harga_satuan' => 'required|numeric|min:0',
            'detail.*.subtotal' => 'required|numeric|min:0',
        ]);

        // Log request data untuk debugging
        Log::info('Request data received:', $request->all());

        DB::beginTransaction();
        try {
            // Validasi pembayaran tidak boleh kurang dari total
            $this->validatePayment($validated['total'], $validated['pembayaran']);

            // Validasi stok sebelum transaksi
            $this->validateStock($validated['detail']);

            $transaksi = TransaksiModel::create([
                'kode_transaksi' => $this->generateKodeTransaksi(),
                'tanggal' => $validated['tanggal'],
                'total' => $validated['total'],
                'user_id' => $validated['user_id'],
                'pembayaran' => $validated['pembayaran']
            ]);

            // Simpan setiap item detail dan kurangi stok
            foreach ($validated['detail'] as $item) {
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

    /**
     * @OA\Get(
     *     path="/api/mobile/transaksi/harian",
     *     tags={"Statistik Transaksi"},
     *     summary="Hitung total transaksi hari ini",
     *     description="Menghitung jumlah transaksi dan total nilai transaksi yang terjadi pada hari ini.",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menghitung transaksi hari ini",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data transaksi hari ini berhasil diambil"),
     *             @OA\Property(property="jumlah_transaksi", type="integer", example=5),
     *             @OA\Property(property="total_transaksi", type="number", format="float", example=250000)
     *         )
     *     )
     * )
     */
    public function totalTransaksiHariIni()
    {
        $today = Carbon::today();

        $jumlahTransaksi = TransaksiModel::whereDate('tanggal', $today)->count();

        $totalTransaksi = TransaksiModel::whereDate('tanggal', $today)->sum('total');

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi hari ini berhasil diambil',
            'jumlah_transaksi' => $jumlahTransaksi,
            'total_transaksi' => $totalTransaksi
        ]);
    }

    public function totalTransaksiBulanan(Request $request)
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        // $bulan = $request->input('bulan'); // ex: 7
        // $tahun = $request->input('tahun'); // ex: 2025

        $jumlahTransaksi = TransaksiModel::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count();
        $totalTransaksi = TransaksiModel::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('total');

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi bulan ini berhasil diambil',
            'jumlah_transaksi' => $jumlahTransaksi,
            'total_transaksi' => $totalTransaksi
        ]);
    }
}
