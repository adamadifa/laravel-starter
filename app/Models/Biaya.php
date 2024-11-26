<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;
    protected $table = "konfigurasi_biaya";
    protected $primaryKey = "kode_biaya";
    protected $guarded = [];
    public $incrementing = false;
}
