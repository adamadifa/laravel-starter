<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Biayasiswa;
use App\Models\Detailbiaya;
use App\Models\Detailrencanaspp;
use App\Models\Pendaftaran;
use App\Models\Rencanaspp;
use App\Models\Tahunajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RencanasppController extends Controller
{
    public function create($no_pendaftaran)
    {
        $data['list_bulan'] = config('global.list_bulan');
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $biayaSiswa = Biayasiswa::where('no_pendaftaran', $no_pendaftaran)
            ->join('konfigurasi_biaya', 'siswa_biaya.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
            ->join('konfigurasi_tahun_ajaran', 'konfigurasi_biaya.kode_ta', '=', 'konfigurasi_tahun_ajaran.kode_ta')
            ->get();
        $data['biayaSiswa'] = $biayaSiswa;
        $data['no_pendaftaran'] = $no_pendaftaran;
        return view('rencanaspp.create', $data);
    }


    public function getspp(Request $request)
    {

        $spp = Biayasiswa::where('siswa_biaya.no_pendaftaran', $request->no_pendaftaran)
            ->where('konfigurasi_biaya_detail.kode_biaya', $request->kode_biaya)
            ->where('konfigurasi_biaya_detail.kode_jenis_biaya', 'B07')
            ->select(
                'konfigurasi_biaya_detail.*',
                'pendaftaran_potongan.jumlah as jumlah_potongan',
                'pembayaran_pendidikan_mutasi.jumlah as jumlah_mutasi',
                'jenis_biaya',
                'tahun_ajaran'
            )
            ->join('konfigurasi_biaya', 'konfigurasi_biaya.kode_biaya', '=', 'siswa_biaya.kode_biaya')
            ->join('konfigurasi_biaya_detail', 'konfigurasi_biaya_detail.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
            ->join('jenis_biaya', 'jenis_biaya.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
            ->join('konfigurasi_tahun_ajaran', 'konfigurasi_tahun_ajaran.kode_ta', '=', 'konfigurasi_biaya.kode_ta')
            ->leftJoin('pendaftaran_potongan', function ($join) {
                $join->on('pendaftaran_potongan.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
                    ->on('pendaftaran_potongan.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
                    ->on('pendaftaran_potongan.no_pendaftaran', '=', 'siswa_biaya.no_pendaftaran');
            })
            ->leftJoin('pembayaran_pendidikan_mutasi', function ($join) {
                $join->on('pembayaran_pendidikan_mutasi.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
                    ->on('pembayaran_pendidikan_mutasi.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
                    ->on('pembayaran_pendidikan_mutasi.no_pendaftaran', '=', 'siswa_biaya.no_pendaftaran');
            })
            ->orderBy('konfigurasi_biaya.kode_biaya', 'asc')
            ->orderBy('konfigurasi_biaya_detail.kode_jenis_biaya', 'asc')
            ->first();

        if ($spp) {
            return response()->json([
                'status' => true,
                'jumlah_spp' => formatAngka($spp->jumlah - $spp->jumlah_potongan - $spp->jumlah_mutasi),
                'message' => 'Data SPP'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'jumlah_spp' => 0,
                'message' => 'Data SPP Belum Tersedia'
            ]);
        }
    }

    public function store(Request $request)
    {
        $kode_biaya = $request->kode_biaya;
        $kode_ta = substr($kode_biaya, -4);
        $lastrencanaspp = Rencanaspp::where('kode_biaya', $kode_biaya)->orderBy('kode_rencana_spp', 'desc')->first();
        $last_kode_rencana_spp = $lastrencanaspp ? $lastrencanaspp->kode_rencana_spp : '';
        $kode_rencana_spp = buatkode($last_kode_rencana_spp, 'R' . $kode_biaya, 5);
        $biaya = Biaya::where('kode_biaya', $kode_biaya)->first();
        $ta = Tahunajaran::where('kode_ta', $biaya->kode_ta)->first();
        $tahun_ajaran = $ta->tahun_ajaran;
        $tahun_mulai = substr($tahun_ajaran, 0, 4);
        $mulai_pembayaran = $request->mulai_pembayaran;
        $jumlah_bulan = $request->jumlah_bulan;
        $jumlah_spp_perbulan = toNumber($request->jumlah_spp_perbulan);
        $jumlah_spp  = toNumber($request->jumlah_spp);
        $cicilan_terakhir = $jumlah_spp_perbulan + ($jumlah_spp - ($jumlah_spp_perbulan * $jumlah_bulan));


        //dd($jumlah_spp_perbulan);
        DB::beginTransaction();
        try {
            $cek = Rencanaspp::where('no_pendaftaran', $request->no_pendaftaran)
                ->where('kode_biaya', $kode_biaya)
                ->first();
            if ($cek) {
                // return response()->json(['status' => false, 'message' => 'Data Sudah Ada'], 500);
                Rencanaspp::where('kode_rencana_spp', $cek->kode_rencana_spp)->delete();
            }
            Rencanaspp::create([
                'kode_rencana_spp' => $kode_rencana_spp,
                'no_pendaftaran' => $request->no_pendaftaran,
                'kode_biaya' => $kode_biaya,
            ]);


            for ($i = 1; $i <= $jumlah_bulan; $i++) {

                $tahun = $tahun_mulai;
                if ($mulai_pembayaran > 12) {
                    $bulancicilan = $mulai_pembayaran - 12;
                    $tahun = $tahun_mulai + 1;
                } else {
                    $bulancicilan = $mulai_pembayaran;
                }

                if ($i == $jumlah_bulan) {
                    $cicilan = $cicilan_terakhir;
                } else {
                    $cicilan = $jumlah_spp_perbulan;
                }

                $detail[] = [
                    'kode_rencana_spp' => $kode_rencana_spp,
                    'bulan' => $bulancicilan,
                    'tahun' => $tahun,
                    'jumlah' => $cicilan
                ];
                $mulai_pembayaran++;
            }


            // dd($detail);
            Detailrencanaspp::insert($detail);
            DB::commit();

            return response()->json(['status' => true, 'message' => 'Data Berhasil Di Generate', 'no_pendaftaran' => Crypt::encrypt($request->no_pendaftaran)], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function getrencanaspp($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $detailrencanaspp = Detailrencanaspp::join('spp_rencana', 'spp_rencana_detail.kode_rencana_spp', '=', 'spp_rencana.kode_rencana_spp')
            ->join('konfigurasi_biaya', 'spp_rencana.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
            ->join('konfigurasi_tahun_ajaran', 'konfigurasi_biaya.kode_ta', '=', 'konfigurasi_tahun_ajaran.kode_ta')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->orderBy('konfigurasi_biaya.kode_ta')
            ->orderBy('spp_rencana_detail.tahun')
            ->orderBy('spp_rencana_detail.bulan')
            ->get();
        return view('rencanaspp.getrencanaspp', compact('detailrencanaspp'));
    }


    public function edit($kode_rencana_spp)
    {
        $kode_rencana_spp = Crypt::decrypt($kode_rencana_spp);
        $rencana_spp = Rencanaspp::where('kode_rencana_spp', $kode_rencana_spp)->first();
        $biaya = Biayasiswa::where('siswa_biaya.no_pendaftaran', $rencana_spp->no_pendaftaran)
            ->where('konfigurasi_biaya_detail.kode_biaya', $rencana_spp->kode_biaya)
            ->where('konfigurasi_biaya_detail.kode_jenis_biaya', 'B07')
            ->select(
                'konfigurasi_biaya_detail.*',
                'pendaftaran_potongan.jumlah as jumlah_potongan',
                'pembayaran_pendidikan_mutasi.jumlah as jumlah_mutasi',
                'jenis_biaya',
                'tahun_ajaran'
            )
            ->join('konfigurasi_biaya', 'konfigurasi_biaya.kode_biaya', '=', 'siswa_biaya.kode_biaya')
            ->join('konfigurasi_biaya_detail', 'konfigurasi_biaya_detail.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
            ->join('jenis_biaya', 'jenis_biaya.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
            ->join('konfigurasi_tahun_ajaran', 'konfigurasi_tahun_ajaran.kode_ta', '=', 'konfigurasi_biaya.kode_ta')
            ->leftJoin('pendaftaran_potongan', function ($join) {
                $join->on('pendaftaran_potongan.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
                    ->on('pendaftaran_potongan.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
                    ->on('pendaftaran_potongan.no_pendaftaran', '=', 'siswa_biaya.no_pendaftaran');
            })
            ->leftJoin('pembayaran_pendidikan_mutasi', function ($join) {
                $join->on('pembayaran_pendidikan_mutasi.kode_biaya', '=', 'konfigurasi_biaya.kode_biaya')
                    ->on('pembayaran_pendidikan_mutasi.kode_jenis_biaya', '=', 'konfigurasi_biaya_detail.kode_jenis_biaya')
                    ->on('pembayaran_pendidikan_mutasi.no_pendaftaran', '=', 'siswa_biaya.no_pendaftaran');
            })
            ->orderBy('konfigurasi_biaya.kode_biaya', 'asc')
            ->orderBy('konfigurasi_biaya_detail.kode_jenis_biaya', 'asc')
            ->first();
        $data['biaya'] = $biaya;
        $data['detailrencanaspp'] = Detailrencanaspp::join('spp_rencana', 'spp_rencana_detail.kode_rencana_spp', '=', 'spp_rencana.kode_rencana_spp')
            ->where('spp_rencana_detail.kode_rencana_spp', $kode_rencana_spp)->get();
        $data['rencana_spp'] = $rencana_spp;
        return view('rencanaspp.edit', $data);
    }


    public function update(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $jumlah = $request->jumlah;
        $rencana_spp = Rencanaspp::where('kode_rencana_spp', $request->kode_rencana_spp)->first();
        DB::beginTransaction();
        try {
            //Hapus Data Sebelumnya
            Detailrencanaspp::where('kode_rencana_spp', $request->kode_rencana_spp)->delete();
            //Insert Data Baru
            for ($i = 0; $i < count($request->bulan); $i++) {
                $detail[] = [
                    'kode_rencana_spp' => $request->kode_rencana_spp,
                    'bulan' => $bulan[$i],
                    'tahun' => $tahun[$i],
                    'jumlah' => toNumber($jumlah[$i]),
                ];
            }
            Detailrencanaspp::insert($detail);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate',
                'no_pendaftaran' => Crypt::encrypt($rencana_spp->no_pendaftaran)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Data gagal diupdate ' . $e->getMessage(),
                'no_pendaftaran' => $rencana_spp->no_pendaftaran
            ], 500);
        }
    }
}
