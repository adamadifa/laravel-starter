<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaKegiatan;
use App\Models\Jabatan;
use App\Models\Departemen;
use App\Models\Jobdesk;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class AgendakegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = AgendaKegiatan::query();
        $query->select('agenda_kegiatan.*', 'name');
        $query->join('departemen', 'agenda_kegiatan.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'agenda_kegiatan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('users', 'agenda_kegiatan.id_user', '=', 'users.id');
        // $query->where('agenda_kegiatan.kode_jabatan', $request->kode_jabatan);
        // $query->where('agenda_kegiatan.kode_dept', $request->kode_dept);
        $query->orderBy('tanggal');
        $data['agenda_kegiatan'] = $query->get();

        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();

        return view('agenda_kegiatan.index', $data);
    }


    public function create()
    {
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('agenda_kegiatan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'uraian_kegiatan' => 'required',
        ]);

        try {
            AgendaKegiatan::create([
                'tanggal' => $request->tanggal,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'uraian_kegiatan' => $request->uraian_kegiatan,
                'id_user' => auth()->user()->id
            ]);
            return Redirect::back()->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        try {
            AgendaKegiatan::where('id', $id)->delete();
            return Redirect::back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        $data['agenda_kegiatan'] = AgendaKegiatan::where('id', $id)->first();
        return view('agendakegiatan.edit', $data);
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
            $agenda_kegiatan = AgendaKegiatan::find($id);
            $agenda_kegiatan->update([
                'tanggal' => $request->tanggal,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'kode_jobdesk' => $request->kode_jobdesk,
                'uraian_kegiatan' => $request->uraian_kegiatan,
                'id_user' => auth()->user()->id
            ]);
            return Redirect::back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
