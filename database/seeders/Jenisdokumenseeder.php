<?php

namespace Database\Seeders;

use App\Models\Jenisdokumenpendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Jenisdokumenseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenisdokumenpendaftaran::create([
            'kode_dokumen' => 'D01',
            'jenis_dokumen' => 'Kartu Keluarga',
        ]);

        Jenisdokumenpendaftaran::create([
            'kode_dokumen' => 'D02',
            'jenis_dokumen' => 'Akta Kelahiran',
        ]);

        Jenisdokumenpendaftaran::create([
            'kode_dokumen' => 'D03',
            'jenis_dokumen' => 'Ijazah',
        ]);
    }
}
