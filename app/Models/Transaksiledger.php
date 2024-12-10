<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksiledger extends Model
{
    use HasFactory;
    protected $table = 'ledger_transaksi';
    protected $guarded = [];
    protected $primaryKey = 'no_bukti';
}
