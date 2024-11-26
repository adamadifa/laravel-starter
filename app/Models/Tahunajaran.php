<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunajaran extends Model
{
    use HasFactory;
    protected $table = "konfigurasi_tahun_ajaran";
    protected $primaryKey = "kode_ta";
    protected $guarded = [];
    public $incrementing = false;
}
