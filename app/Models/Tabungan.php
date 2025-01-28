<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $table = 'koperasi_tabungan';
    protected $primaryKey = 'no_rekening';
    protected $guarded = [];
    public $incrementing = false;
}
