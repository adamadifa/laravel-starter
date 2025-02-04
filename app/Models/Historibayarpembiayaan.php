<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historibayarpembiayaan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_pembiayaan_historibayar';
    protected $primaryKey = 'no_transaksi';
    public $incrementing = false;
    protected $guarded = [];
}
