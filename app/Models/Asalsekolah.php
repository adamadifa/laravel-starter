<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asalsekolah extends Model
{
    use HasFactory;
    protected $table = "asal_sekolah";
    protected $primaryKey = "kode_asal_sekolah";
    protected $guarded = [];
    public $incrementing = false;
}
