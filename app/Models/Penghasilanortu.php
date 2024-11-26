<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghasilanortu extends Model
{
    use HasFactory;
    protected $table = "penghasilan_orangtua";
    protected $primaryKey = "kode_penghasilan_ortu";
    protected $guarded = [];
    public $incrementing = false;
}
