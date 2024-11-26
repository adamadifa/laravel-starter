<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisbiaya extends Model
{
    use HasFactory;
    protected $table = "jenis_biaya";
    protected $primaryKey = "kode_jenis_biaya";
    protected $guarded = [];
    public $incrementing = false;
}
