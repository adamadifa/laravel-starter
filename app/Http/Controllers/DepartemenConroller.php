<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenConroller extends Controller
{

    public function index(Request $request)
    {
        $query = Departemen::query();
        if (!empty($request->nama_dept)) {
            $query->where('nama_dept', 'like', '%' . $request->nama_dept . '%');
        }
        $data['departemen'] = $query->get();
        return view('departemen.index', $data);
    }
}
