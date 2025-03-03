<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatanibadah extends Model
{
    use HasFactory;
    protected $table = "kegiatan_ibadah";
    protected $guarded = ['id'];
}
