<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $query = Ledger::query();
        if (!empty($request->nama_ledger)) {
            $query->where('nama_ledger', 'like', '%' . $request->nama_ledger . '%');
        }

        $query->orderBy('kode_ledger');
        $data['ledger'] = $query->get();
        return view('datamaster.ledger.index', $data);
    }


    public function create()
    {
        return view('datamaster.ledger.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ledger' => 'required',
            'no_rekening' => 'required',
        ]);

        try {
            $lastledger = Ledger::orderBy('kode_ledger', 'desc')->first();
            $last_kode_ledger = $lastledger != null ? $lastledger->kode_ledger : '';
            $kode_ledger = buatkode($last_kode_ledger, 'LR', 3);
            Ledger::create([
                'kode_ledger' => $kode_ledger,
                'nama_ledger' => $request->nama_ledger,
                'no_rekening' => $request->no_rekening
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_ledger)
    {
        $kode_ledger = Crypt::decrypt($kode_ledger);
        try {
            Ledger::where('kode_ledger', $kode_ledger)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_ledger)
    {
        $kode_ledger = Crypt::decrypt($kode_ledger);
        $data['ledger'] = Ledger::where('kode_ledger', $kode_ledger)->first();
        return view('datamaster.ledger.edit', $data);
    }

    public function update(Request $request, $kode_ledger)
    {
        $request->validate([
            'kode_ledger' => 'required',
            'nama_ledger' => 'required',
        ]);
        $kode_ledger = Crypt::decrypt($kode_ledger);
        try {
            Ledger::where('kode_ledger', $kode_ledger)->update([
                'nama_ledger' => $request->nama_ledger,
                'nomor_rekening' => $request->no_rekening
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
