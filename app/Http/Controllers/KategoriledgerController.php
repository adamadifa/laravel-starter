<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategoriledger;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class KategoriledgerController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategoriledger::query();
        if (!empty($request->nama_kategori_ledger)) {
            $query->where('nama_kategori', 'like', '%' . $request->nama_kategori_ledger . '%');
        }

        $query->orderBy('id');
        $data['kategoriledger'] = $query->get();
        return view('keuangan.kategoriledger.index', $data);
    }

    public function create()
    {
        return view('keuangan.kategoriledger.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);

        try {
            Kategoriledger::create(['nama_kategori' => $request->nama_kategori, 'jenis_kategori' => $request->jenis_kategori]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($id)
    {

        try {
            Kategoriledger::where('id', $id)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($id)
    {

        $data['kategoriledger'] = Kategoriledger::where('id', $id)->first();
        return view('keuangan.kategoriledger.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);

        try {
            Kategoriledger::where('id', $id)->update([
                'nama_kategori' => $request->nama_kategori,
                'jenis_kategori' => $request->jenis_kategori
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function getkategoriledger(Request $request)
    {
        $debet_kredit = $request->debet_kredit;
        $query = Kategoriledger::query();
        if ($debet_kredit == 'D') {
            $query->where('jenis_kategori', 'PK');
        } else {
            $query->where('jenis_kategori', 'PM');
        }
        $query->orderBy('nama_kategori');
        $kategori = $query->get();
        echo '<option value="">Pilih Kategori</option>';
        foreach ($kategori as $d) {
            echo '<option value="' . $d->id . '"' . ($d->id == $request->id_kategori ? 'selected' : '') . '>' . $d->nama_kategori . '</option>';
        }
    }
}
