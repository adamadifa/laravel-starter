<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function getregencybyprovince(Request $request)
    {
        $regencies = Regency::where('province_id', $request->id_province)->get();
        echo "<option value=''>Pilih Kabupaten / Kota</option>";

        foreach ($regencies as $d) {
            $selected = $d->id == $request->id_regency ? 'selected':'';
            echo "<option value='$d->id' id='$d->id' request='$request->id_regency' $selected>$d->name</option>";
        }
    }
}
