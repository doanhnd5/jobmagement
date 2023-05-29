<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    use HasFactory;

    protected $table = 'job_tag';
    public $timestamps = false;
    protected $guarded = ['id'];
}
