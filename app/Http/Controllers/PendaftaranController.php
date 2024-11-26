<?php

namespace App\Http\Controllers;

use App\Models\Asalsekolah;
use App\Models\Biaya;
use App\Models\Biayasiswa;
use App\Models\Dokumenpersyaratan;
use App\Models\Jenisdokumenpendaftaran;
use App\Models\Pendaftaran;
use App\Models\Penghasilanortu;
use App\Models\Province;
use App\Models\Siswa;
use App\Models\Tahunajaran;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $siswa = Siswa::select('*');
            return DataTables::of($siswa)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm pilihsiswa" id_siswa="' . Crypt::encrypt($row->id_siswa) . '">Pilih</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        $data['tahun_ajaran'] = Tahunajaran::where('status', 1)->first();

        $p = new Pendaftaran();
        $pendaftaran = $p->getPendaftaran(request: $request)->paginate(15);
        $pendaftaran->appends($request->all());
        $data['pendaftaran'] = $pendaftaran;

        $data['unit'] = Unit::orderBy('kode_unit')->get();
        $data['jenis_kelamin'] = config('global.jenis_kelamin');
        $data['tahunajaran'] = Tahunajaran::orderBy('kode_ta')->get();

        return view('pendaftaran.index', $data);
    }

    public function create(Request $request)
    {


        $data['provinsi'] = Province::orderBy('name')->get();
        $data['pendidikan'] = config('global.list_pendidikan ');
        $data['unit'] = Unit::orderBy('kode_unit')->get();
        $data['penghasilan_ortu'] = Penghasilanortu::orderBy('kode_penghasilan_ortu')->get();
        return view('pendaftaran.create', $data);
    }


    public function getsiswa(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pendaftaran.getsiswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pendaftaran' => 'required',
            'kode_unit' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke' => 'required',
            'alamat' => 'required',
            'id_province' => 'required',
            'id_regency' => 'required',
            'id_district' => 'required',
            'id_village' => 'required',
            'kode_pos' => 'required',
            'no_kk' => 'required',
            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_orang_tua' => 'required',
            'kode_asal_sekolah' => 'required'
        ]);

        $tahun_ajaran = Tahunajaran::where('status', 1)->first();
        $ta_nis = substr($tahun_ajaran->tahun_ajaran, 2, 2) . substr($tahun_ajaran->tahun_ajaran, 7, 2);
        $ta_pendaftaran = substr($tahun_ajaran->tahun_ajaran, 2, 2);
        $lastpendaftaran = Pendaftaran::select('no_pendaftaran', 'nis')
            ->where('kode_ta', $tahun_ajaran->kode_ta)
            ->where('kode_unit', $request->kode_unit)
            ->orderBy('no_pendaftaran', 'desc')
            ->first();
        $last_no_pendaftaran = $lastpendaftaran != null ? $lastpendaftaran->no_pendaftaran : '';
        $last_nis = $lastpendaftaran != null ? $lastpendaftaran->nis : '';
        $format = "REG" . $request->kode_unit . $ta_pendaftaran;
        $format_nis = $ta_nis;
        $no_pendaftaran = buatkode($last_no_pendaftaran, $format, 3);
        $nis = buatkode($last_nis, $format_nis, 3);

        $biaya = Biaya::where('kode_unit', $request->kode_unit)
            ->where('kode_ta', $tahun_ajaran->kode_ta)
            ->where('tingkat', 1)
            ->first();

        if ($biaya == null) {
            return Redirect::back()->with(messageError('Biaya Belum ditetapkan'));
        }
        DB::beginTransaction();
        try {
            //Simpan Data Siswa
            if (empty($request->id_siswa)) {
                $tahun_masuk = config('global.tahun_ppdb');
                $last_siswa = Siswa::orderby('id_siswa', 'desc')->where('tahun_masuk', $tahun_masuk)->first();
                $last_id_siswa = $last_siswa != NULL ? $last_siswa->id_siswa : "";
                $id_siswa = buatkode($last_id_siswa, $tahun_masuk, 3);
                Siswa::create([
                    'id_siswa' => $id_siswa,
                    'nisn' => $request->nisn,
                    'nama_lengkap' => $request->nama_lengkap,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'anak_ke' => $request->anak_ke,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    'alamat' => $request->alamat,
                    'id_province' => $request->id_province,
                    'id_regency' => $request->id_regency,
                    'id_district' => $request->id_district,
                    'id_village' => $request->id_village,
                    'kode_pos' => $request->kode_pos,
                    'no_kk' => $request->no_kk,
                    'nik_ayah' => $request->nik_ayah,
                    'nama_ayah' => $request->nama_ayah,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'nik_ibu' => $request->nik_ibu,
                    'nama_ibu' => $request->nama_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'no_hp_orang_tua' => $request->no_hp_orang_tua,
                    'tahun_masuk' => $tahun_masuk,
                ]);
            } else {
                $id_siswa = $request->id_siswa;
            }

            //Simpan Data Pendaftaran
            Pendaftaran::create([
                'no_pendaftaran' => $no_pendaftaran,
                'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
                'nis' => $nis,
                'id_siswa' => $id_siswa,
                'kode_asal_sekolah' => $request->kode_asal_sekolah,
                'kode_penghasilan_ortu' => $request->kode_penghasilan_ortu,
                'kode_unit' => $request->kode_unit,
                'kode_ta' => $tahun_ajaran->kode_ta,
                'id_user' => Auth::user()->id,
            ]);

            //Simpan Data Biaya
            Biayasiswa::create([
                'no_pendaftaran' => $no_pendaftaran,
                'kode_biaya' => $biaya->kode_biaya,
            ]);
            DB::commit();
            return Redirect::back()->with(messageSuccess('Data Berhasil Di Simpan'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function edit($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $data['provinsi'] = Province::orderBy('name')->get();
        $data['pendidikan'] = config('global.list_pendidikan ');
        $data['unit'] = Unit::orderBy('kode_unit')->get();
        $data['penghasilan_ortu'] = Penghasilanortu::orderBy('kode_penghasilan_ortu')->get();
        $data['pendaftaran'] = Pendaftaran::where('no_pendaftaran', $no_pendaftaran)
            ->join('siswa', 'pendaftaran.id_siswa', 'siswa.id_siswa')
            ->first();
        return view('pendaftaran.edit', $data);
    }



    public function update($no_pendaftaran, Request $request)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $request->validate([
            'tanggal_pendaftaran' => 'required',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke' => 'required',
            'alamat' => 'required',
            'id_province' => 'required',
            'id_regency' => 'required',
            'id_district' => 'required',
            'id_village' => 'required',
            'kode_pos' => 'required',
            'no_kk' => 'required',
            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_orang_tua' => 'required',
            'kode_asal_sekolah' => 'required'
        ]);


        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::where('no_pendaftaran', $no_pendaftaran)->first();
            //Simpan Data Siswa
            Siswa::where('id_siswa', $pendaftaran->id_siswa)->update([
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'alamat' => $request->alamat,
                'id_province' => $request->id_province,
                'id_regency' => $request->id_regency,
                'id_district' => $request->id_district,
                'id_village' => $request->id_village,
                'kode_pos' => $request->kode_pos,
                'no_kk' => $request->no_kk,
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nik_ibu' => $request->nik_ibu,
                'nama_ibu' => $request->nama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_orang_tua' => $request->no_hp_orang_tua,
            ]);

            //Simpan Data Pendaftaran
            Pendaftaran::where('no_pendaftaran', $no_pendaftaran)->update([
                'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
                'kode_asal_sekolah' => $request->kode_asal_sekolah,
                'kode_penghasilan_ortu' => $request->kode_penghasilan_ortu,
                'kode_unit' => $request->kode_unit,
            ]);
            DB::commit();
            return Redirect::back()->with(messageSuccess('Data Berhasil Di Simpan'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $dokumen = Dokumenpersyaratan::where('no_pendaftaran', $no_pendaftaran)->get();
        DB::beginTransaction();
        try {
            $pendaftaran  = Pendaftaran::where('no_pendaftaran', $no_pendaftaran)->first();
            $pendaftaran->delete();
            $cekpendaftaransiswa = Pendaftaran::where('id_siswa', $pendaftaran->id_siswa)->count();
            if ($cekpendaftaransiswa == 0) {
                Siswa::where('id_siswa', $pendaftaran->id_siswa)->delete();
            }

            foreach ($dokumen as $d) {
                Storage::delete('/public/pendaftaran/persyaratan/' . $d->nama_file);
                echo $d->nama_file . "<br>";
            }


            Dokumenpersyaratan::where('no_pendaftaran', $no_pendaftaran)->delete();
            DB::commit();
            return Redirect::back()->with(messageSuccess('Data Berhasil Di Hapus'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function show($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $mpendaftaran = new Pendaftaran();
        $data['pendaftaran'] = $mpendaftaran->getPendaftaran($no_pendaftaran)->first();
        $data['jenisdokumenpendaftaran'] = Jenisdokumenpendaftaran::all();
        return view('pendaftaran.show', $data);
    }

    public function cetak($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $mpendaftaran = new Pendaftaran();
        $data['pendaftaran'] = $mpendaftaran->getPendaftaran($no_pendaftaran)->first();
        // Membuat QR Code dengan data teks sederhana
        $data['qrCode'] = QrCode::size(100)->generate($no_pendaftaran);
        return view('pendaftaran.cetak', $data);
    }


    public function storedokumen(Request $request,)
    {
        $request->validate([
            'kode_dokumen' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'kode_dokumen.required' => 'Jenis Dokumen Harus Dipilih.',
            'file.required' => 'Silahkan Pilih File Yang Akan Di Upload.',
            'file.mimes' => 'Silahkan Upload dengan Format PDF.',
            'file.max' => 'Ukuran Dokumen Tidak Boleh Lebih dari 2 MB',
        ]);
        $no_pendaftaran = $request->no_pendaftaran;

        // $fileName = time() . '_' . $request->file->getClientOriginalName();
        // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');


        if ($request->hasfile('file')) {
            $file_name =  $no_pendaftaran . "-" . $request->kode_dokumen . "." . $request->file('file')->getClientOriginalExtension();
            $destination_foto_path = "/public/pendaftaran/persyaratan/";
            $file = $file_name;
        }

        $cek = Dokumenpersyaratan::where('no_pendaftaran', $no_pendaftaran)->where('kode_dokumen', $request->kode_dokumen)->count();
        if ($cek > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen Sudah Ada',
            ], 500);
        }
        $simpan = Dokumenpersyaratan::create([
            'no_pendaftaran'  => $no_pendaftaran,
            'kode_dokumen' => $request->kode_dokumen,
            'nama_file' => $file_name,
        ]);

        if ($simpan) {
            if ($request->hasfile('file')) {
                $request->file('file')->storeAs($destination_foto_path, $file_name);
            }
        }
        // Dokumenpersyaratan::create([
        //     'kode_dokumen' => $request->kode_dkumen,
        //     'file_path' => '/storage/' . $filePath,
        // ]);

        return response()->json(['success' => 'File uploaded successfully.']);
    }


    public function getdokumen($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $data['dokumen'] = Dokumenpersyaratan::join('pendaftaran_jenis_dokumen', 'pendaftaran_dokumen.kode_dokumen', 'pendaftaran_jenis_dokumen.kode_dokumen')->where('no_pendaftaran', $no_pendaftaran)->get();
        return view('pendaftaran.getdokumen', $data);
    }


    public function deletedokumen(Request $request)
    {
        $dokumen = Dokumenpersyaratan::where('no_pendaftaran', $request->no_pendaftaran)->where('kode_dokumen', $request->kode_dokumen)->first();
        try {
            Dokumenpersyaratan::where('no_pendaftaran', $request->no_pendaftaran)->where('kode_dokumen', $request->kode_dokumen)->delete();
            Storage::delete('/public/pendaftaran/persyaratan/' . $dokumen->nama_file);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasilsil Dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
