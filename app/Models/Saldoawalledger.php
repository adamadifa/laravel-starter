<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldoawalledger extends Model
{
    use HasFactory;
    protected $table = 'ledger_saldoawal';
    protected $guarded = [];
    protected $primaryKey = 'kode_ledger';
    public $incrementing = false;
}
