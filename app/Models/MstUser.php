<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstUser extends Model
{
    use HasFactory;

    protected $table = 'mst_user';
    public $timestamps = false;
    protected $guarded = ['id'];
}
