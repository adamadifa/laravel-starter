<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenispembiayaan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_jenis_pembiayaan';
    protected $primaryKey = 'kode_pembiayaan';
    public $incrementing = false;
    protected $guarded = [];
}
