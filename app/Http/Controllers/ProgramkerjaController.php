<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Programkerja;
use App\Models\Tahunajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class ProgramkerjaController extends Controller
{
    public function index(Request $request)
    {
        $ta_aktif = Tahunajaran::where('status', 1)->first();
        $query = Programkerja::query();
        $query->select('program_kerja.*', 'name');
        $query->join('departemen', 'program_kerja.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'program_kerja.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('users', 'program_kerja.id_user', '=', 'users.id');
        // $query->where('program_kerja.kode_jabatan', $request->kode_jabatan);
        // $query->where('program_kerja.kode_dept', $request->kode_dept);
        if (!empty($request->kode_ta)) {
            $query->where('program_kerja.kode_ta', $request->kode_ta);
        } else {
            $query->where('program_kerja.kode_ta', $ta_aktif->kode_ta);
        }
        $query->orderBy('tanggal_pelaksanaan');
        $data['programkerja'] = $query->get();
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        $data['tahunajaran'] = Tahunajaran::all();
        return view('programkerja.index', $data);
    }

    public function create()
    {
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('programkerja.create', $data);
    }

    public function store(Request $request)
    {

        $user = User::where('id', auth()->user()->id)->first();
        if ($user->hasRole('super admin')) {
            $request->validate([

                'program_kerja' => 'required',
                'target_pencapaian' => 'required',
                'tanggal_pelaksanaan' => 'required',
                'keterangan' => 'required',
                'kode_jabatan' => 'required',
                'kode_dept' => 'required',
            ]);

            $kode_jabatan = $request->kode_jabatan;
            $kode_dept = $request->kode_dept;
        } else {
            $request->validate([

                'program_kerja' => 'required',
                'target_pencapaian' => 'required',
                'tanggal_pelaksanaan' => 'required',
                'keterangan' => 'required',
            ]);
            $kode_jabatan = $user->kode_jabatan;
            $kode_dept = $user->kode_dept;
        }


        $ta_aktif = Tahunajaran::where('status', '1')->first();
        $ta = explode("/", $ta_aktif->tahun_ajaran);
        $format = substr($ta[0], 2, 2) . substr($ta[1], 2, 2) . $kode_dept;
        try {
            $lastprogramkerja = Programkerja::where('kode_dept', $kode_dept)
                ->where('kode_ta', $ta_aktif->kode_ta)
                ->orderBy('kode_program_kerja')
                ->first();
            $last_kode_program_kerja = $lastprogramkerja !== null ? $lastprogramkerja->kode_program_kerja : '';
            $kode_program_kerja = buatkode($last_kode_program_kerja, $format, 4);
            Programkerja::create([
                'kode_program_kerja' => $kode_program_kerja,
                'program_kerja' => $request->program_kerja,
                'target_pencapaian' => $request->target_pencapaian,
                'keterangan' => $request->keterangan,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'kode_dept' => $kode_dept,
                'kode_jabatan' => $kode_jabatan,
                'kode_ta' => $ta_aktif->kode_ta,
                'id_user' => auth()->user()->id
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function edit($kode_program_kerja)
    {
        $kode_program_kerja = Crypt::decrypt($kode_program_kerja);
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        $data['programkerja'] = Programkerja::where('kode_program_kerja', $kode_program_kerja)->first();
        return view('programkerja.edit', $data);
    }


    public function update(Request $request, $kode_jam_kerja)
    {
        $kode_jam_kerja = Crypt::decrypt($kode_jam_kerja);
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->hasRole('super admin')) {
            $request->validate([

                'program_kerja' => 'required',
                'target_pencapaian' => 'required',
                'tanggal_pelaksanaan' => 'required',
                'keterangan' => 'required',
                'kode_jabatan' => 'required',
                'kode_dept' => 'required',
            ]);

            $kode_jabatan = $request->kode_jabatan;
            $kode_dept = $request->kode_dept;
        } else {
            $request->validate([

                'program_kerja' => 'required',
                'target_pencapaian' => 'required',
                'tanggal_pelaksanaan' => 'required',
                'keterangan' => 'required',
            ]);
            $kode_jabatan = $user->kode_jabatan;
            $kode_dept = $user->kode_dept;
        }



        try {

            Programkerja::where('kode_program_kerja', $kode_jam_kerja)->update([
                'program_kerja' => $request->program_kerja,
                'target_pencapaian' => $request->target_pencapaian,
                'keterangan' => $request->keterangan,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'kode_dept' => $kode_dept,
                'kode_jabatan' => $kode_jabatan,
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_program_kerja)
    {
        $kode_program_kerja = Crypt::decrypt($kode_program_kerja);
        try {
            Programkerja::where('kode_program_kerja', $kode_program_kerja)->delete();
            return Redirect::back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
