<?php

namespace App\Http\Controllers;

use App\Models\Agendakegiatan;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\Karyawananggota;
use App\Models\Ledger;
use App\Models\Presensi;
use App\Models\Realisasikegiatan;
use App\Models\Unit;
use App\Models\User;
use App\Models\Userkaryawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = User::where('id', auth()->user()->id)->first();
        $hari_ini = date("Y-m-d");
        if ($user->hasRole('karyawan')) {
            $userkaryawan = Userkaryawan::where('id_user', auth()->user()->id)->first();
            $data['karyawan'] = Karyawan::where('npp', $userkaryawan->npp)
                ->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan')
                ->join('unit', 'karyawan.kode_unit', '=', 'unit.kode_unit')
                ->first();
            $data['anggota'] = Karyawananggota::where('npp', $userkaryawan->npp)->first();
            $data['presensi'] = Presensi::where('npp', $userkaryawan->npp)->where('tanggal', $hari_ini)->first();
            return view('dashboard.karyawan', $data);
        } else {
            $data['departemen'] = Departemen::orderBy('kode_dept')->get();
            $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
            $hariini = date('Y-m-d');
            $namahari = getnamaHari(date('D', strtotime($hariini)));
            $data['jadwalkerja'] = Karyawan::where('hari_kerja', 'like', '%' . $namahari . '%')->get();
            $data['unit'] = Unit::orderBy('kode_unit')->get();
            return view('dashboard.index', $data);
        }
    }

    public function getrealisasikegiatan(Request $request)
    {
        //Dashboard
        $user = User::where('id', auth()->user()->id)->first();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $kode_dept = $request->kode_dept;
        $query = Realisasikegiatan::query();
        $query->select('realisasi_kegiatan.*', 'name', 'jobdesk', 'nama_dept');
        $query->join('departemen', 'realisasi_kegiatan.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'realisasi_kegiatan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('jobdesk', 'realisasi_kegiatan.kode_jobdesk', '=', 'jobdesk.kode_jobdesk');
        $query->join('users', 'realisasi_kegiatan.id_user', '=', 'users.id');
        if (!empty($kode_dept)) {
            $query->where('realisasi_kegiatan.kode_dept', $kode_dept);
        } else {
            $query->where('realisasi_kegiatan.kode_dept', $user->kode_dept);
        }
        // if ($user->hasRole('super admin')) {
        // } else {
        //     $query->where('realisasi_kegiatan.kode_jabatan', $user->kode_jabatan);
        //     $query->where('realisasi_kegiatan.kode_dept', $user->kode_dept);
        //     $query->where('realisasi_kegiatan.id_user', auth()->user()->id);
        // }
        $query->whereBetween('realisasi_kegiatan.tanggal', [$dari, $sampai]);

        $query->orderBy('tanggal');
        $data['realisasikegiatan'] = $query->get();
        return view('dashboard.getrealisasikegiatan', $data);
    }

    public function getagendakegiatan(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $kode_dept = $request->kode_dept;
        $query = Agendakegiatan::query();
        $query->select('agenda_kegiatan.*', 'name', 'nama_dept');
        $query->join('departemen', 'agenda_kegiatan.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'agenda_kegiatan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('users', 'agenda_kegiatan.id_user', '=', 'users.id');
        if (!empty($kode_dept)) {
            $query->where('agenda_kegiatan.kode_dept', $kode_dept);
        } else {
            // $query->where('agenda_kegiatan.kode_jabatan', $user->kode_jabatan);
            $query->where('agenda_kegiatan.kode_dept', $user->kode_dept);
            // $query->where('agenda_kegiatan.id_user', auth()->user()->id);
        }
        // if ($user->hasRole('super admin')) {

        // } else {
        //     $query->where('agenda_kegiatan.kode_jabatan', $user->kode_jabatan);
        //     $query->where('agenda_kegiatan.kode_dept', $user->kode_dept);
        //     $query->where('agenda_kegiatan.id_user', auth()->user()->id);
        // }
        $query->whereBetween('agenda_kegiatan.tanggal', [$dari, $sampai]);

        $query->orderBy('tanggal');
        $data['agendakegiatan'] = $query->get();
        return view('dashboard.getagendakegiatan', $data);
    }
}
