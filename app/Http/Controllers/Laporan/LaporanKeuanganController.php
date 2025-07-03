<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuanganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

//Status 1 = Ada
//Status 2 = di Hide, jadi tidak terhapus datanya

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        return view('laporan_keuangan.index');
    }

    //pemasukan

    public function uang_masuk()
    {

        $query = LaporanKeuanganModel::select('*')->where('jenis', 'masuk')->where('status', 1)->get();
        return view('laporan_keuangan.uang_masuk.index', compact('query'));
    }

    public function index_uang_masuk()
    {

        $data = new LaporanKeuanganModel;
        return view('laporan_keuangan.uang_masuk.form', compact('data'));
    }

    public function save_pemasukan(Request $request)
    {
        $mandatory = [
            'tanggal' => 'required',
            'jumlah' => 'required',
        ];

        $validator = Validator::make($request->all(), $mandatory, [
            'tanggal.required' => 'Tanggal wajib diisi',
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

        $jumlah = str_replace([',','.'], '', $request->jumlah);

        $data->tanggal = $request->input('tanggal');
        $data->jenis = 'masuk';
        $data->status = 1;
        $data->keterangan = $request->input('keterangan');
        $data->jumlah = $jumlah;
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $path = $file->store('lampiran', 'public');
            $data->file_lampiran = $path;
        }
        $data->created_by = auth()->user()->id;
        $data->save();

        return redirect()->route('laporan_keuangan.uang_masuk')->with('toast_success', 'Data Keuangan berhasil disimpan');
    }

    public function edit_uang_masuk($id)
    {
        $data = LaporanKeuanganModel::find($id);
        return view('laporan_keuangan.uang_masuk.form', compact('data'));
    }

    public function delete_uang_masuk($id)
    {

        // function ini tidak menghapus tapi mengubah statusnya menjadi 2 yang mana tidak ditampilkan ke view user, data di table view user hilang, tapi di database tetap ada
        $data = LaporanKeuanganModel::findOrFail($id);
        $data->status = 2;
        $data->save();

        return redirect()->back()->with('success', 'Data uang masuk berhasil dihapus');
    }

    //pengeluaran

    public function uang_keluar()
    {
        $query = LaporanKeuanganModel::select('*')->where('jenis', 'keluar')->where('status', 1)->get();
        return view('laporan_keuangan.uang_keluar.index', compact('query'));
    }

    public function index_uang_keluar()
    {

        $data = new LaporanKeuanganModel;
        // dd ($data);
        return view('laporan_keuangan.uang_keluar.form', compact('data'));
    }
    public function save_pengeluaran(Request $request)
    {
        // dd($request->all());
        $mandatory = [
            'tanggal' => 'required',
            'jumlah' => 'required',
        ];

        $validator = Validator::make($request->all(), $mandatory, [
            'tanggal.required' => 'Tanggal wajib diisi',
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

        $jumlah = str_replace([',','.'], '', $request->jumlah);

        $data->tanggal = $request->input('tanggal');
        $data->jenis = 'keluar';
        $data->status = 1;
        $data->keterangan = $request->input('keterangan');
        $data->jumlah = $jumlah;
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $path = $file->store('lampiran', 'public');
            $data->file_lampiran = $path;
        }
        $data->created_by = auth()->user()->id;
        $data->save();

        return redirect()->route('laporan_keuangan.uang_keluar')->with('toast_success', 'Data Keuangan berhasil disimpan');
    }

        public function delete_uang_keluar($id)
    {
        // function ini tidak menghapus tapi mengubah statusnya menjadi 2 yang mana tidak ditampilkan ke view user, data di table view user hilang, tapi di database tetap ada
        $data = LaporanKeuanganModel::findOrFail($id);
        $data->status = 2;
        $data->save();

        return redirect()->back()->with('success', 'Data uang keluar berhasil dihapus');
    }

    public function edit_uang_keluar($id)
    {
        $data = LaporanKeuanganModel::find($id);
        return view('laporan_keuangan.uang_keluar.form', compact('data'));
    }


}
