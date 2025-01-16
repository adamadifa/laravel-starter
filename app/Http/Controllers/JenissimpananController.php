<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenissimpanan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class JenissimpananController extends Controller
{
    public function index(Request $request)
    {
        $query = Jenissimpanan::query();
        if (!empty($request->jenis_simpanan_search)) {
            $query->where('jenis_simpanan', 'like', '%' . $request->jenis_simpanan_search . '%');
        }
        $jenissimpan = $query->paginate(10);
        $jenissimpan->appends($request->all());
        $data['jenissimpanan'] = $jenissimpan;
        return view('koperasi.jenissimpanan.index', $data);
    }

    public function create()
    {
        return view('koperasi.jenissimpanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_simpanan' => 'required|max:3|min:3|unique:koperasi_jenis_simpanan,kode_simpanan',
            'jenis_simpanan' => 'required',
        ]);

        try {
            Jenissimpanan::create([
                'kode_simpanan' => $request->kode_simpanan,
                'jenis_simpanan' => $request->jenis_simpanan,
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_simpanan)
    {
        $kode_simpanan = Crypt::decrypt($kode_simpanan);
        $data['jenissimpanan'] = Jenissimpanan::where('kode_simpanan', $kode_simpanan)->first();
        return view('koperasi.jenissimpanan.edit', $data);
    }


    public function update(Request $request, $kode_simpanan)
    {
        $kode_simpanan = Crypt::decrypt($kode_simpanan);
        $request->validate([
            'jenis_simpanan' => 'required',
        ]);

        try {
            Jenissimpanan::where('kode_simpanan', $kode_simpanan)->update([
                'jenis_simpanan' => $request->jenis_simpanan,
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
    public function destroy($kode_simpanan)
    {
        $kode_simpanan = Crypt::decrypt($kode_simpanan);
        try {
            Jenissimpanan::where('kode_simpanan', $kode_simpanan)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
