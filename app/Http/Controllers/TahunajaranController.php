<?php

namespace App\Http\Controllers;

use App\Models\Tahunajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class TahunajaranController extends Controller
{
    public function index()
    {
        $data['tahun_ajaran'] = Tahunajaran::orderBy('kode_ta', 'desc')->get();
        return view('konfigurasi.tahunajaran.index', $data);
    }

    public function create()
    {
        return view('konfigurasi.tahunajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ta' => 'required|max:6|min:6|unique:konfigurasi_tahun_ajaran,kode_ta',
            'tahun_ajaran' => 'required',
            'status' => 'required'
        ]);

        try {
            Tahunajaran::create([
                'kode_ta' => $request->kode_ta,
                'tahun_ajaran' => $request->tahun_ajaran,
                'status' => $request->status
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_ta)
    {
        $kode_ta = Crypt::decrypt($kode_ta);
        $data['tahunajaran'] = Tahunajaran::where('kode_ta', $kode_ta)->first();
        return view('konfigurasi.tahunajaran.edit', $data);
    }




    public function update(Request $request, $kode_ta)
    {
        $kode_ta = Crypt::decrypt($kode_ta);
        $request->validate([
            'tahun_ajaran' => 'required',
            'status' => 'required'
        ]);

        try {
            Tahunajaran::where('kode_ta', $kode_ta)->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'status' => $request->status
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_ta)
    {
        $kode_ta = Crypt::decrypt($kode_ta);
        try {
            Tahunajaran::where('kode_ta', $kode_ta)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
