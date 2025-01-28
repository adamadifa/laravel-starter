<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksitabungan extends Model
{
    use HasFactory;

    protected $table = 'koperasi_tabungan_transaksi';
    protected $primaryKey = 'no_transaksi';
    protected $guarded = [];
    public $incrementing = false;
}
