<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterUserModel extends Model
{
    protected $table = 'users';

    protected $guarded = 'id';
}
