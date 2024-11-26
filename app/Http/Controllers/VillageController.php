<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function getvillagebydistrict(Request $request)
    {
        $villages = Village::where('district_id', $request->id_district)->get();
        echo "<option value=''>Pilih Desa / Kelurahan</option>";
        foreach ($villages as $d) {
            $selected = $d->id == $request->id_village ? 'selected':'';
            echo "<option value='$d->id' $selected>$d->name</option>";
        }
    }
}
