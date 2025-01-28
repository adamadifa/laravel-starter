<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembiayaan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_pembiayaan';
    protected $primaryKey = 'no_akad';
    protected $guarded = [];
    public $incrementing = false;
}
