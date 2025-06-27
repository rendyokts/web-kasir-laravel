<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProdukModel extends Model
{
    protected $table ='barang';

    protected $guarded = 'id';

    public function kategori()
    {
        return $this->belongsTo(MasterCategoryModel::class,'kategori_id');
    }
}