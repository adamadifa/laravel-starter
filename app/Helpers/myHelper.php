<?php

use App\Models\Produk;
use App\Models\Tutuplaporan;
use Illuminate\Support\Facades\Redirect;

function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0)
{
    /* mencari nomor baru dengan memecah nomor terakhir dan menambahkan 1
    string nomor baru dibawah ini harus dengan format XXX000000
    untuk penggunaan dalam format lain anda harus menyesuaikan sendiri */
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
    //    menambahkan nol didepan nomor baru sesuai panjang jumlah karakter
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
    //    menyusun kunci dan nomor baru
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;
}

function messageSuccess($message)
{
    return ['success' => $message];
}


function messageError($message)
{
    return ['error' => $message];
}


// Mengubah ke Huruf Besar
function textUpperCase($value)
{
    return strtoupper(strtolower($value));
}
// Mengubah ke CamelCase
function textCamelCase($value)
{
    return ucwords(strtolower($value));
}




function getFotosiswa($file)
{
    $url = url('/storage/pelanggan/' . $file);
    return $url;
}


function getfotoKaryawan($file)
{
    $url = url('/storage/karyawan/' . $file);
    return $url;
}


function toNumber($value)
{
    if (!empty($value)) {
        return str_replace([".", ","], ["", "."], $value);
    } else {
        return 0;
    }
}


function formatRupiah($nilai)
{
    return number_format($nilai, '0', ',', '.');
}

function formatAngka($nilai)
{
    if (!empty($nilai)) {
        return number_format($nilai, '0', ',', '.');
    }
}


function formatAngkaDesimal($nilai)
{
    if (!empty($nilai)) {
        return number_format($nilai, '2', ',', '.');
    }
}

function formatAngkaDesimal3($nilai)
{
    if (!empty($nilai)) {
        return number_format($nilai, '3', ',', '.');
    }
}



function DateToIndo($date2)
{ // fungsi atau method untuk mengubah tanggal ke format indonesia
    // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo2 = array(
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    );

    $tahun2 = substr($date2, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan2 = substr($date2, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl2   = substr($date2, 8, 2); // memisahkan format tanggal menggunakan substring

    $result = $tgl2 . " " . $BulanIndo2[(int)$bulan2 - 1] . " " . $tahun2;
    return ($result);
}


function getbulandantahunlalu($bulan, $tahun, $show)
{
    if ($bulan == 1) {
        $bulanlalu = 12;
        $tahunlalu = $tahun - 1;
    } else {
        $bulanlalu = $bulan - 1;
        $tahunlalu = $tahun;
    }

    if ($show == "tahun") {
        return $tahunlalu;
    } elseif ($show == "bulan") {
        return $bulanlalu;
    }
}


function getbulandantahunberikutnya($bulan, $tahun, $show)
{
    if ($bulan == 12) {
        $bulanberikutnya =  1;
        $tahunberikutnya = $tahun + 1;
    } else {
        $bulanberikutnya = $bulan + 1;
        $tahunberikutnya = $tahun;
    }

    if ($show == "tahun") {
        return $tahunberikutnya;
    } elseif ($show == "bulan") {
        return $bulanberikutnya;
    }
}


function formatNama($sentence)
{
    $words = explode(' ', $sentence);
    if (count($words) >= 2) {
        return $words[0] . ' ' . $words[1];
    } else {
        return $sentence;
    }
}
