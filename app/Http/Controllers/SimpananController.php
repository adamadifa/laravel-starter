<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jenissimpanan;
use App\Models\Saldosimpanan;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SimpananController extends Controller
{
    public function index(Request $request)
    {

        $subquerySaldosimpanan = Saldosimpanan::select('no_anggota', DB::raw('SUM(jumlah) as jml_saldo'))
            ->groupBy('no_anggota');
        $query = Anggota::query();
        $query->select('koperasi_anggota.*', 'jml_saldo');
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', "%" . $request->nama_lengkap . "%");
        }
        $query->leftJoinSub($subquerySaldosimpanan, 'saldosimpanan', 'koperasi_anggota.no_anggota', '=', 'saldosimpanan.no_anggota');
        $anggota = $query->paginate(10);
        $anggota->appends($request->all());
        $data['anggota'] = $anggota;
        return view('koperasi.simpanan.index', $data);
    }


    public function show($no_anggota, Request $request)
    {
        $no_anggota = Crypt::decrypt($no_anggota);
        $data['anggota'] = Anggota::where('no_anggota', $no_anggota)
            ->leftJoin('provinces', 'koperasi_anggota.id_province', '=', 'provinces.id')
            ->leftJoin('regencies', 'koperasi_anggota.id_regency', '=', 'regencies.id')
            ->leftJoin('districts', 'koperasi_anggota.id_district', '=', 'districts.id')
            ->leftJoin('villages', 'koperasi_anggota.id_village', '=', 'villages.id')
            ->select('koperasi_anggota.*', 'provinces.name as province_name', 'regencies.name as regency_name', 'districts.name as district_name', 'villages.name as village_name')
            ->first();
        $data['saldo_simpanan'] = Saldosimpanan::where('no_anggota', $no_anggota)
            ->join('koperasi_jenis_simpanan', 'koperasi_saldo_simpanan.kode_simpanan', '=', 'koperasi_jenis_simpanan.kode_simpanan')
            ->get();

        $dari = date('Y-m-d', strtotime('-30 days'));
        $sampai = date('Y-m-d');
        if (isset($request->dari) and isset($request->sampai)) {
            $lastdata = Simpanan::where('no_anggota', $no_anggota)
                ->where('tanggal', '<', $request->dari)
                ->orderBy('no_transaksi', 'desc')
                ->first();
        } else {
            $lastdata = Simpanan::where('no_anggota', $no_anggota)
                ->where('tanggal', '<', $dari)
                ->orderBy('no_transaksi', 'desc')
                ->first();
        }
        $data['saldo_awal'] = $lastdata ? $lastdata->saldo : 0;
        $query = Simpanan::query();

        $query->select('koperasi_simpanan.*', 'jenis_simpanan', 'name');
        $query->join('koperasi_jenis_simpanan', 'koperasi_simpanan.kode_simpanan', '=', 'koperasi_jenis_simpanan.kode_simpanan');
        $query->leftJoin('users', 'koperasi_simpanan.id_petugas', '=', 'users.id');
        $query->where('no_anggota', $no_anggota);
        $query->orderBy('created_at', 'asc')->get();
        if (isset($request->dari) and isset($request->sampai)) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        } else {
            $query->whereBetween('tanggal', [$dari, $sampai]);
        }
        $simpanan = $query->get();

        $data['lasttransaksi'] = Simpanan::where('no_anggota', $no_anggota)->orderBy('created_at', 'desc')->first();
        $data['simpanan'] = $simpanan;
        return view('koperasi.simpanan.show', $data);
    }


    public function create($no_anggota, $jenis_transaksi)
    {
        $data['no_anggota'] = Crypt::decrypt($no_anggota);
        $data['jenis_transaksi'] = $jenis_transaksi;
        $data['jenis_simpanan'] = Jenissimpanan::orderBy('kode_simpanan', 'asc')->get();
        return view('koperasi.simpanan.create', $data);
    }

    public function store($no_anggota, $jenis_transaksi, Request $request)
    {

        $request->validate([
            'tanggal' => 'required',
            'kode_simpanan' => 'required',
            'jumlah' => 'required',
            'berita' => 'required',
        ]);

        $no_anggota = Crypt::decrypt($no_anggota);
        $tanggal = $request->tanggal;
        $tgl = explode("-", $tanggal);
        $tahun = $tgl[0];
        $bulan = $tgl[1];
        if (strlen($bulan) > 1) {
            $bulan = $bulan;
        } else {
            $bulan = "0" . $bulan;
        }
        $format = "TS" . substr($tahun, 2, 2) . $bulan;


        //Cek Simpanan Terakhir
        $lastsimpanan = Simpanan::select('no_transaksi')
            ->where(DB::raw('left(no_transaksi,6)'), $format)
            ->orderBy('no_transaksi', 'desc')
            ->first();


        //Cek  No. Transaksi Terakir
        $last_no_transaksi = $lastsimpanan ? $lastsimpanan->no_transaksi : '';

        //Buat Kode Otomatsi No. Transaksi
        $no_transaksi = buatkode($last_no_transaksi, $format . "-", 4);

        //Cek Saldo Simpanan
        $ceksaldo = Saldosimpanan::where('no_anggota', $no_anggota)->where('kode_simpanan', $request->kode_simpanan)->count();
        $jumlah = toNumber($request->jumlah);
        $operator = $jenis_transaksi == "S" ? "+" : "-";

        DB::beginTransaction();
        try {

            Simpanan::create([
                'no_transaksi' => $no_transaksi,
                'tanggal' => $tanggal,
                'no_anggota' => $no_anggota,
                'kode_simpanan' => $request->kode_simpanan,
                'jumlah' => $jumlah,
                'jenis_transaksi' => $jenis_transaksi,
                'berita' => $request->berita,
                'saldo' => 0,
                'id_petugas' => auth()->user()->id
            ]);

            if ($ceksaldo == 0) {
                Saldosimpanan::create([
                    'no_anggota' => $no_anggota,
                    'kode_simpanan' => $request->kode_simpanan,
                    'jumlah' => $jumlah
                ]);
            } else {
                Saldosimpanan::where('no_anggota', $no_anggota)
                    ->where('kode_simpanan', $request->kode_simpanan)
                    ->update([
                        'jumlah' => DB::raw('jumlah' . $operator . $jumlah)
                    ]);
            }

            //Cek Saldo Terakhir
            $ceksaldoterakhir = Saldosimpanan::select(DB::raw('SUM(jumlah) as jumlah'))
                ->where('no_anggota', $no_anggota)
                ->groupBy('no_anggota')
                ->first();

            //Update Saldo Transaksi
            Simpanan::where('no_transaksi', $no_transaksi)
                ->update([
                    'saldo' => $ceksaldoterakhir->jumlah
                ]);

            DB::commit();
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function destroy($no_transaksi)
    {

        $no_transaksi = Crypt::decrypt($no_transaksi);

        $cekanggota = Simpanan::where('no_transaksi', $no_transaksi)->first();
        $no_anggota = $cekanggota->no_anggota;
        $kode_simpanan = $cekanggota->kode_simpanan;
        $jenis_transaksi = $cekanggota->jenis_transaksi;
        $jumlah = $cekanggota->jumlah;
        $operator = $jenis_transaksi == "S" ? "-" : "+";

        DB::beginTransaction();
        try {

            Simpanan::where('no_transaksi', $no_transaksi)->delete();
            Saldosimpanan::where('no_anggota', $no_anggota)
                ->where('kode_simpanan', $kode_simpanan)
                ->update([
                    'jumlah' => DB::raw('jumlah' . $operator . $jumlah)
                ]);
            DB::commit();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
