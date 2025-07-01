<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';

    protected $guarded = ['id'];

     public function details()
    {
        return $this->hasMany(TransaksiDetailModel::class, 'transaksi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(MasterUserModel::class);
    }
}
