@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@section('titlepage', 'Siswa')

@section('content')
@section('navigasi')
    <span class="text-muted">Siswa/</span> Detail
@endsection
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/img/pages/profile-bg.jpg') }}" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    @if (!empty($siswa->foto))
                        @if (Storage::disk('public')->exists('/karyawan/' . $siswa->foto))
                            <img src="{{ getfotoKaryawan($siswa->foto) }}" alt="user image"
                                class="d-block  ms-0 ms-sm-4 rounded user-profile-img" height="150">
                        @else
                            <img src="{{ asset('assets/img/avatars/No_Image_Available.jpg') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="150">
                        @endif
                    @else
                        <img src="{{ asset('assets/img/avatars/No_Image_Available.jpg') }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="150">
                    @endif


                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ textCamelCase($siswa->nama_lengkap) }}</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-barcode"></i> {{ textCamelCase($siswa->id_siswa) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-barcode"></i> {{ textCamelCase($siswa->nisn) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-building"></i> {{ textCamelCase($siswa->tahun_masuk) }}
                                </li>
                            </ul>
                        </div>
                        {{-- @if ($siswa->status_aktif_karyawan === '1')
                            <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light">
                                <i class="ti ti-check me-1"></i> Aktif
                            </a>
                        @else
                            <a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light">
                                <i class="ti ti-check me-1"></i> Nonaktif
                            </a>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">Data Siswa</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">ID Siswa:</span>
                        <span>{{ $siswa->id_siswa }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">NISN:</span>
                        <span>{{ $siswa->nisn }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Lengkap:</span>
                        <span>{{ $siswa->nama_lengkap }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-calendar text-heading"></i><span class="fw-medium mx-2 text-heading">Tanggal Lahir:</span>
                        <span>{{ $siswa->tanggal_lahir }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Alamat:</span>
                        <span>{{ $siswa->alamat }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Propinsi:</span>
                        <span>{{ $siswa->province_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Kabupaten / Kota:</span>
                        <span>{{ $siswa->regency_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Kecamatan:</span>
                        <span>{{ $siswa->district_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Desa / Keluarahan:</span>
                        <span>{{ $siswa->village_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">No. KK</span>
                        <span>{{ $siswa->no_kk }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-credit-card text-heading"></i><span class="fw-medium mx-2 text-heading">NIK Ayah:</span>
                        <span>{{ $siswa->nik_ayah }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Ayah:</span>
                        <span>{{ $siswa->nama_ayah }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-briefcase text-heading"></i><span class="fw-medium mx-2 text-heading">Pendidikan Ayah:</span>
                        <span>{{ $siswa->pendidikan_ayah }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-briefcase text-heading"></i><span class="fw-medium mx-2 text-heading">Pekerjaan Ayah:</span>
                        <span>{{ $siswa->pekerjaan_ayah }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">NIK Ibu:</span>
                        <span>{{ $siswa->nik_ibu }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Ibu:</span>
                        <span>{{ $siswa->nama_ibu }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-briefcase text-heading"></i><span class="fw-medium mx-2 text-heading">Pendidikan Ibu:</span>
                        <span>{{ $siswa->pendidikan_ibu }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-briefcase text-heading"></i><span class="fw-medium mx-2 text-heading">Pekerjaan Ibu:</span>
                        <span>{{ $siswa->pekerjaan_ibu }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-phone text-heading"></i><span class="fw-medium mx-2 text-heading">No HP Orang Tua:</span>
                        <span>{{ $siswa->no_hp_orang_tua }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-school text-heading"></i><span class="fw-medium mx-2 text-heading">Tahun Masuk:</span>
                        <span>{{ $siswa->tahun_masuk }}</span>
                    </li>


                </ul>

            </div>
        </div>
        <!--/ About User -->

    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-files me-1"></i>
                            Dokumen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-profile-teams.html"><i class="ti-xs ti ti-receipt me-1"></i>
                            Tagihan</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Dokumen Siswa</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

        <!--/ Activity Timeline -->
    </div>
</div>
<!--/ User Profile Content -->
@endsection
