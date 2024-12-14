<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Saldoawalledger;
use App\Models\Transaksiledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LedgertransaksiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = !empty($request->dari) ? date('m', strtotime($request->dari)) : '';
        $tahun = !empty($request->dari) ? date('Y', strtotime($request->dari)) : '';

        $data['saldo_awal']  = Saldoawalledger::where('bulan', $bulan)->where('tahun', $tahun)
            ->where('kode_ledger', $request->kode_ledger)->first();
        $start_date = $tahun . "-" . $bulan . "-01";
        if (!empty($request->dari && !empty($request->sampai))) {
            $data['mutasi']  = Transaksiledger::select(
                DB::raw("SUM(IF(debet_kredit='K',jumlah,0))as kredit"),
                DB::raw("SUM(IF(debet_kredit='D',jumlah,0))as debet"),
            )
                ->where('tanggal', '>=', $start_date)
                ->where('tanggal', '<', $request->dari)
                ->where('kode_ledger', $request->kode_ledger)
                ->first();
        } else {
            $data['mutasi'] = null;
        }

        $query = Transaksiledger::query();
        $query->select('ledger_transaksi.*');
        $query->join('ledger', 'ledger_transaksi.kode_ledger', '=', 'ledger.kode_ledger');
        if (!empty($request->kode_ledger)) {
            $query->where('ledger_transaksi.kode_ledger', $request->kode_ledger);
        }

        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('ledger_transaksi.tanggal', [$request->dari, $request->sampai]);
        }
        $query->orderBy('ledger_transaksi.tanggal');
        $query->orderBy('ledger_transaksi.created_at');
        $data['ledgertransaksi'] = $query->get();

        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
        return view('keuangan.ledger.index', $data);
    }

    public function create()
    {
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();

        return view('keuangan.ledger.create', $data);
    }

    public function store(Request $request)
    {
        $tahun = date('y', strtotime($request->tanggal));
        $bulan = date('m', strtotime($request->tanggal));
        $lastledger = Transaksiledger::select('no_bukti')
            ->where('kode_ledger', $request->kode_ledger)
            ->whereRaw('YEAR(tanggal)=' . date('Y', strtotime($request->tanggal)))
            ->orderBy('no_bukti', 'desc')
            ->first();


        $last_no_bukti = $lastledger != null ?  $lastledger->no_bukti : '';
        // dd($lastledger->no_bukti);
        $no_bukti = buatkode($last_no_bukti, $request->kode_ledger . $tahun, 5);
        // dd($no_bukti);
        try {
            //code...
            Transaksiledger::create([
                'no_bukti' => $no_bukti,
                'kode_ledger' => $request->kode_ledger,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'debet_kredit' => $request->debet_kredit,
                'jumlah' => toNumber($request->jumlah),
                'id_kategori' => $request->id_kategori
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function edit($no_bukti)
    {
        $no_bukti = Crypt::decrypt($no_bukti);
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
        $data['ledgerTransaksi'] = Transaksiledger::where('no_bukti', $no_bukti)->first();
        return view('keuangan.ledger.edit', $data);
    }

    public function update(Request $request, $no_bukti)
    {
        $no_bukti = Crypt::decrypt($no_bukti);
        try {
            //code...
            Transaksiledger::where('no_bukti', $no_bukti)->update([
                'kode_ledger' => $request->kode_ledger,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'debet_kredit' => $request->debet_kredit,
                'jumlah' => toNumber($request->jumlah),
                'id_kategori' => $request->id_kategori
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Di Update'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
