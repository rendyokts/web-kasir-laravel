<?php

namespace App\Exports;

use App\Models\TransaksiModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }
    public function collection()
    {
        return TransaksiModel::all();
    }

    public function view(): View
    {
        $query = TransaksiModel::with('user')
            ->when($this->bulan, fn($q) => $q->whereMonth('tanggal', $this->bulan))
            ->when($this->tahun, fn($q) => $q->whereYear('tanggal', $this->tahun))
            ->get();

        return view('exports.transaksi', [
            'data' => $query
        ]);
    }
}
