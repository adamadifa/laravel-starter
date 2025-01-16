<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenissimpanan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_jenis_simpanan';
    protected $guarded = [];
    protected $primaryKey = 'kode_simpanan';
    public $incrementing = false;
}
