<?php

namespace App\Http\Controllers\produk;

use Illuminate\Http\Request;
use App\Models\MasterUserModel;
use App\Models\MasterProdukModel;
use App\Http\Controllers\Controller;
use App\Models\MasterCategoryModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MasterProdukController extends Controller
{
    // Index ini berguna untuk menampilkan semua data user di table
    public function index()
    {
        // Melakukan query
        $query = MasterProdukModel::with('kategori')->get();
        // -> digunakan untuk debugging sebelum menampilkan datanya pada table,
        // dd($query);
        //debugging
        return view('master_produk.index', compact('query'));
        //view disini mengarah ke file (.) titik menandakan folder jadi dibaca folder master_user, file nya index
    }

    public function createProduk()
    {
        $data = new MasterProdukModel;
        $kategoris = MasterCategoryModel::all();
        // dd($kategoris);
        return view('master_produk.add_produk', compact('data', 'kategoris'));
    }

    // menyimpan user yang di daftarkan
    public function saveProduk(Request $request)
    {
        // dd($request->asll());
        $id = $request->input('id'); // digunakan untuk mengisikan Id yang ada di table database, secara otomatis
        // dd($id);
        // mandatori berarti harus diisi jika tidak mandatori atau nullable, tidak perlu declare disini
        $mandatory = [
            'kode_barang'   => 'required | unique:barang,kode_barang,' . $id,
            'nama_barang'   => 'required', // Required artinya diisi
            'kategori_id'   => 'required',
            'harga_barang'  => 'required',
            'stok'          => 'required',
            'gambar_produk' => $id ? 'nullable | max:2048' : 'required | max:2048' 
        ];

        // dd($mandatory);

        // dilakukan pengecekan daripada input di mandatory apakah sudah diisi atau belum oleh user
        $validator = Validator::make($request->all(), $mandatory, [
            'kode_barang.required'      => 'kode wajib diisi',
            'kode_barang.unique'        => 'kode tidak boleh sama',
            'nama_barang.required'      => 'Nama wajib diisi',
            'kategori_id.required'      => 'kategori produk wajib diisi',
            'harga_barang.required'     => 'harga wajib diisi',
            'stok.required'             => 'stok wajib diisi',
            'gambar_produk.required'    => 'gambar wajib diisi'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back(); //jika gagal akan kembali lagi ke halaman pengisian user
        }



        // digunakan untuk melakukan pengecekan id nya apakah sudah ada di database, jika ada maka akan dilakukan edit, jika tidak ada berati ini adalah user baru
        if (!empty($id)) {
            $data = MasterProdukModel::find($id);
        } else {
            $data = new MasterProdukModel;
            // $data->created_by = auth()->user()->id;
        }

        // ini adalah inputan user, berkaitan dengan form di tampilan
        $data->kode_barang = $request->input('kode_barang');
        $data->nama_barang = $request->input('nama_barang');
        $data->kategori_id = $request->input('kategori_id');
        $data->harga_barang = $request->input('harga_barang');
        $data->stok = $request->input('stok');
        // $data->gambar_produk = $request->input('gambar_produk');
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $path = $file->store('gambar_produk', 'public');
            $data->gambar_produk = $path;
        }
        $data->status = 1;
        // dd($data);
        $data->save(); //disimpan ke database dengan nama table users yang ada di MasterUserModel --> models nya

        return redirect()->route('master_produk.index')->with('toast_success', 'Akhirnya ada barang baru')->with('produk_saved', $data);
    }

    // function mengubah user
    public function editProduk($id) //passing ke routes parameter id nya
    {
        //dilakukan pencarian dulu by id
        $data = MasterProdukModel::find($id);
        $kategoris = MasterCategoryModel::all();

        return view('master_produk.add_produk', compact('data', 'kategoris'));
    }

    public function deleteProduk($id)
    {
        $data = MasterProdukModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
