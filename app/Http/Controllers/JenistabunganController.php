<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenistabungan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class JenistabunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Jenistabungan::query();
        if (!empty($request->jenis_tabungan_search)) {
            $query->where('jenis_tabungan', 'like', '%' . $request->jenis_tabungan_search . '%');
        }
        $jenistabungan = $query->paginate(10);
        $jenistabungan->appends($request->all());
        $data['jenistabungan'] = $jenistabungan;
        return view('koperasi.jenistabungan.index', $data);
    }

    public function create()
    {
        return view('koperasi.jenistabungan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tabungan' => 'required|max:3|min:3|unique:koperasi_jenis_tabungan,kode_tabungan',
            'jenis_tabungan' => 'required',
        ]);

        try {
            Jenistabungan::create([
                'kode_tabungan' => $request->kode_tabungan,
                'jenis_tabungan' => $request->jenis_tabungan,
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($kode_tabungan)
    {
        $kode_tabungan = Crypt::decrypt($kode_tabungan);
        $data['jenistabungan'] = Jenistabungan::where('kode_tabungan', $kode_tabungan)->first();
        return view('koperasi.jenistabungan.edit', $data);
    }


    public function update(Request $request, $kode_tabungan)
    {
        $kode_tabungan = Crypt::decrypt($kode_tabungan);
        $request->validate([
            'jenis_tabungan' => 'required',
        ]);

        try {
            Jenistabungan::where('kode_tabungan', $kode_tabungan)->update([
                'jenis_tabungan' => $request->jenis_tabungan,
            ]);

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy($kode_tabungan)
    {
        $kode_tabungan = Crypt::decrypt($kode_tabungan);
        try {
            Jenistabungan::where('kode_tabungan', $kode_tabungan)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
