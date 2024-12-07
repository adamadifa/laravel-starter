<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    protected $table = 'ledger';
    protected $guarded = [];
    protected $primaryKey = 'kode_ledger';
    public $incrementing = false;
}
