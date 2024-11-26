<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailbiaya extends Model
{
    use HasFactory;
    protected $table = "konfigurasi_biaya_detail";
    protected $guarded = [];
}
