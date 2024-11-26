<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potonganpendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_potongan';
    protected $primaryKey = 'kode_potongan';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
