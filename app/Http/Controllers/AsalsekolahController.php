<?php

namespace App\Http\Controllers;

use App\Models\Asalsekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AsalsekolahController extends Controller
{
    public function create()
    {
        return view('datamaster.asalsekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'kode_unit' => 'required',
            'kota' => 'required',
        ]);

        try {
            $lastasalsekolah = Asalsekolah::orderBy('kode_asal_sekolah', 'desc')->first();
            $last_kode_asal_sekolah = $lastasalsekolah != null ? $lastasalsekolah->kode_asal_sekolah : 0;
            $kode_asal_sekolah = buatkode($last_kode_asal_sekolah, 'S', 4);
            Asalsekolah::create([
                'kode_asal_sekolah' => $kode_asal_sekolah,
                'nama_sekolah' => $request->input('nama_sekolah'),
                'kode_unit' => $request->input('kode_unit'),
                'kota' => $request->input('kota'),
            ]);
            return response()->json(['status' => true, 'message' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }


    public function getasalsekolahbyunit($kode_unit, $kode_asal_sekolah)
    {
        $asalsekolah = Asalsekolah::where('kode_unit', $kode_unit)->orderBy('kode_asal_sekolah', 'desc')->get();
        echo "<option value=''>Pilih Asal Sekolah</option>";
        foreach ($asalsekolah as $d) {
            echo "<option " . ($d->kode_asal_sekolah == $kode_asal_sekolah ? "selected" : "") . " value='$d->kode_asal_sekolah'>" . textUpperCase($d->nama_sekolah) . "</option>";
        }
    }
}
