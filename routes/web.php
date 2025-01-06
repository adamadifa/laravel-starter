<?php

use App\Http\Controllers\AgendakegiatanController;
use App\Http\Controllers\AsalsekolahController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenConroller;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JamkerjaController;
use App\Http\Controllers\JenisbiayaController;
use App\Http\Controllers\JobdeskController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriledgerController;
use App\Http\Controllers\KategoripemasukanController;
use App\Http\Controllers\KategoripengeluaranController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\LedgertransaksiController;
use App\Http\Controllers\PembayaranpendidikanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Permission_groupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramkerjaController;
use App\Http\Controllers\RealisasikegiatanController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RencanasppController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaldoawalledgerController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SumberdanaController;
use App\Http\Controllers\TahunajaranController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Setings
    //Role
    Route::controller(DashboardController::class)->group(function () {
        Route::post('/dashboard/getrealisasikegiatan', 'getrealisasikegiatan')->name('dashboard.getrealisasikegiatan');
        Route::post('/dashboard/getagendakegiatan', 'getagendakegiatan')->name('dashboard.getagendakegiatan');
    });
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::post('/roles', 'store')->name('roles.store');
        Route::get('/roles/{id}/edit', 'edit')->name('roles.edit');
        Route::put('/roles/{id}/update', 'update')->name('roles.update');
        Route::delete('/roles/{id}/delete', 'destroy')->name('roles.delete');
        Route::get('/roles/{id}/createrolepermission', 'createrolepermission')->name('roles.createrolepermission');
        Route::post('/roles/{id}/storerolepermission', 'storerolepermission')->name('roles.storerolepermission');
    });


    Route::controller(Permission_groupController::class)->group(function () {
        Route::get('/permissiongroups', 'index')->name('permissiongroups.index');
        Route::get('/permissiongroups/create', 'create')->name('permissiongroups.create');
        Route::post('/permissiongroups', 'store')->name('permissiongroups.store');
        Route::get('/permissiongroups/{id}/edit', 'edit')->name('permissiongroups.edit');
        Route::put('/permissiongroups/{id}/update', 'update')->name('permissiongroups.update');
        Route::delete('/permissiongroups/{id}/delete', 'destroy')->name('permissiongroups.delete');
    });


    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permissions', 'index')->name('permissions.index');
        Route::get('/permissions/create', 'create')->name('permissions.create');
        Route::post('/permissions', 'store')->name('permissions.store');
        Route::get('/permissions/{id}/edit', 'edit')->name('permissions.edit');
        Route::put('/permissions/{id}/update', 'update')->name('permissions.update');
        Route::delete('/permissions/{id}/delete', 'destroy')->name('permissions.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}/update', 'update')->name('users.update');
        Route::delete('/users/{id}/delete', 'destroy')->name('users.delete');
    });

    Route::controller(KaryawanController::class)->group(function () {
        Route::get('/karyawan', 'index')->name('karyawan.index')->can('karyawan.index');
        Route::get('/karyawan/create', 'create')->name('karyawan.create')->can('karyawan.create');
        Route::post('/karyawan', 'store')->name('karyawan.store')->can('karyawan.store');
        Route::get('/karyawan/{npp}/edit', 'edit')->name('karyawan.edit')->can('karyawan.edit');
        Route::get('/karyawan/{npp}/show', 'show')->name('karyawan.show')->can('karyawan.show');
        Route::put('/karyawan/{npp}/update', 'update')->name('karyawan.update')->can('karyawan.update');
        Route::delete('/karyawan/{npp}/delete', 'destroy')->name('karyawan.delete')->can('karyawan.delete');
    });

    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa', 'index')->name('siswa.index')->can('siswa.index');
        Route::get('/siswa/create', 'create')->name('siswa.create')->can('siswa.create');
        Route::post('/siswa', 'store')->name('siswa.store')->can('siswa.store');
        Route::get('/siswa/{kode_siswa}/edit', 'edit')->name('siswa.edit')->can('siswa.edit');
        Route::get('/siswa/{kode_siswa}/show', 'show')->name('siswa.show')->can('siswa.show');
        Route::put('/siswa/{kode_siswa}/update', 'update')->name('siswa.update')->can('siswa.update');
        Route::delete('/siswa/{kode_siswa}/delete', 'destroy')->name('siswa.delete')->can('siswa.delete');

        Route::get('/siswa/{id_siswa}/getsiswa', 'getsiswa')->name('siswa.getsiswa');
    });

    Route::controller(JabatanController::class)->group(function () {
        Route::get('/jabatan', 'index')->name('jabatan.index')->can('jabatan.index');
        Route::get('/jabatan/create', 'create')->name('jabatan.create')->can('jabatan.create');
        Route::post('/jabatan', 'store')->name('jabatan.store')->can('jabatan.store');
        Route::get('/jabatan/{kode_jabatan}/edit', 'edit')->name('jabatan.edit')->can('jabatan.edit');
        Route::get('/jabatan/{kode_jabatan}/show', 'show')->name('jabatan.show')->can('jabatan.show');
        Route::put('/jabatan/{kode_jabatan}/update', 'update')->name('jabatan.update')->can('jabatan.update');
        Route::delete('/jabatan/{kode_jabatan}/delete', 'destroy')->name('jabatan.delete')->can('jabatan.delete');
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit', 'index')->name('unit.index')->can('unit.index');
        Route::get('/unit/create', 'create')->name('unit.create')->can('unit.create');
        Route::post('/unit', 'store')->name('unit.store')->can('unit.store');
        Route::get('/unit/{kode_unit}/edit', 'edit')->name('unit.edit')->can('unit.edit');
        Route::get('/unit/{kode_unit}/show', 'show')->name('unit.show')->can('unit.show');
        Route::put('/unit/{kode_unit}/update', 'update')->name('unit.update')->can('unit.update');
        Route::delete('/unit/{kode_unit}/delete', 'destroy')->name('unit.delete')->can('unit.delete');

        //AJAX REQUEST
        Route::post('/unit/gettingkatbyunit', 'gettingkatbyunit')->name('unit.gettingkatbyunit');
    });

    Route::controller(DepartemenConroller::class)->group(function () {
        Route::get('/departemen', 'index')->name('departemen.index')->can('departemen.index');
        Route::get('/departemen/create', 'create')->name('departemen.create')->can('departemen.create');
        Route::post('/departemen', 'store')->name('departemen.store')->can('departemen.store');
        Route::get('/departemen/{kode_dept}/edit', 'edit')->name('departemen.edit')->can('departemen.edit');
        Route::put('/departemen/{kode_dept}/update', 'update')->name('departemen.update')->can('departemen.update');
        Route::delete('/departemen/{kode_dept}/delete', 'destroy')->name('departemen.delete')->can('departemen.delete');
    });

    Route::controller(LedgerController::class)->group(function () {
        Route::get('/ledger', 'index')->name('ledger.index')->can('ledger.index');
        Route::get('/ledger/create', 'create')->name('ledger.create')->can('ledger.create');
        Route::post('/ledger', 'store')->name('ledger.store')->can('ledger.store');
        Route::get('/ledger/{kode_ledger}/edit', 'edit')->name('ledger.edit')->can('ledger.edit');
        Route::get('/ledger/{kode_ledger}/show', 'show')->name('ledger.show')->can('ledger.show');
        Route::put('/ledger/{kode_ledger}/update', 'update')->name('ledger.update')->can('ledger.update');
        Route::delete('/ledger/{kode_ledger}/delete', 'destroy')->name('ledger.delete')->can('ledger.delete');
    });

    Route::controller(LedgertransaksiController::class)->group(function () {
        Route::get('/ledgertransaksi', 'index')->name('ledgertransaksi.index')->can('ledgertransaksi.index');
        Route::get('/ledgertransaksi/create', 'create')->name('ledgertransaksi.create')->can('ledgertransaksi.create');
        Route::post('/ledgertransaksi', 'store')->name('ledgertransaksi.store')->can('ledgertransaksi.store');
        Route::get('/ledgertransaksi/{kode_ledgertransaksi}/edit', 'edit')->name('ledgertransaksi.edit')->can('ledgertransaksi.edit');
        Route::get('/ledgertransaksi/{kode_ledgertransaksi}/show', 'show')->name('ledgertransaksi.show')->can('ledgertransaksi.show');
        Route::put('/ledgertransaksi/{kode_ledgertransaksi}/update', 'update')->name('ledgertransaksi.update')->can('ledgertransaksi.update');
        Route::delete('/ledgertransaksi/{kode_ledgertransaksi}/delete', 'destroy')->name('ledgertransaksi.delete')->can('ledgertransaksi.delete');
    });

    Route::controller(KategoriledgerController::class)->group(function () {
        Route::get('/kategoriledger', 'index')->name('kategoriledger.index')->can('kategoriledger.index');
        Route::get('/kategoriledger/create', 'create')->name('kategoriledger.create')->can('kategoriledger.create');
        Route::post('/kategoriledger', 'store')->name('kategoriledger.store')->can('kategoriledger.store');
        Route::get('/kategoriledger/{id}/edit', 'edit')->name('kategoriledger.edit')->can('kategoriledger.edit');
        Route::get('/kategoriledger/{id}/show', 'show')->name('kategoriledger.show')->can('kategoriledger.show');
        Route::put('/kategoriledger/{id}/update', 'update')->name('kategoriledger.update')->can('kategoriledger.update');
        Route::delete('/kategoriledger/{id}/delete', 'destroy')->name('kategoriledger.delete')->can('kategoriledger.delete');

        Route::post('/kategoriledger/getkategoriledger', 'getkategoriledger')->name('kategoriledger.getkategoriledger');
    });

    Route::controller(SaldoawalledgerController::class)->group(function () {
        Route::get('/saldoawalledger', 'index')->name('saldoawalledger.index')->can('saldoawalledger.index');
        Route::get('/saldoawalledger/create', 'create')->name('saldoawalledger.create')->can('saldoawalledger.create');
        Route::post('/saldoawalledger', 'store')->name('saldoawalledger.store')->can('saldoawalledger.store');
        Route::get('/saldoawalledger/{kode_saldoawal}/edit', 'edit')->name('saldoawalledger.edit')->can('saldoawalledger.edit');
        Route::get('/saldoawalledger/{kode_saldoawal}/show', 'show')->name('saldoawalledger.show')->can('saldoawalledger.show');
        Route::put('/saldoawalledger/{kode_saldoawal}/update', 'update')->name('saldoawalledger.update')->can('saldoawalledger.update');
        Route::delete('/saldoawalledger/{kode_saldoawal}/delete', 'destroy')->name('saldoawalledger.delete')->can('saldoawalledger.delete');

        Route::post('/saldoawalledger/getsaldo', 'getsaldo')->name('saldoawalledger.getsaldo')->can('saldoawalledger.create');
    });

    Route::controller(JobdeskController::class)->group(function () {
        Route::get('/jobdesk', 'index')->name('jobdesk.index')->can('jobdesk.index');
        Route::get('/jobdesk/create', 'create')->name('jobdesk.create')->can('jobdesk.create');
        Route::post('/jobdesk', 'store')->name('jobdesk.store')->can('jobdesk.store');
        Route::get('/jobdesk/{kode_jobdesk}/edit', 'edit')->name('jobdesk.edit')->can('jobdesk.edit');
        Route::get('/jobdesk/{kode_jobdesk}/show', 'show')->name('jobdesk.show')->can('jobdesk.show');
        Route::put('/jobdesk/{kode_jobdesk}/update', 'update')->name('jobdesk.update')->can('jobdesk.update');
        Route::delete('/jobdesk/{kode_jobdesk}/delete', 'destroy')->name('jobdesk.delete')->can('jobdesk.delete');

        Route::get('/jobdesk/getjobdesk', 'getjobdesk')->name('jobdesk.getjobdesk');
    });

    Route::controller(RealisasikegiatanController::class)->group(function () {
        Route::get('/realisasikegiatan', 'index')->name('realisasikegiatan.index')->can('realkegiatan.index');
        Route::get('/realisasikegiatan/create', 'create')->name('realisasikegiatan.create')->can('realkegiatan.create');
        Route::post('/realisasikegiatan', 'store')->name('realisasikegiatan.store')->can('realkegiatan.store');
        Route::get('/realisasikegiatan/{id}/edit', 'edit')->name('realisasikegiatan.edit')->can('realkegiatan.edit');
        Route::get('/realisasikegiatan/show/{id}', 'show')->name('realisasikegiatan.show')->can('realkegiatan.create');
        Route::put('/realisasikegiatan/{id}/update', 'update')->name('realisasikegiatan.update')->can('realkegiatan.update');
        Route::delete('/realisasikegiatan/{id}/delete', 'destroy')->name('realisasikegiatan.delete')->can('realkegiatan.delete');

        Route::post('/realisasikegiatan/getrealisasikegiatan', 'getrealisasikegiatan')->name('realisasikegiatan.getrealisasikegiatan');
    });

    Route::controller(AgendakegiatanController::class)->group(function () {
        Route::get('/agendakegiatan', 'index')->name('agendakegiatan.index')->can('agendakegiatan.index');
        Route::get('/agendakegiatan/create', 'create')->name('agendakegiatan.create')->can('agendakegiatan.create');
        Route::post('/agendakegiatan', 'store')->name('agendakegiatan.store')->can('agendakegiatan.store');
        Route::get('/agendakegiatan/{id}/edit', 'edit')->name('agendakegiatan.edit')->can('agendakegiatan.edit');
        Route::get('/agendakegiatan/show/{id}', 'show')->name('agendakegiatan.show')->can('agendakegiatan.create');
        Route::put('/agendakegiatan/{id}/update', 'update')->name('agendakegiatan.update')->can('agendakegiatan.update');
        Route::delete('/agendakegiatan/{id}/delete', 'destroy')->name('agendakegiatan.delete')->can('agendakegiatan.delete');

        Route::post('/agendakegiatan/getagendakegiatan', 'getagendakegiatan')->name('agendakegiatan.getagendakegiatan');
    });


    Route::controller(JenisbiayaController::class)->group(function () {
        Route::get('/jenisbiaya', 'index')->name('jenisbiaya.index')->can('jenisbiaya.index');
        Route::get('/jenisbiaya/create', 'create')->name('jenisbiaya.create')->can('jenisbiaya.create');
        Route::post('/jenisbiaya', 'store')->name('jenisbiaya.store')->can('jenisbiaya.store');
        Route::get('/jenisbiaya/{kode_jenis_biaya}/edit', 'edit')->name('jenisbiaya.edit')->can('jenisbiaya.edit');
        Route::put('/jenisbiaya/{kode_jenis_biaya}/update', 'update')->name('jenisbiaya.update')->can('jenisbiaya.update');
        Route::delete('/jenisbiaya/{kode_jenis_biaya}/delete', 'destroy')->name('jenisbiaya.delete')->can('jenisbiaya.delete');
    });


    Route::controller(ProgramkerjaController::class)->group(function () {
        Route::get('/programkerja', 'index')->name('programkerja.index')->can('programkerja.index');
        Route::get('/programkerja/create', 'create')->name('programkerja.create')->can('programkerja.create');
        Route::post('/programkerja', 'store')->name('programkerja.store')->can('programkerja.create');
        Route::get('/programkerja/{kode_program_kerja}/edit', 'edit')->name('programkerja.edit')->can('programkerja.edit');
        Route::get('/programkerja/{kode_program_kerja}/show', 'show')->name('programkerja.show')->can('programkerja.index');
        Route::put('/programkerja/{kode_program_kerja}/update', 'update')->name('programkerja.update')->can('programkerja.edit');
        Route::delete('/programkerja/{kode_program_kerja}/delete', 'destroy')->name('programkerja.delete')->can('programkerja.delete');
    });



    Route::controller(BiayaController::class)->group(function () {
        Route::get('/biaya', 'index')->name('biaya.index')->can('biaya.index');
        Route::get('/biaya/create', 'create')->name('biaya.create')->can('biaya.create');
        Route::post('/biaya', 'store')->name('biaya.store')->can('biaya.store');
        Route::get('/biaya/{kode_biaya}/edit', 'edit')->name('biaya.edit')->can('biaya.edit');
        Route::get('/biaya/{kode_biaya}/show', 'show')->name('biaya.show')->can('biaya.show');
        Route::put('/biaya/{kode_biaya}/update', 'update')->name('biaya.update')->can('biaya.update');
        Route::delete('/biaya/{kode_biaya}/delete', 'destroy')->name('biaya.delete')->can('biaya.delete');
    });


    //Konfigurasi

    Route::controller(JamkerjaController::class)->group(function () {
        Route::get('/jamkerja', 'index')->name('jamkerja.index')->can('jamkerja.index');
        Route::get('/jamkerja/create', 'create')->name('jamkerja.create')->can('jamkerja.create');
        Route::post('/jamkerja', 'store')->name('jamkerja.store')->can('jamkerja.store');
        Route::get('/jamkerja/{kode_jamkerja}/edit', 'edit')->name('jamkerja.edit')->can('jamkerja.edit');
        Route::get('/jamkerja/{kode_jamkerja}/show', 'show')->name('jamkerja.show')->can('jamkerja.show');
        Route::put('/jamkerja/{kode_jamkerja}/update', 'update')->name('jamkerja.update')->can('jamkerja.update');
        Route::delete('/jamkerja/{kode_jamkerja}/delete', 'destroy')->name('jamkerja.delete')->can('jamkerja.delete');
    });


    Route::controller(TahunajaranController::class)->group(function () {
        Route::get('/tahunajaran', 'index')->name('tahunajaran.index')->can('tahunajaran.index');
        Route::get('/tahunajaran/create', 'create')->name('tahunajaran.create')->can('tahunajaran.create');
        Route::post('/tahunajaran', 'store')->name('tahunajaran.store')->can('tahunajaran.store');
        Route::get('/tahunajaran/{kode_ta}/edit', 'edit')->name('tahunajaran.edit')->can('tahunajaran.edit');
        Route::get('/tahunajaran/{kode_ta}/show', 'show')->name('tahunajaran.show')->can('tahunajaran.show');
        Route::put('/tahunajaran/{kode_ta}/update', 'update')->name('tahunajaran.update')->can('tahunajaran.update');
        Route::delete('/tahunajaran/{kode_ta}/delete', 'destroy')->name('tahunajaran.delete')->can('tahunajaran.delete');
    });

    Route::controller(PendaftaranController::class)->group(function () {
        Route::get('/pendaftaran', 'index')->name('pendaftaran.index')->can('pendaftaran.index');
        Route::get('/pendaftaran/create', 'create')->name('pendaftaran.create')->can('pendaftaran.create');
        Route::post('/pendaftaran', 'store')->name('pendaftaran.store')->can('pendaftaran.store');
        Route::post('/pendaftaran/uploaddokumen', 'storedokumen')->name('pendaftaran.storedokumen')->can('pendaftaran.store');
        Route::get('/pendaftaran/{no_pendaftaran}/edit', 'edit')->name('pendaftaran.edit')->can('pendaftaran.edit');
        Route::get('/pendaftaran/{no_pendaftaran}/cetak', 'cetak')->name('pendaftaran.cetak')->can('pendaftaran.show');
        Route::get('/pendaftaran/{no_pendaftaran}/show', 'show')->name('pendaftaran.show')->can('pendaftaran.show');
        Route::put('/pendaftaran/{no_pendaftaran}/update', 'update')->name('pendaftaran.update')->can('pendaftaran.update');
        Route::get('/pendaftaran/{no_pendaftaran}/getdokumen', 'getdokumen')->name('pendaftaran.getdokumen')->can('pendaftaran.show');
        Route::delete('/pendaftaran/{no_pendaftaran}/delete', 'destroy')->name('pendaftaran.delete')->can('pendaftaran.delete');
        Route::post('/pendaftaran/deletedokumen', 'deletedokumen')->name('pendaftaran.deletedokumen')->can('pendaftaran.delete');

        Route::get('/pendaftaran/getsiswa', 'getsiswa')->name('pendaftaran.getsiswa');
    });

    Route::controller(PembayaranpendidikanController::class)->group(function () {
        Route::get('/pembayaranpendidikan', 'index')->name('pembayaranpendidikan.index')->can('pembayaranpdd.index');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/show', 'show')->name('pembayaranpendidikan.show')->can('pembayaranpdd.show');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/getbiaya', 'getbiaya')->name('pembayaranpendidikan.getbiaya')->can('pembayaranpdd.show');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/{kode_jenis_biaya}/{kode_biaya}/inputpotongan', 'createpotongan')->name('pembayaranpendidikan.create')->can('pembayaranpdd.create');
        Route::post('/pembayaranpendidikan/storepotongan', 'storepotongan')->name('pembayaranpendidikan.storepotongan')->can('pembayaranpdd.create');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/{kode_jenis_biaya}/{kode_biaya}/inputmutasi', 'createmutasi')->name('pembayaranpendidikan.create')->can('pembayaranpdd.create');
        Route::post('/pembayaranpendidikan/storemutasi', 'storemutasi')->name('pembayaranpendidikan.storemutasi')->can('pembayaranpdd.create');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/create', 'create')->name('pembayaranpendidikan.create')->can('pembayaranpdd.create');
        Route::post('/pembayaranpendidikan/store', 'store')->name('pembayaranpendidikan.store')->can('pembayaranpdd.create');
        Route::get('/pembayaranpendidikan/{no_pendaftaran}/gethistoribayar', 'gethistoribayar')->name('pembayaranpendidikan.gethistoribayar')->can('pembayaranpdd.create');
        Route::post('/pembayaranpendidikan/delete', 'destroy')->name('pembayaranpendidikan.delete')->can('pembayaranpdd.delete');
        Route::post('/pembayaranpendidikan/getsisatagihan', 'getsisatagihan')->name('pembayaranpendidikan.getsisatagihan')->can('pembayaranpdd.create');
        Route::get('/pembayaranpendidikan/{no_bukti}/showdetailbayar', 'showdetailbayar')->name('pembayaranpendidikan.showdetailbayar')->can('pembayaranpdd.show');
    });

    Route::controller(RencanasppController::class)->group(function () {
        Route::get('/rencanaspp', 'index')->name('rencanaspp.index')->can('rencanaspp.index');
        Route::get('/rencanaspp/{no_pendaftaran}/create', 'create')->name('rencanaspp.create')->can('rencanaspp.create');
        Route::get('/rencanaspp/{no_pendaftaran}/getrencanaspp', 'getrencanaspp')->name('rencanaspp.create')->can('rencanaspp.create');
        Route::post('/rencanaspp', 'store')->name('rencanaspp.store')->can('rencanaspp.create');
        Route::get('/rencanaspp/{kode_rencana_spp}/edit', 'edit')->name('rencanaspp.edit')->can('rencanaspp.edit');
        Route::post('/rencanaspp/update', 'update')->name('rencanaspp.update')->can('rencanaspp.edit');

        Route::post('/rencanaspp/getspp', 'getspp')->name('rencanaspp.getspp')->can('rencanaspp.create');
    });

    Route::controller(RegencyController::class)->group(function () {
        Route::post('/regency/getregencybyprovince', 'getregencybyprovince')->name('regency.getregencybyprovince');
    });
    Route::controller(DistrictController::class)->group(function () {
        Route::post('/district/getdistrictbyregency', 'getdistrictbyregency')->name('regency.getdistrictbyregency');
    });

    Route::controller(VillageController::class)->group(function () {
        Route::post('/village/getvillagebydistrict', 'getvillagebydistrict')->name('regency.getvillagebydistrict');
    });

    Route::controller(AsalsekolahController::class)->group(function () {
        Route::get('/asalsekolah', 'index')->name('asalsekolah.index')->can('asalsekolah.index');
        Route::get('/asalsekolah/create', 'create')->name('asalsekolah.create')->can('asalsekolah.create');
        Route::post('/asalsekolah', 'store')->name('asalsekolah.store')->can('asalsekolah.store');
        Route::get('/asalsekolah/{kode_asalsekolah}/edit', 'edit')->name('asalsekolah.edit')->can('asalsekolah.edit');
        Route::get('/asalsekolah/{kode_asalsekolah}/show', 'show')->name('asalsekolah.show')->can('asalsekolah.show');
        Route::put('/asalsekolah/{kode_asalsekolah}/update', 'update')->name('asalsekolah.update')->can('asalsekolah.update');
        Route::delete('/asalsekolah/{kode_asalsekolah}/delete', 'destroy')->name('asalsekolah.delete')->can('asalsekolah.delete');

        Route::get('/asalsekolah/{kode_unit}/{kode_asal_sekolah}/getasalsekolahbyunit', 'getasalsekolahbyunit')->name('asalsekolah.getasalsekolahbyunit');
    });
});


Route::get('/createrolepermission', function () {

    try {
        Role::create(['name' => 'super admin']);
        // Permission::create(['name' => 'view-karyawan']);
        // Permission::create(['name' => 'view-departemen']);
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});

require __DIR__ . '/auth.php';
