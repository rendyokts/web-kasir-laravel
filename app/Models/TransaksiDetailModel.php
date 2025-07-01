<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';

    protected $guarded = ['id'];


     public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'transaksi_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(MasterProdukModel::class);
    }
}
