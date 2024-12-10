<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Saldoawalledger;
use App\Models\Transaksiledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SaldoawalledgerController extends Controller
{
    public function index(Request $request)
    {
        $data['list_bulan'] = config('global.list_bulan');
        $data['start_year'] = config('global.start_year');
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();

        $query = Saldoawalledger::query();
        if (!empty($request->bulan)) {
            $query->where('bulan', $request->bulan);
        }
        if (!empty($request->tahun)) {
            $query->where('tahun', $request->tahun);
        } else {
            $query->where('tahun', date('Y'));
        }

        if (!empty($request->kode_ledger_search)) {
            $query->where('ledger_saldoawal.kode_ledger', $request->kode_ledger_search);
        }


        $query->join('ledger', 'ledger_saldoawal.kode_ledger', '=', 'ledger.kode_ledger');
        $query->orderBy('tahun', 'desc');
        $query->orderBy('bulan');
        $query->orderBy('ledger_saldoawal.kode_ledger');
        $data['saldo_awal'] = $query->get();

        return view('keuangan.saldoawalledger.index', $data);
    }

    public function create()
    {
        $data['list_bulan'] = config('global.list_bulan');
        $data['start_year'] = config('global.start_year');
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
        return view('keuangan.saldoawalledger.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'kode_ledger' => 'required',
            'jumlah' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $bulan = $request->bulan < 10 ? "0" . $request->bulan : $request->bulan;
            $kode_saldoawal = "SA" . $bulan . substr($request->tahun, 2, 2) . $request->kode_ledger;
            $tanggal = $request->tahun . "-" . $request->bulan . "-01";
            // $cektutuplaporan = cektutupLaporan($tanggal, "ledger");
            // if ($cektutuplaporan > 0) {
            //     return Redirect::back()->with(messageError('Periode Laporan Sudah Ditutup'));
            // }
            //Cek Jika Saldo Sudah Pernah Diinputkan
            $ceksaldo = Saldoawalledger::where('kode_saldoawal', $kode_saldoawal)->count();

            $bulanlalu = getbulandantahunlalu($request->bulan, $request->tahun, "bulan");
            $tahunlalu = getbulandantahunlalu($request->bulan, $request->tahun, "tahun");
            $ceksaldobulanlalu = Saldoawalledger::where('bulan', $bulanlalu)->where('tahun', $tahunlalu)->where('kode_ledger', $request->kode_ledger)->count();

            $ceksaldoledger = Saldoawalledger::where('kode_ledger', $request->kode_ledger)->count();

            if ($ceksaldobulanlalu === 0 && $ceksaldoledger > 0 && $ceksaldo === 0) {
                return Redirect::back()->with(messageError('Saldo Sebelumnya Belum Di Set'));
            }

            if ($ceksaldo > 0) {
                Saldoawalledger::where('kode_saldoawal', $kode_saldoawal)->update([
                    'tanggal' => $tanggal,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'jumlah' => toNumber($request->jumlah),
                ]);
            } else {
                Saldoawalledger::create([
                    'kode_saldoawal' => $kode_saldoawal,
                    'tanggal' => $tanggal,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'kode_ledger' => $request->kode_ledger,
                    'jumlah' => toNumber($request->jumlah),
                ]);
            }

            DB::commit();

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function getsaldo(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kode_ledger = $request->kode_ledger;

        $bulanlalu = getbulandantahunlalu($bulan, $tahun, "bulan");
        $tahunlalu = getbulandantahunlalu($bulan, $tahun, "tahun");

        $start_date = $tahunlalu . "-" . $bulanlalu . "-01";
        $end_date = date('Y-m-t', strtotime($start_date));
        //Cek Apakah Sudah Ada Saldo Atau Belum
        $ceksaldo = Saldoawalledger::where('kode_ledger', $kode_ledger)->count();
        // Cek Saldo Bulan Lalu
        $ceksaldobulanlalu = Saldoawalledger::where('bulan', $bulanlalu)->where('tahun', $tahunlalu)->where('kode_ledger', $kode_ledger)->count();

        //Cek Saldo Bulan Ini
        $ceksaldobulanini = Saldoawalledger::where('bulan', $bulan)->where('tahun', $tahun)->where('kode_ledger', $kode_ledger)->count();


        $saldobulanlalu = Saldoawalledger::where('bulan', $bulanlalu)->where('tahun', $tahunlalu)->where('kode_ledger', $kode_ledger)->first();

        $mutasi  = Transaksiledger::select(
            DB::raw("SUM(IF(debet_kredit='K',jumlah,0))as kredit"),
            DB::raw("SUM(IF(debet_kredit='D',jumlah,0))as debet"),
        )
            ->whereBetween('tanggal', [$start_date, $end_date])
            ->where('kode_ledger', $kode_ledger)
            ->first();

        $lastsaldo = $saldobulanlalu != null ? $saldobulanlalu->jumlah : 0;
        if ($mutasi != null) {
            $debet = $mutasi->debet;
            $kredit = $mutasi->kredit;
        } else {
            $debet = 0;
            $kredit = 0;
        }
        $saldoawal = $lastsaldo + $kredit - $debet;

        $data = [
            'ceksaldo' => $ceksaldo,
            'ceksaldobulanini' => $ceksaldobulanini,
            'ceksaldobulanlalu' => $ceksaldobulanlalu,
            'saldo' => $saldoawal
        ];
        return response()->json([
            'success' => true,
            'message' => 'Saldo Awal Ledger',
            'data'    => $data
        ]);
    }
}
