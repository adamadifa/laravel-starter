<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldosimpanan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_saldo_simpanan';
    protected $guarded = [];
}
