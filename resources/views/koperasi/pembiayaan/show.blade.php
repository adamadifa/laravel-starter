@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@section('titlepage', 'Data Pembiayaan')

@section('content')
@section('navigasi')
    <span class="text-muted">Anggota/</span> Detail
@endsection
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/img/pages/profile-bg.jpg') }}" alt="Banner image" class="rounded-top">
                <h2 style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%);" class="text-white text-center">
                    {{ $pembiayaan->no_akad }} - Pembiayaan {{ $pembiayaan->jenis_pembiayaan }}
                    <br>
                    {{ $pembiayaan->keperluan }}
                    <br>
                    @php
                        $jumlah_pembiayaan = $pembiayaan->jumlah + $pembiayaan->jumlah * ($pembiayaan->persentase / 100);
                    @endphp
                    <sup>Rp. </sup>{{ formatRupiah($jumlah_pembiayaan) }}
                </h2>
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
                                    <i class="ti ti-barcode"></i> {{ $pembiayaan->no_akad }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-calendar"></i> {{ DateToIndo($pembiayaan->tanggal) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-credit-card"></i> {{ textCamelCase($pembiayaan->jenis_pembiayaan) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-discount"></i> {{ textCamelCase($pembiayaan->persentase) }} %
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-moneybag"></i> {{ formatAngka($pembiayaan->jumlah) }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-moneybag"></i> {{ formatAngka($jumlah_pembiayaan) }}
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
    <div class="col-xl-3 col-lg-12 col-md-12">
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
    <div class="col-xl-5 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rencana Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('pembiayaan.updaterencana', Crypt::encrypt($pembiayaan->no_akad)) }}" class="btn btn-primary mb-2"
                        id="btnupdateRencana">
                        <i class="ti ti-refresh me-1"></i> Update Rencana
                    </a>
                    @if ($pembiayaan->jmlbayar == 0)
                        <a href="#" no_akad="{{ Crypt::encrypt($pembiayaan->no_akad) }}" class="btn btn-warning mb-2 " id="btnEditrencana">
                            <i class="ti ti-file-description me-1"></i> Edit Rencana Pembayaran
                        </a>
                    @endif

                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Jatuh Tempo</th>
                            <th>Jumlah</th>
                            <th>Bayar</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_rencana = 0;
                            $total_bayar = 0;
                            $total_sisa = 0;
                        @endphp
                        @foreach ($rencana as $d)
                            @php
                                $jatuh_tempo = $d->tahun . '-' . $d->bulan . '-05';
                                $total_rencana += $d->jumlah;
                                $total_bayar += $d->bayar;
                                $total_sisa += $d->jumlah - $d->bayar;
                            @endphp
                            <tr>
                                <td>{{ $d->cicilan_ke }}</td>
                                <td>{{ date('d-m-Y', strtotime($jatuh_tempo)) }}</td>
                                <td class="text-end">{{ formatAngka($d->jumlah) }}</td>
                                <td class="text-end">{{ formatAngka($d->bayar) }}</td>
                                <td class="text-end">
                                    @php
                                        $sisa_tagihan = $d->jumlah - $d->bayar;
                                    @endphp
                                    {{ formatAngka($sisa_tagihan) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td class="text-end">{{ formatAngka($total_rencana) }}</td>
                            <td class="text-end">{{ formatAngka($total_bayar) }}</td>
                            <td class="text-end">{{ formatAngka($total_sisa) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Histori Bayar</h4>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-2" id="btncreateBayar">
                    <i class="ti ti-moneybag me-1"></i> Input Pembayaran
                </a>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No Bukti</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histori as $d)
                            <tr>
                                <td>{{ $d->no_transaksi }}</td>
                                <td>{{ date('d-m-y', strtotime($d->tanggal)) }}</td>
                                <td class="text-end">{{ formatAngka($d->jumlah) }}</td>
                                <td class="text-end">
                                    <div class="d-flex">
                                        <a href="{{ route('pembiayaan.cetakkwitansi', Crypt::encrypt($d->no_transaksi)) }}" class="me-1"
                                            target="_blank"><i class="ti ti-printer text-info"></i></a>
                                        @can('pembiayaan.delete')
                                            @if ($d->no_transaksi == $lasttransaksi->no_transaksi && date('Y-m-d', strtotime($d->created_at)) == date('Y-m-d'))
                                                <form method="POST" class="deleteform m-0"
                                                    action="{{ route('pembiayaan.deletebayar', Crypt::encrypt($d->no_transaksi)) }}">
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
<x-modal-form id="mdlBerita" size="" show="loadmodalberita" title="" />
<x-modal-form id="mdlPembiayaan" size="" show="loadmodalPembiayaan" title="" />
<x-modal-form id="mdlRencanapembiayaan" size="" show="loadrencanapembiayaan" title="" />
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

        $(document).on('click', '#btncreateBayar', function(e) {
            e.preventDefault();
            let no_akad = "{{ Crypt::encrypt($pembiayaan->no_akad) }}";
            $('#mdlPembiayaan').modal("show");
            $("#loadmodalPembiayaan").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlPembiayaan").find(".modal-title").text("Input Pembayaran");
            $("#loadmodalPembiayaan").load("/pembiayaan/" + no_akad + "/createbayar");
        });


        $(document).on('click', '#btnEditrencana', function(e) {
            e.preventDefault();
            let no_akad = "{{ Crypt::encrypt($pembiayaan->no_akad) }}";
            $('#mdlRencanapembiayaan').modal("show");
            $("#loadrencanapembiayaan").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlRencanapembiayaan").find(".modal-title").text("Edit Rencana Pembayaran");
            $("#loadrencanapembiayaan").load("/pembiayaan/" + no_akad + "/editrencana");
        })
    });
</script>
@endpush
