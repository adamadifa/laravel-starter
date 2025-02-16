@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@section('titlepage', 'Data Simpanan')

@section('content')
@section('navigasi')
    <span class="text-muted">Anggota/</span> Detail
@endsection
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/img/pages/profile-bg.jpg') }}" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    @if (Storage::disk('public')->exists('/anggota/' . $anggota->foto))
                        <img src="{{ getfotoKaryawan($anggota->foto) }}" alt="user image" class="d-block  ms-0 ms-sm-4 rounded user-profile-img"
                            height="150">
                    @else
                        <img src="{{ asset('assets/img/avatars/No_Image_Available.jpg') }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="150">
                    @endif

                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ textCamelCase($anggota->nama_lengkap) }}</h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-barcode"></i> {{ textCamelCase($anggota->no_anggota) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-credit-card"></i> {{ textCamelCase($anggota->nik) }}
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">Data Karyawan</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">No. Anggota</span>
                        <span>{{ $anggota->no_anggota }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-credit-card text-heading"></i><span class="fw-medium mx-2 text-heading">NIK</span>
                        <span>{{ $anggota->nik }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Lengkap</span>
                        <span>{{ textCamelCase($anggota->nama_lengkap) }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Tempat Lahir</span>
                        <span>{{ $anggota->tempat_lahir }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-calendar text-heading"></i><span class="fw-medium mx-2 text-heading">Tanggal Lahir</span>
                        <span>{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d F Y') }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-gender-bigender text-heading"></i><span class="fw-medium mx-2 text-heading">Jenis Kelamin</span>
                        <span>{{ $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-book text-heading"></i><span class="fw-medium mx-2 text-heading">Pendidikan Terakhir</span>
                        <span>{{ $anggota->pendidikan_terakhir }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-rings text-heading"></i><span class="fw-medium mx-2 text-heading">Status Pernikahan</span>
                        @php
                            $status_menikah = ['M' => 'Menikah', 'BM' => 'Belum Meniah', 'JD' => 'Janda / Duda'];
                        @endphp
                        <span>{{ in_array($anggota->status_pernikahan, array_keys($status_menikah)) ? $status_menikah[$anggota->status_pernikahan] : 'Belum Diisi' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-users text-heading"></i><span class="fw-medium mx-2 text-heading">Jumlah Tanggungan</span>
                        <span>{{ $anggota->jml_tanggungan }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Pasangan</span>
                        <span>{{ $anggota->nama_pasangan }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-briefcase text-heading"></i><span class="fw-medium mx-2 text-heading">Pekerjaan Pasangan</span>
                        <span>{{ $anggota->pekerjaan_pasangan }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Ibu</span>
                        <span>{{ $anggota->nama_ibu }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Saudara</span>
                        <span>{{ $anggota->nama_saudara }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-phone-call text-heading"></i><span class="fw-medium mx-2 text-heading">No. HP</span>
                        <span>{{ $anggota->no_hp }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Alamat</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <span class="ms-4">{{ $anggota->alamat }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Provinsi</span>
                        <span>{{ $anggota->province_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Kota</span>
                        <span>{{ $anggota->regency_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Kecamatan</span>
                        <span>{{ $anggota->district_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span class="fw-medium mx-2 text-heading">Kelurahan</span>
                        <span>{{ $anggota->village_name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-envelope text-heading"></i><span class="fw-medium mx-2 text-heading">Kode Pos</span>
                        <span>{{ $anggota->kode_pos }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-home text-heading"></i><span class="fw-medium mx-2 text-heading">Status Tinggal</span>
                        @php
                            $status_tinggal = ['MS' => 'Milik Sendiri', 'MK' => 'Milik Keluarga', 'SK' => 'Sewa / Kontrak'];
                        @endphp
                        <span>{{ in_array($anggota->status_tinggal, array_keys($status_tinggal)) ? $status_tinggal[$anggota->status_tinggal] : 'Belum Diisi' }}</span>
                    </li>


                </ul>
            </div>
        </div>
        <!--/ About User -->
    </div>
    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col">
                <div
                    class="swiper-container cardswiper swiper-container-initialized swiper-container-horizontal swiper-container-ios swiper-container-pointer-events">
                    <div class="swiper-wrapper" id="swiper-wrapper-e7c52537e6cf4732" aria-live="polite"
                        style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">

                        @foreach ($saldo_simpanan as $l)
                            <div class="swiper-slide {{ $loop->first ? 'swiper-slide-active' : '' }}" role="group"
                                aria-label="{{ $loop->index }} / {{ count($saldo_simpanan) }} }}">
                                <div class="card dark-bg">
                                    <div class="card-body p-3 pb-2">
                                        <div class="row mb-1">
                                            <div class="col-auto align-self-center">
                                                <img src="{{ asset('assets/template/img/masterocard.png') }}" alt="">
                                            </div>
                                            <div class=" col align-self-center text-end">
                                                <p class="small">
                                                    <span class="text-uppercase size-10">Validity</span><br>
                                                    <span class="text-muted">Unlimited</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="fw-normal mb-1">
                                                    {{ formatRupiah($l->jumlah) }}
                                                    <span class="small text-muted">Rp</span>
                                                </h4>
                                                <p class="mb-0 text-muted size-12">
                                                    {{ $l->kode_simpanan }}</p>
                                                <p class="text-muted size-12">{{ $l->jenis_simpanan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-primary w-100" id="createSetoran">
                    <i class="ti ti-arrow-up-left me-1"></i>
                    Setoran
                </button>
            </div>
            <div class="col">
                <button class="btn btn-danger w-100" id="createPenarikan">
                    <i class="ti ti-arrow-down-right me-1"></i>
                    Penarikan
                </button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Mutasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="#" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <x-input-with-icon label="Dari Tanggal" name="dari" icon="ti ti-calendar"
                                                datepicker="flatpickr-date" value="{{ Request('dari') }}" />
                                        </div>
                                        <div class="col">
                                            <x-input-with-icon label="Sampai Tanggal" name="sampai" icon="ti ti-calendar"
                                                datepicker="flatpickr-date" value="{{ Request('sampai') }}" />
                                        </div>
                                        <div class="col-lg-1">
                                            <button type="submit" class="btn btn-primary w-100"><i class="ti ti-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No. Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Setor</th>
                                            <th>Tarik</th>
                                            <th>Saldo</th>
                                            <th>Petugas</th>
                                            <th>#</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" style="text-align: center">SALDO AWAL</th>
                                            <td class="text-end" id="saldoawal">{{ formatRupiah($saldo_awal) }}</td>
                                            <th colspan="3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($simpanan as $d)
                                            @php
                                                $setor = $d->jenis_transaksi == 'S' ? $d->jumlah : 0;
                                                $tarik = $d->jenis_transaksi == 'T' ? $d->jumlah : 0;
                                                // $i = $loop->iteration + $simpanan->firstItem() - 1;
                                            @endphp
                                            <tr>
                                                <td>{{ $d->no_transaksi }} </td>
                                                <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                                <td>{{ $d->kode_simpanan }}</td>
                                                <td class="text-end">{{ formatAngka($setor) }}</td>
                                                <td class="text-end text-danger">{{ formatAngka($tarik) }}</td>
                                                <td class="text-end">{{ formatAngka($d->saldo) }}</td>
                                                <td>{{ formatNama1($d->name) }}</td>
                                                <td class="table-report__action w-56">
                                                    <div class="d-flex">
                                                        <a href="{{ route('simpanan.cetakkwitansi', Crypt::encrypt($d->no_transaksi)) }}"
                                                            class="me-1" target="_blank">
                                                            <i class="ti ti-printer text-primary"></i>
                                                        </a>
                                                        <a href="#" class="btnShowberita" berita="{{ $d->berita }}"><i
                                                                class="ti ti-file-description text-info">
                                                            </i>
                                                        </a>
                                                        @can('simpanan.delete')
                                                            @if ($d->no_transaksi == $lasttransaksi->no_transaksi && $d->tanggal == date('Y-m-d'))
                                                                <form method="POST" class="deleteform m-0"
                                                                    action="{{ route('simpanan.delete', Crypt::encrypt($d->no_transaksi)) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a class="delete-confirm ml-1" href="#">
                                                                        <i class="ti ti-trash text-danger"></i>
                                                                    </a>
                                                                </form>
                                                            @endif
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlBerita" size="" show="loadmodalberita" title="" />
<x-modal-form id="mdlSetoran" size="" show="loadmodalSetoran" title="" />
@endsection
@push('myscript')
<script>
    $(function() {
        $(document).on('click', '.btnShowberita', function(e) {
            e.preventDefault();
            var berita = $(this).attr("berita");
            $("#mdlBerita").modal("show");
            $("#loadmodalberita").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlBerita").find(".modal-title").text("Detail Berita");
            $("#loadmodalberita").html(berita);
        });

        $(document).on('click', '#createSetoran', function(e) {
            e.preventDefault();
            let no_anggota = "{{ Crypt::encrypt($anggota->no_anggota) }}";
            let jenis_transaksi = "S";
            $('#mdlSetoran').modal("show");
            $("#loadmodalSetoran").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlSetoran").find(".modal-title").text("Input Data Setoran");
            $("#loadmodalSetoran").load("/simpanan/" + no_anggota + "/" + jenis_transaksi + "/create");
        });

        $(document).on('click', '#createPenarikan', function(e) {
            e.preventDefault();
            let no_anggota = "{{ Crypt::encrypt($anggota->no_anggota) }}";
            let jenis_transaksi = "T";
            $('#mdlSetoran').modal("show");
            $("#loadmodalSetoran").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlSetoran").find(".modal-title").text("Input Data Penarikan");
            $("#loadmodalSetoran").load("/simpanan/" + no_anggota + "/" + jenis_transaksi + "/create");
        });
    });
</script>
@endpush
