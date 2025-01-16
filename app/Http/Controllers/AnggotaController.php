<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('koperasi.anggota.index');
    }

    public function create()
    {
        return view('koperasi.anggota.create');
    }
}
