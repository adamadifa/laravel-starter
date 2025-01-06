@extends('layouts.app')
@section('titlepage', 'Program Kerja')

@section('content')
@section('navigasi')
    <span>Program Kerja</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('agendakegiatan.create')
                    <a href="#" class="btn btn-primary" id="btncreateProgramKerja"><i class="fa fa-plus me-2"></i> Tambah
                        Program Kerja</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('programkerja.index') }}">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12 col-md-12">
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
                                <div class="col-lg-3 col-sm-12 col-md-12">
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
                                    <div class="form-group">
                                        <select name="kode_ta" id="kode_ta" class="form-select select2Kodeta">
                                            <option value="">Tahun Ajaran</option>
                                            @foreach ($tahunajaran as $d)
                                                <option value="{{ $d->kode_ta }}" {{ Request('kode_ta') == $d->kode_ta ? 'selected' : '' }}>
                                                    {{ $d->tahun_ajaran }}</option>
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
                                        <th style="width: 1%">No.</th>
                                        <th>Program Kerja</th>
                                        <th>Target Pencapaian</th>
                                        <th style="width: 10%">Tanggal</th>
                                        <th style="width: 5%">Dept</th>
                                        <th style="width: 10%">User</th>
                                        <th style="width: 5%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programkerja as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->program_kerja }}</td>
                                            <td>{{ strip_tags($d->target_pencapaian) }}</td>
                                            <td>{{ $d->tanggal_pelaksanaan }}</td>
                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ formatNama($d->name) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('programkerja.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit" id="{{ Crypt::encrypt($d->kode_program_kerja) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('agendakegiatan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('programkerja.delete', Crypt::encrypt($d->kode_program_kerja)) }}">
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
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlProgramkerja" size="" show="loadProgramkerja" title="" />

@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateProgramKerja").click(function(e) {
            e.preventDefault();
            $('#mdlProgramkerja').modal("show");
            $("#mdlProgramkerja").find(".modal-title").text("Tambah Program Kerja");
            $("#loadProgramkerja").load('/programkerja/create');
        });

        $(".btnEdit").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdlProgramkerja').modal("show");
            $("#mdlProgramkerja").find(".modal-title").text("Edit Program Kerja");
            $("#loadProgramkerja").load('/programkerja/' + id + '/edit');
        });
    });
</script>
@endpush
