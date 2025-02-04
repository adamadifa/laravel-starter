<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if (auth()->user()->kode_unit != 'U06') {
            $query->where('karyawan.kode_unit', auth()->user()->kode_unit);
        }
        $query->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->join('unit', 'karyawan.kode_unit', '=', 'unit.kode_unit');
        $query->orderBy('karyawan.created_at', 'desc');
        $karyawan = $query->paginate(15);
        $karyawan->appends(request()->all());
        return view('datamaster.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $jabatan = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $unit = Unit::orderBy('kode_unit')->get();
        return view('datamaster.karyawan.create', compact('jabatan', 'unit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npp' => 'required|unique:karyawan,npp',
            'no_ktp' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|numeric',
            'alamat_ktp' => 'required',
            'alamat_tinggal' => 'required',
            'tmt' => 'required',
            'status_karyawan' => 'required',
            'pendidikan_terakhir' => 'required',
            'kode_jabatan' => 'required',
            'kode_unit' => 'required',
        ]);


        try {
            Karyawan::create([
                'npp' => $request->npp,
                'no_kk' => $request->no_kk,
                'no_ktp' => $request->no_ktp,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_hp' => $request->no_hp,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_tinggal' => $request->alamat_tinggal,
                'tmt' => $request->tmt,
                'status_karyawan' => $request->status_karyawan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_unit' => $request->kode_unit,
                'password' => bcrypt('12345678')
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function edit($npp)
    {
        $npp = Crypt::decrypt($npp);
        $karyawan = Karyawan::where('npp', $npp)->first();
        $jabatan = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $unit = Unit::orderBy('kode_unit')->get();
        return view('datamaster.karyawan.edit', compact('karyawan', 'jabatan', 'unit'));
    }

    public function update(Request $request, $npp)
    {
        $npp = Crypt::decrypt($npp);
        $request->validate([
            'npp' => 'required|unique:karyawan,npp,' . $npp . ',npp',
            'no_ktp' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|numeric',
            'alamat_ktp' => 'required',
            'alamat_tinggal' => 'required',
            'tmt' => 'required',
            'status_karyawan' => 'required',
            'pendidikan_terakhir' => 'required',
            'kode_jabatan' => 'required',
            'kode_unit' => 'required',
        ]);


        try {
            Karyawan::where('npp', $npp)->update([
                'npp' => $request->npp,
                'no_kk' => $request->no_kk,
                'no_ktp' => $request->no_ktp,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_hp' => $request->no_hp,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_tinggal' => $request->alamat_tinggal,
                'tmt' => $request->tmt,
                'status_karyawan' => $request->status_karyawan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_unit' => $request->kode_unit,
                'password' => bcrypt('12345678')
            ]);

            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function show($npp)
    {
        $npp = Crypt::decrypt($npp);
        $karyawan = Karyawan::where('npp', $npp)
            ->join('unit', 'karyawan.kode_unit', '=', 'unit.kode_unit')
            ->join('jabatan', 'karyawan.kode_jabatan', '=', 'jabatan.kode_jabatan')
            ->first();
        return view('datamaster.karyawan.show', compact('karyawan'));
    }


    public function destroy($npp)
    {
        $npp = Crypt::decrypt($npp);
        try {
            Karyawan::where('npp', $npp)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function setharikerja($npp)
    {
        $npp = Crypt::decrypt($npp);
        $karyawan = Karyawan::where('npp', $npp)->first();
        $data['karyawan'] = $karyawan;
        return view('datamaster.karyawan.setharikerja', $data);
    }


    public function updateharikerja(Request $request, $npp)
    {
        $npp = Crypt::decrypt($npp);
        try {
            Karyawan::where('npp', $npp)->update([
                'hari_kerja' => implode(",", $request->hari),
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
