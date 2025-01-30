<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pembiayaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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


    public function show($no_akad, Request $request)
    {
        $no_akad = Crypt::decrypt($no_akad);
        $pembiayaan = Pembiayaan::where('no_akad', $no_akad)
            ->join('koperasi_jenis_pembiayaan', 'koperasi_pembiayaan.kode_pembiayaan', '=', 'koperasi_jenis_pembiayaan.kode_pembiayaan')
            ->first();

        $anggota = Anggota::where('no_anggota', $pembiayaan->no_anggota)
            ->leftJoin('provinces', 'koperasi_anggota.id_province', '=', 'provinces.id')
            ->leftJoin('regencies', 'koperasi_anggota.id_regency', '=', 'regencies.id')
            ->leftJoin('districts', 'koperasi_anggota.id_district', '=', 'districts.id')
            ->leftJoin('villages', 'koperasi_anggota.id_village', '=', 'villages.id')
            ->select('koperasi_anggota.*', 'provinces.name as province_name', 'regencies.name as regency_name', 'districts.name as district_name', 'villages.name as village_name')
            ->first();

        $dari = date('Y-m-d', strtotime('-60s days'));
        $sampai = date('Y-m-d');
        $data['pembiayaan'] = $pembiayaan;
        $data['anggota'] = $anggota;
        return view('koperasi.pembiayaan.show', $data);
    }
}
