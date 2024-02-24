<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $query->with('roles');
        $query->leftjoin('unit', 'users.kode_unit', '=', 'unit.kode_unit');
        $users = $query->paginate(10);
        return view('settings.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $unit = Unit::orderBy('kode_unit')->get();
        return view('settings.users.create', compact('roles', 'unit'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::with('roles')->where('id', $id)->first();
        $roles = Role::orderBy('name')->get();
        $unit = Unit::orderBy('kode_unit')->get();
        return view('settings.users.edit', compact('user', 'roles', 'unit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'kode_unit' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'kode_unit' => $request->kode_unit
            ]);

            $user->assignRole($request->role);
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['eror' => 'Data Gagal Disimpan']);
        }
    }


    public function update($id, Request $request)
    {
        $id = Crypt::decrypt($id);
        $user = User::findorFail($id);


        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'kode_unit' => 'required'
        ]);

        try {

            if (isset($request->password)) {
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'kode_unit' => $request->kode_unit,
                ]);
            } else {
                User::where('id', $id)->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'kode_unit' => $request->kode_unit
                ]);
            }

            if (isset($request->role)) {
                $user->syncRoles([]);
                $user->assignRole($request->role);
            }

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        try {
            User::where('id', $id)->delete();
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => $e->getMessage()]);
        }
    }
}
