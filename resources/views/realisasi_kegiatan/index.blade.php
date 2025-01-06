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
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Dari" value="{{ Request('dari') }}" name="dari" icon="ti ti-calendar"
                                        datepicker="flatpickr-date" />
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Sampai" value="{{ Request('sampai') }}" name="sampai" icon="ti ti-calendar"
                                        datepicker="flatpickr-date" />
                                </div>
                            </div>
                            @if ($user->hasRole('super admin'))
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-12">
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
                                    <div class="col-lg-6 col-sm-12 col-md-12">
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
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <button class="btn btn-primary w-100"><i class="ti ti-search me-2"></i>Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 1%">No.</th>
                                        <th style="width: 10%">Tanggal</th>
                                        <th style="width: 20%">Uraian Kegiatan</th>
                                        <th style="width: 30%">Uraian Kegiatan</th>
                                        <th style="width: 29%">Jobdesk</th>
                                        <th style="width: 5%">Dept</th>
                                        <th style="width: 10%">User</th>
                                        <th style="width: 5%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($realisasikegiatan as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                            <td>{{ removeHtmltag($d->nama_kegiatan) }}</td>
                                            <td>{{ removeHtmltag($d->uraian_kegiatan) }}</td>
                                            <td>{{ $d->jobdesk }}</td>
                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ formatNama1($d->name) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('realkegiatan.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit" id="{{ Crypt::encrypt($d->id) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('realkegiatan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('realisasikegiatan.delete', Crypt::encrypt($d->id)) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="delete-confirm ml-1">
                                                                    <i class="ti ti-trash text-danger"></i>
                                                                </a>
                                                            </form>
                                                        </div>
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
                <div class="row">
                    <div class="col-12">
                        {{ $realisasikegiatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<x-modal-form id="mdlRealisasiKegiatan" size="" show="loadRealisasiKegiatan" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateRealisasiKegiatan").click(function(e) {
            e.preventDefault();
            $('#mdlRealisasiKegiatan').modal("show");
            $("#mdlRealisasiKegiatan").find(".modal-title").text("Tambah Realisasi Kegiatan");
            $("#loadRealisasiKegiatan").load('/realisasikegiatan/create');
        });

        $(".btnEdit").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdlRealisasiKegiatan').modal("show");
            $("#mdlRealisasiKegiatan").find(".modal-title").text("Edit Realisasi Kegiatan");
            $("#loadRealisasiKegiatan").load('/realisasikegiatan/' + id + '/edit');
        });
    });
</script>
@endpush
