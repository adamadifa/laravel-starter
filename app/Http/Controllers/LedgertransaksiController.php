<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LedgertransaksiController extends Controller
{
    public function index()
    {
        return view('keuangan.ledger.index');
    }
}
