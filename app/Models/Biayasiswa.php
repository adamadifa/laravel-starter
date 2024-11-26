<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biayasiswa extends Model
{
    use HasFactory;
    protected $table = 'siswa_biaya';
    protected $guarded = [];
}
