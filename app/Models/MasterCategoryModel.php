<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCategoryModel extends Model
{
    protected $table = 'kategori';

    protected $guarded = 'id';

    public function produk()
    {
        return $this->hasMany(MasterProdukModel::class);
    }
}