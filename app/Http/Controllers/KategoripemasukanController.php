<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategoripemasukan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class KategoripemasukanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategoripemasukan::query();
        if (!empty($request->nama_kategori_pemasukan)) {
            $query->where('nama_kategori', 'like', '%' . $request->nama_kategori_pemasukan . '%');
        }

        $query->orderBy('kode_kategori');
        $data['kategoripemasukan'] = $query->get();
        return view('keuangan.kategoripemasukan.index', $data);
    }

    public function create()
    {
        return view('kategoripemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);

        try {
            Kategoripemasukan::create($request->all());
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_kategori)
    {
        $kode_kategori = Crypt::decrypt($kode_kategori);
        try {
            Kategoripemasukan::where('kode_kategori', $kode_kategori)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_kategori)
    {
        $kode_kategori = Crypt::decrypt($kode_kategori);
        $data['kategoripemasukan'] = Kategoripemasukan::where('kode_kategori', $kode_kategori)->first();
        return view('kategoripemasukan.edit', $data);
    }

    public function update(Request $request, $kode_kategori)
    {
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);
        $kode_kategori = Crypt::decrypt($kode_kategori);
        try {
            Kategoripemasukan::where('kode_kategori', $kode_kategori)->update([
                'kode_kategori' => $request->kode_kategori,
                'nama_kategori' => $request->nama_kategori
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
