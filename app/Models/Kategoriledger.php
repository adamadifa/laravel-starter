<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoriledger extends Model
{
    use HasFactory;
    protected $table = 'ledger_kategori';
    protected $fillable = ['nama_kategori', 'jenis_kategori'];
}
