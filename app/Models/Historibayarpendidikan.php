<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historibayarpendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan_historibayar';
    protected $guarded = [];
    protected $primaryKey = 'no_bukti';
    public $incrementing = false;
}
