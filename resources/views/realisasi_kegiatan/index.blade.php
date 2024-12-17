@extends('layouts.app')
@section('titlepage', 'Realisasi Kegiatan')

@section('content')
@section('navigasi')
    <span>Realisasi Kegiatan</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('realkegiatan.create')
                    <a href="#" class="btn btn-primary" id="btncreateRealisasiKegiatan"><i class="fa fa-plus me-2"></i> Tambah
                        Realisasi Kegiatan</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('realisasikegiatan.index') }}">
                            <div class="row">
                                <div class="col-lg-5 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <select name="kode_jabatan" id="kode_jabatan" class="form-select select2Kodejabatansearch">
                                            <option value="">Jabatan</option>
                                            @foreach ($jabatan as $d)
                                                <option value="{{ $d->kode_jabatan }}"
                                                    {{ Request('kode_jabatan') == $d->kode_jabatan ? 'selected' : '' }}>
                                                    {{ strtoUpper($d->nama_jabatan) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <select name="kode_dept" id="kode_dept" class="form-select select2Kodedeptsearc">
                                            <option value="">Departemen</option>
                                            @foreach ($departemen as $d)
                                                <option value="{{ $d->kode_dept }}" {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}>
                                                    {{ strtoUpper($d->nama_dept) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                    <button class="btn btn-primary">Cari</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Uraian Kegiatan</th>
                                        <th>Jobdesk</th>
                                        <th>Departemen</th>
                                        <th>User</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($realisasikegiatan as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ DateToIndo($d->tanggal) }}</td>
                                            <td>{!! $d->uraian_kegiatan !!}</td>
                                            <td>{{ $d->jobdesk }}</td>
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
<x-modal-form id="mdlcreateRealisasiKegiatan" size="" show="loadcreateRealisasiKegiatan" title="Tambah Realisasi Kegiatan" />
<x-modal-form id="mdleditRealisasiKegiatan" size="" show="loadeditRealisasiKegiatan" title="Edit Realisasi Kegiatan" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateRealisasiKegiatan").click(function(e) {
            e.preventDefault();
            $('#mdlcreateRealisasiKegiatan').modal("show");
            $("#loadcreateRealisasiKegiatan").load('/realisasikegiatan/create');
        });

        $(".btnEdit").click(function(e) {
            var kode_realisasikegiatan = $(this).attr("kode_realisasikegiatan");
            e.preventDefault();
            $('#mdleditRealisasiKegiatan').modal("show");
            $("#loadeditRealisasiKegiatan").load('/realisasikegiatan/' + kode_realisasikegiatan + '/edit');
        });
    });
</script>
@endpush
