<?php

namespace App\Http\Controllers\Transaksi;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function list_transaksi()
    {
        $data = TransaksiModel::orderBy('tanggal', 'desc')->paginate(10);
        return view('transaksi.index', compact('data'));
    }

    public function detail_transaksi($id)
    {
        $transaksi = TransaksiModel::with(['details.produk'])->findOrFail($id);
        // dd($transaksi);
        return view('transaksi.detail', compact('transaksi'));
    }
    //dd

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

    public function getTransaksiJson(Request $request)
    {
        $query = TransaksiModel::with('user')->select(['id', 'kode_transaksi', 'tanggal', 'total', 'user_id']);

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                ->whereYear('tanggal', $request->tahun);
        }


        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('user_nama', function ($row) {
                return $row->user->name ?? '-';
            })
            ->editColumn('tanggal', function ($row) {
                return \Carbon\Carbon::parse($row->tanggal)->format('d M Y H:i');
            })
            ->editColumn('total', function ($row) {
                return 'Rp ' . number_format($row->total, 0, ',', '.');
            })
            ->addColumn('aksi', function ($row) {
                $urlDetail = route('transaksi.detail', ['id' => $row->id]);
                $urlCetak = route('transaksi.cetak', ['id' => $row->id]);
                return '
                <div class="btn-group" role="group" aria-label="Aksi">
                <a href="' . $urlDetail . '"><i class="menu-icon icon-base ti tabler-zoom text-info"></i></a>
                    <a href="' . $urlCetak . '"><i class="menu-icon icon-base ti tabler-printer text-success"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function export(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return Excel::download(new TransaksiExport($bulan, $tahun), 'transaksi.xlsx');
    }

    public function cetak($id)
    {
        $transaksi = TransaksiModel::with(['user', 'details.produk'])->findOrFail($id);

        $pdf = Pdf::loadView('transaksi.cetak', compact('transaksi'))->setPaper([0, 0, 226.77, 400], 'portrait');
        return $pdf->download('struk-transaksi-' . $transaksi->kode_transaksi . '.pdf');
    }
}
