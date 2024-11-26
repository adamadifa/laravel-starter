<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasipembayaranpendidikan extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_pendidikan_mutasi';
    protected $primaryKey = 'kode_mutasi';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
