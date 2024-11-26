<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getdistrictbyregency(Request $request)
    {
        $districts = District::where('regency_id', $request->id_regency)->get();
        echo "<option value=''>Pilih Kecamatan</option>";
        foreach ($districts as $d) {
            $selected = $d->id == $request->id_district ? 'selected':'';
            echo "<option value='$d->id' $selected>$d->name</option>";
        }
    }
}
