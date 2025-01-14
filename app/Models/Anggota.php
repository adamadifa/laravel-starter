<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'koperasi_anggota';
    protected $guarded = [];
    protected $primaryKey = 'no_anggota';
    public $incrementing = false;
}
