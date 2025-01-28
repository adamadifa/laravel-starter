<?php

namespace App\Http\Controllers;

use App\Models\Pembiayaan;
use Illuminate\Http\Request;

class PembiayaanController extends Controller
{
    public function index(Request $request)
    {

        $query = Pembiayaan::query();
        $query->join('koperasi_anggota', 'koperasi_pembiayaan.no_anggota', '=', 'koperasi_anggota.no_anggota');
        $query->join('koperasi_jenis_pembiayaan', 'koperasi_pembiayaan.kode_pembiayaan', '=', 'koperasi_jenis_pembiayaan.kode_pembiayaan');
        if (!empty($request->nama_anggota)) {
            $query->where('koperasi_anggota.nama_lengkap', 'like', "%" . $request->nama_anggota . "%");
        }
        $query->orderBy('tanggal', 'desc');
        $pembiayaan = $query->paginate(15);
        $pembiayaan->appends($request->all());

        $data['pembiayaan'] = $pembiayaan;
        return view('koperasi.pembiayaan.index', $data);
    }
}
