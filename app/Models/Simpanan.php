<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_simpanan';
    protected $primaryKey = 'no_transaksi';
    public $incrementing = false;
    protected $guarded = [];
}
