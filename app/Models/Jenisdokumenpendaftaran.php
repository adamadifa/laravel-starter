<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisdokumenpendaftaran extends Model
{
    use HasFactory;

    protected $table = "pendaftaran_jenis_dokumen";
    protected $primaryKey = "kode_dokumen";
    protected $guarded = [];
    public $incrementing = false;
}
