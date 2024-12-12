<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgertransaksiController extends Controller
{
    public function index()
    {
        return view('keuangan.ledger.index');
    }

    public function create()
    {
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
        return view('keuangan.ledger.create', $data);
    }
}
