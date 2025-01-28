<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index(Request $request)
    {


        $query = Tabungan::query();
        $query->select('koperasi_tabungan.*', 'nama_lengkap', 'jenis_tabungan');
        $query->join('koperasi_anggota', 'koperasi_tabungan.no_anggota', '=', 'koperasi_anggota.no_anggota');
        $query->join('koperasi_jenis_tabungan', 'koperasi_tabungan.kode_tabungan', '=', 'koperasi_jenis_tabungan.kode_tabungan');
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', "%" . $request->nama_lengkap . "%");
        };
        $query->orderBy('no_rekening', 'desc');
        $tabungan = $query->paginate(10);
        $tabungan->appends($request->all());
        $data['tabungan'] = $tabungan;
        return view('koperasi.tabungan.index', $data);
    }
}
