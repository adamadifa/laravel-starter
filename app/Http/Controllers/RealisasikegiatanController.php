<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Realisasikegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class RealisasikegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Realisasikegiatan::query();
        $query->join('departemen', 'realisasi_kegiatan.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'realisasi_kegiatan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('jobdesk', 'realisasi_kegiatan.kode_jobdesk', '=', 'jobdesk.kode_jobdesk');
        // $query->where('realisasi_kegiatan.kode_jabatan', $request->kode_jabatan);
        // $query->where('realisasi_kegiatan.kode_dept', $request->kode_dept);
        $query->orderBy('tanggal');
        $data['realisasikegiatan'] = $query->get();

        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();

        return view('realisasi_kegiatan.index', $data);
    }


    public function create()
    {
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('realisasi_kegiatan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'kode_jobdesk' => 'required',
            'uraian_kegiatan' => 'required',
            'file' => 'mimes:jpg,jpeg,png|max:1024',
        ]);

        try {
            Realisasikegiatan::create([
                'tanggal' => $request->tanggal,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'kode_jobdesk' => $request->kode_jobdesk,
                'uraian_kegiatan' => $request->uraian_kegiatan,
                'id_user' => auth()->user()->id
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_realisasikegiatan)
    {
        $kode_realisasikegiatan = Crypt::decrypt($kode_realisasikegiatan);
        try {
            Realisasikegiatan::where('kode_realisasikegiatan', $kode_realisasikegiatan)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_realisasikegiatan)
    {
        $kode_realisasikegiatan = Crypt::decrypt($kode_realisasikegiatan);
        $data['realisasikegiatan'] = Realisasikegiatan::where('kode_realisasikegiatan', $kode_realisasikegiatan)->first();
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('datamaster.realisasi_kegiatan.edit', $data);
    }

    public function update(Request $request, $kode_realisasikegiatan)
    {
        $request->validate([
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'realisasikegiatan' => 'required',
        ]);
        $kode_realisasikegiatan = Crypt::decrypt($kode_realisasikegiatan);
        try {
            Realisasikegiatan::where('kode_realisasikegiatan', $kode_realisasikegiatan)->update([
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'realisasikegiatan' => $request->realisasikegiatan
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
