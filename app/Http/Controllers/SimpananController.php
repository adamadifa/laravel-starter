<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Saldosimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    public function index(Request $request)
    {

        $subquerySaldosimpanan = Saldosimpanan::select('no_anggota', DB::raw('SUM(jumlah) as jml_saldo'))
            ->groupBy('no_anggota');
        $query = Anggota::query();
        $query->select('koperasi_anggota.*', 'jml_saldo');
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', "%" . $request->nama_lengkap . "%");
        }
        $query->leftJoinSub($subquerySaldosimpanan, 'saldosimpanan', 'koperasi_anggota.no_anggota', '=', 'saldosimpanan.no_anggota');
        $anggota = $query->paginate(10);
        $anggota->appends($request->all());
        $data['anggota'] = $anggota;
        return view('koperasi.simpanan.index', $data);
    }


    public function show($no_anggota)
    {
        $no_anggota = Crypt::decrypt($no_anggota);
        $data['anggota'] = Anggota::where('no_anggota', $no_anggota)->first();
        return view('koperasi.simpanan.show', $data);
    }
}
