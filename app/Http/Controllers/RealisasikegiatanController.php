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
        $query->select('realisasi_kegiatan.*', 'name', 'jobdesk');
        $query->join('departemen', 'realisasi_kegiatan.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'realisasi_kegiatan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('jobdesk', 'realisasi_kegiatan.kode_jobdesk', '=', 'jobdesk.kode_jobdesk');
        $query->join('users', 'realisasi_kegiatan.id_user', '=', 'users.id');
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

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        try {
            Realisasikegiatan::where('id', $id)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        $data['realisasikegiatan'] = Realisasikegiatan::where('id', $id)->first();
        return view('realisasi_kegiatan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'tanggal' => 'required',
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'kode_jobdesk' => 'required',
            'uraian_kegiatan' => 'required',
            'file' => 'mimes:jpg,jpeg,png|max:1024',
        ]);

        try {
            $realisasikegiatan = Realisasikegiatan::find($id);
            $realisasikegiatan->update([
                'tanggal' => $request->tanggal,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'kode_jobdesk' => $request->kode_jobdesk,
                'uraian_kegiatan' => $request->uraian_kegiatan,
                'id_user' => auth()->user()->id
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diupdate'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
