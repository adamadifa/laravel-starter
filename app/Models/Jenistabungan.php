<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenistabungan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_jenis_tabungan';
    protected $primaryKey = 'kode_tabungan';
    protected $guarded = [];
    public $incrementing = false;
}
