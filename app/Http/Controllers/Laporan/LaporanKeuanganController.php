<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuanganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        return view('laporan_keuangan.index');
    }

    public function uang_masuk()
    {
        return view('laporan_keuangan.uang_masuk.index');
    }

    public function uang_keluar()
    {
        return view('laporan_keuangan.uang_keluar.index');
    }

    public function index_uang_masuk()
    {
        $query = LaporanKeuanganModel::select('*')->get();
        return view('laporan_keuangan.uang_masuk.form', compact('query'));
    }

    public function save_pemasukan(Request $request)
    {
        $mandatory = [
            'tanggal' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required',
        ];

        $validator = Validator::make($request->all(), $mandatory, [
            'tanggal.required' => 'Tanggal wajib diisi',
            'jenis.required' => 'Jenis wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            return redirect()->back();
        }

        $id = $request->input('id');

        if (!empty($id)) {
            $data = LaporanKeuanganModel::find($id);
        } else {
            $data = new LaporanKeuanganModel();
        }

        $data->tanggal = $request->input('tanggal');
        $data->jenis = $request->input('jenis');
        $data->kategori = $request->input('kategori');
        $data->keterangan = $request->input('keterangan');
        $data->jumlah = $request->input('jumlah');
        $data->file_lampiran = $request->input('file_lampiran');
        $data->save();

        return redirect()->route('laporan_keuangan.uang_masuk')->with('toast_success', 'Data Keuangan berhasil disimpan');
    }

    public function tambah_pengeluaran()
    {
        return view('laporan_keuangan.uang_keluar.form');
    }
}
