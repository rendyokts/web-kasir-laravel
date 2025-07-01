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
