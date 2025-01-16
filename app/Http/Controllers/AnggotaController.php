<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();
        $query->select('*');
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', "%" . $request->nama_lengkap . "%");
        }
        $anggota = $query->paginate(10);
        $anggota->appends($request->all());
        $data['anggota'] = $anggota;
        return view('koperasi.anggota.index', $data);
    }

    public function create()
    {
        $data['provinsi'] = Province::orderBy('name')->get();
        $data['pendidikan'] = config('global.list_pendidikan ');
        return view('koperasi.anggota.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:koperasi_anggota,nik',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan_terakhir' => 'required',
            'status_pernikahan' => 'required',
            'id_province' => 'required',
            'id_regency' => 'required',
            'id_district' => 'required',
            'id_village' => 'required',
            'status_tinggal' => 'required',
            'no_hp' => 'required|unique:koperasi_anggota,no_hp'
        ]);

        $tahun = date("Y");
        $bulan = date("m");
        if (strlen($bulan) > 1) {
            $bulan = $bulan;
        } else {
            $bulan = "0" . $bulan;
        }
        $format = substr($tahun, 2, 2) . $bulan;

        //Cek Pendaftaran Terakhir
        $lastAnggota = Anggota::select('no_anggota')
            ->whereRaw('left(no_anggota,4) = "' . $format . '"')
            ->orderBy('no_anggota', 'desc')
            ->first();


        $last_no_anggota = $lastAnggota != null ? $lastAnggota->no_anggota : '';


        $no_anggota = buatkode($last_no_anggota, $format . "-", 5);

        try {
            Anggota::create([
                'no_anggota' => $no_anggota,
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'status_pernikahan' => $request->status_pernikahan,
                'jml_tanggungan' => $request->jml_tanggungan,
                'nama_pasangan' => $request->nama_pasangan,
                'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
                'nama_ibu' => $request->nama_ibu,
                'nama_saudara' => $request->nama_saudara,
                'alamat' => $request->alamat,
                'id_province' => $request->id_province,
                'id_regency' => $request->id_regency,
                'id_district' => $request->id_district,
                'id_village' => $request->id_village,
                'kode_pos' => $request->kode_pos,
                'status_tinggal' => $request->status_tinggal,
                'no_hp' => $request->no_hp
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($no_anggota)
    {
        $no_anggota = Crypt::decrypt($no_anggota);
        $data['anggota'] = Anggota::where('no_anggota', $no_anggota)->first();
        $data['provinsi'] = Province::orderBy('name')->get();
        $data['pendidikan'] = config('global.list_pendidikan ');
        return view('koperasi.anggota.edit', $data);
    }


    public function update(Request $request, $no_anggota)
    {
        $no_anggota = Crypt::decrypt($no_anggota);
        $request->validate([
            'nik' => 'required|unique:koperasi_anggota,nik,' . $no_anggota . ',no_anggota',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan_terakhir' => 'required',
            'status_pernikahan' => 'required',
            'id_province' => 'required',
            'id_regency' => 'required',
            'id_district' => 'required',
            'id_village' => 'required',
            'status_tinggal' => 'required',
            'no_hp' => 'required'
        ]);



        try {
            Anggota::where('no_anggota', $no_anggota)->update([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'status_pernikahan' => $request->status_pernikahan,
                'jml_tanggungan' => $request->jml_tanggungan,
                'nama_pasangan' => $request->nama_pasangan,
                'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
                'nama_ibu' => $request->nama_ibu,
                'nama_saudara' => $request->nama_saudara,
                'alamat' => $request->alamat,
                'id_province' => $request->id_province,
                'id_regency' => $request->id_regency,
                'id_district' => $request->id_district,
                'id_village' => $request->id_village,
                'kode_pos' => $request->kode_pos,
                'status_tinggal' => $request->status_tinggal,
                'no_hp' => $request->no_hp
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Di Update'));
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }
}
