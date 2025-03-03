<?php

namespace App\Http\Controllers;

use App\Models\Kategoriibadah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class KategoriibadahController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategoriibadah::query();
        $kategoriibadah = $query->get();
        return view('datamaster.kategoriibadah.index', compact('kategoriibadah'));
    }

    public function create()
    {
        return view('datamaster.kategoriibadah.create');
    }

    public function store(Request $request)
    {

        try {
            $kategoriibadah = new Kategoriibadah();
            $kategoriibadah->kategori_ibadah = $request->kategori_ibadah;

            $kategoriibadah->save();
            return Redirect::back()->with(messageSuccess('Kategori Ibadah Berhasil Ditambahkan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kategori Ibadah Gagal Ditambahkan', $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kategoriibadah = Kategoriibadah::findorFail($id);
        $data['kategoriibadah'] = $kategoriibadah;
        return view('datamaster.kategoriibadah.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        try {
            $kategoriibadah = Kategoriibadah::findorFail($id);
            $kategoriibadah->kategori_ibadah = $request->kategori_ibadah;
            $kategoriibadah->save();
            return Redirect::back()->with(messageSuccess('Kategori Ibadah Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kategori Ibadah Gagal Diubah', $e->getMessage()));
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $kategoriibadah = Kategoriibadah::findorFail($id);
            $kategoriibadah->delete();
            return Redirect::back()->with(messageSuccess('Kategori Ibadah Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError('Kategori Ibadah Gagal Dihapus', $e->getMessage()));
        }
    }
}
