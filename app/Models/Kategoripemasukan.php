<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoripemasukan extends Model
{
    use HasFactory;

    protected $table = 'ledger_kategori_pemasukan';
    protected $guarded = [];
    protected $primaryKey = 'kode_kategori';
    public $incrementing = false;
}
