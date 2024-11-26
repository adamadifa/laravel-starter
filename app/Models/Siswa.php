<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $primaryKey = "id_siswa";
    protected $guarded = [];

    public function getSiswa($id_siswa = null)
    {
        $query = Siswa::query();
        if (!empty($id_siswa)) {
            $query->where('id_siswa', $id_siswa);
        }
        return $query;
    }
}
