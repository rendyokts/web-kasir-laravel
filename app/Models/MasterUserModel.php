<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MasterUserModel extends Model
{

    use HasApiTokens;
    
    protected $table = 'users';

    protected $guarded = 'id';
}
