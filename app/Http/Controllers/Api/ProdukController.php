<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterCategoryModel;
use App\Models\MasterProdukModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/mobile/list_produk",
     *     tags={"Produk"},
     *     summary="Ambil daftar produk yang aktif",
     *     description="Endpoint ini digunakan untuk mengambil semua produk yang statusnya aktif.",
     *     @OA\Response(
     *         response=200,
     *         description="Data produk berhasil diambil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data Barang Berhasil Diambiil"),
     *             @OA\Property(property="count", type="integer", example=3),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="kode_barang", type="string", example="BRG001"),
     *                     @OA\Property(property="nama_barang", type="string", example="Kopi Hitam"),
     *                     @OA\Property(property="harga_barang", type="number", format="float", example=10000),
     *                     @OA\Property(property="gambar_produk", type="string", format="url", example="http://webkasir.milyascube.site/storage/gambar.jpg"),
     *                     @OA\Property(property="kategori_id", type="integer", example=2),
     *                     @OA\Property(property="stok", type="integer", example=10),
     *                     @OA\Property(property="status", type="string", example="Aktif"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-06T12:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-06T12:30:00.000000Z")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data barang tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Data barang tidak ditemukan")
     *         )
     *     )
     * )
     */

    public function listProduk()
    {
        $data = MasterProdukModel::where('status', 1)->get();
        // dd($data);

        if ($data->isEmpty()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data barang tidak ditemukan',
            ], 404);
        }

        $result = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'kode_barang' => $item->kode_barang,
                'nama_barang' => $item->nama_barang,
                'harga_barang' => $item->harga_barang,
                'gambar_produk' => $item->gambar_produk ? asset('storage/' . $item->gambar_produk) : null,
                'kategori_id' => $item->kategori_id,
                'stok' => $item->stok ?? 0,
                'status' => $item->status == 1 ? 'Aktif' : 'Tidak Aktif',
                'created_at' => $item->created_at ?? null,
                'updated_at' => $item->updated_at ?? null
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data Barang Berhasil Diambiil',
            'count' => $result->count(),
            'data' => $result,
        ], 200);
    }

    /**
 * @OA\Get(
 *     path="/api/mobile/list_kategori",
 *     tags={"Kategori"},
 *     summary="Ambil daftar kategori produk",
 *     description="Endpoint ini digunakan untuk mengambil seluruh data kategori yang tersedia.",
 *     @OA\Response(
 *         response=200,
 *         description="Data kategori berhasil diambil",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Data Kategori berhasil diambil"),
 *             @OA\Property(property="count", type="integer", example=3),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="kode_kategori", type="string", example="KTG001"),
 *                     @OA\Property(property="nama", type="string", example="Minuman")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Data kategori tidak ada",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Data kategori tidak ada")
 *         )
 *     )
 * )
 */

    public function kategoriList()
    {
        $data = MasterCategoryModel::all();
        // dd($data);

        if ($data->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ada',
            ], 404);
        }
        $result = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'kode_kategori' => $item->kode_kategori,
                'nama' => $item->nama
            ];
        });
        return response()->json([
            'success' => true,
            'message' => 'Data Kategori berhasil diambil',
            'count' => $result->count(),
            'data' => $result,
        ], 200);
    }
}
