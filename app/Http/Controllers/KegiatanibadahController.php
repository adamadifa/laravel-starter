<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatanibadah;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Kategoriibadah;

class KegiatanibadahController extends Controller
{

    public function index(Request $request)
    {
        $query = Kegiatanibadah::query();
        $query->join('kategori_ibadah', 'kegiatan_ibadah.id_kategori_ibadah', '=', 'kategori_ibadah.id');
        $kegiatanibadah = $query->get();
        return view('datamaster.kegiatanibadah.index', compact('kegiatanibadah'));
    }

    public function create()
    {
        $kategori_ibadah = Kategoriibadah::all();
        $data['kategori_ibadah'] = $kategori_ibadah;
        return view('datamaster.kegiatanibadah.create', $data);
    }

    public function store(Request $request)
    {

        try {
            $kegiatanibadah = new Kegiatanibadah();
            $kegiatanibadah->nama_kegiatan = $request->nama_kegiatan;
            $kegiatanibadah->id_kategori_ibadah = $request->id_kategori_ibadah;
            $kegiatanibadah->save();
            return Redirect::back()->with(messageSuccess('Kegiatan Ibadah Berhasil Ditambahkan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kegiatan Ibadah Gagal Ditambahkan', $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kegiatanibadah = Kegiatanibadah::findorFail($id);
        $kategori_ibadah = Kategoriibadah::all();
        $data['kategori_ibadah'] = $kategori_ibadah;
        $data['kegiatanibadah'] = $kegiatanibadah;
        return view('datamaster.kegiatanibadah.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        try {
            $kegiatanibadah = Kegiatanibadah::findorFail($id);
            $kegiatanibadah->nama_kegiatan = $request->nama_kegiatan;
            $kegiatanibadah->id_kategori_ibadah = $request->id_kategori_ibadah;
            $kegiatanibadah->save();
            return Redirect::back()->with(messageSuccess('Kegiatan Ibadah Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kegiatan Ibadah Gagal Diubah', $e->getMessage()));
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $kegiatanibadah = Kegiatanibadah::findorFail($id);
            $kegiatanibadah->delete();
            return Redirect::back()->with(messageSuccess('Kegiatan Ibadah Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kegiatan Ibadah Gagal Dihapus', $e->getMessage()));
        }
    }
}
