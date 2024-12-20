<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Jobdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class JobdeskController extends Controller
{
    public function index(Request $request)
    {
        $query = Jobdesk::query();
        $query->join('departemen', 'jobdesk.kode_dept', '=', 'departemen.kode_dept');
        $query->join('jabatan', 'jobdesk.kode_jabatan', '=', 'jabatan.kode_jabatan');
        $query->orderBy('kode_jobdesk');
        $query->where('jobdesk.kode_jabatan', $request->kode_jabatan);
        $query->where('jobdesk.kode_dept', $request->kode_dept);
        $data['jobdesk'] = $query->get();

        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();

        return view('datamaster.jobdesk.index', $data);
    }


    public function create()
    {
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('datamaster.jobdesk.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'jobdesk' => 'required',
        ]);

        try {
            $lastjobdesk = Jobdesk::orderBy('kode_jobdesk', 'desc')
                ->where('kode_jabatan', $request->kode_jabatan)
                ->where('kode_dept', $request->kode_dept)
                ->first();
            $last_kode_jobdesk = $lastjobdesk != null ? $lastjobdesk->kode_jobdesk : '';
            $kode_jobdesk = buatkode($last_kode_jobdesk, $request->kode_jabatan . $request->kode_dept, 4);
            Jobdesk::create([
                'kode_jobdesk' => $kode_jobdesk,
                'jobdesk' => $request->jobdesk,
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Disimpan'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function destroy($kode_jobdesk)
    {
        $kode_jobdesk = Crypt::decrypt($kode_jobdesk);
        try {
            Jobdesk::where('kode_jobdesk', $kode_jobdesk)->delete();
            return Redirect::back()->with(messageSuccess('Data Berhasil Dihapus'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }

    public function edit($kode_jobdesk)
    {
        $kode_jobdesk = Crypt::decrypt($kode_jobdesk);
        $data['jobdesk'] = Jobdesk::where('kode_jobdesk', $kode_jobdesk)->first();
        $data['jabatan'] = Jabatan::orderBy('kode_jabatan')->where('kode_jabatan', '!=', 'J00')->get();
        $data['departemen'] = Departemen::orderBy('kode_dept')->get();
        return view('datamaster.jobdesk.edit', $data);
    }

    public function update(Request $request, $kode_jobdesk)
    {
        $request->validate([
            'kode_jabatan' => 'required',
            'kode_dept' => 'required',
            'jobdesk' => 'required',
        ]);
        $kode_jobdesk = Crypt::decrypt($kode_jobdesk);
        try {
            Jobdesk::where('kode_jobdesk', $kode_jobdesk)->update([
                'kode_jabatan' => $request->kode_jabatan,
                'kode_dept' => $request->kode_dept,
                'jobdesk' => $request->jobdesk
            ]);
            return Redirect::back()->with(messageSuccess('Data Berhasil Diubah'));
        } catch (\Exception $e) {
            return Redirect::back()->with(messageError($e->getMessage()));
        }
    }


    public function getjobdesk(Request $request)
    {
        $jobdesk = Jobdesk::where('kode_jabatan', $request->kode_jabatan)->where('kode_dept', $request->kode_dept)->get();
        return response()->json($jobdesk);
    }
}
