<?php

namespace App\Http\Controllers;

use App\Models\Agendakegiatan;
use App\Models\Departemen;
use App\Models\Ledger;
use App\Models\Realisasikegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        $data['ledger'] = Ledger::orderBy('kode_ledger')->get();
        return view('dashboard.index', $data);
    }

    public function getrealisasikegiatan(Request $request)
    {
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
        if ($user->hasRole('super admin')) {
            if (!empty($kode_dept)) {
                $query->where('realisasi_kegiatan.kode_dept', $kode_dept);
            }
        } else {
            $query->where('realisasi_kegiatan.kode_jabatan', $user->kode_jabatan);
            $query->where('realisasi_kegiatan.kode_dept', $user->kode_dept);
            $query->where('realisasi_kegiatan.id_user', auth()->user()->id);
        }
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
        if ($user->hasRole('super admin')) {
            if (!empty($kode_dept)) {
                $query->where('agenda_kegiatan.kode_dept', $kode_dept);
            }
        } else {
            $query->where('agenda_kegiatan.kode_jabatan', $user->kode_jabatan);
            $query->where('agenda_kegiatan.kode_dept', $user->kode_dept);
            $query->where('agenda_kegiatan.id_user', auth()->user()->id);
        }
        $query->whereBetween('agenda_kegiatan.tanggal', [$dari, $sampai]);

        $query->orderBy('tanggal');
        $data['agendakegiatan'] = $query->get();
        return view('dashboard.getagendakegiatan', $data);
    }
}
