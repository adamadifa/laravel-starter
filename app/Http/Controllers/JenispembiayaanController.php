<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenispembiayaan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class JenispembiayaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jenispembiayaan::query();
        if (!empty($request->jenis_pembiayaan_search)) {
            $query->where('jenis_pembiayaan', 'like', '%' . $request->jenis_pembiayaan_search . '%');
        }
        $jenispembiayaan = $query->paginate(10);
        $jenispembiayaan->appends($request->all());
        $data['jenispembiayaan'] = $jenispembiayaan;
        return view('koperasi.jenispembiayaan.index', $data);
    }

    public function create()
    {
        return view('koperasi.jenispembiayaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pembiayaan' => 'required|max:3|min:3|unique:koperasi_jenis_pembiayaan,kode_pembiayaan',
            'jenis_pembiayaan' => 'required',
            'persentase' => 'required|numeric',
        ]);

        try {
            Jenispembiayaan::create([
                'kode_pembiayaan' => $request->kode_pembiayaan,
                'jenis_pembiayaan' => $request->jenis_pembiayaan,
                'persentase' => $request->persentase,
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($kode_pembiayaan)
    {
        $kode_pembiayaan = Crypt::decrypt($kode_pembiayaan);
        $data['jenispembiayaan'] = Jenispembiayaan::where('kode_pembiayaan', $kode_pembiayaan)->first();
        return view('koperasi.jenispembiayaan.edit', $data);
    }


    public function update(Request $request, $kode_pembiayaan)
    {
        $kode_pembiayaan = Crypt::decrypt($kode_pembiayaan);
        $request->validate([
            'jenis_pembiayaan' => 'required',
            'persentase' => 'required|numeric',
        ]);

        try {
            Jenispembiayaan::where('kode_pembiayaan', $kode_pembiayaan)->update([
                'jenis_pembiayaan' => $request->jenis_pembiayaan,
                'persentase' => $request->persentase,
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy($kode_pembiayaan)
    {
        $kode_pembiayaan = Crypt::decrypt($kode_pembiayaan);
        try {
            Jenispembiayaan::where('kode_pembiayaan', $kode_pembiayaan)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
