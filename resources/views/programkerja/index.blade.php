@extends('layouts.app')
@section('titlepage', 'Program Kerja')

@section('content')
@section('navigasi')
    <span>Program Kerja</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    @can('agendakegiatan.create')
                        <a href="#" class="btn btn-primary" id="btncreateProgramKerja"><i class="fa fa-plus me-2"></i> Tambah
                            Program Kerja</a>
                    @endcan

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('programkerja.index') }}" id="myForm">

                            @if ($user->hasRole(['super admin', 'pimpinan pesantren', 'sekretaris']))
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
                                    <div class="form-group">
                                        <select name="kode_ta" id="kode_ta" class="form-select select2Kodeta">
                                            <option value="">Tahun Ajaran</option>
                                            @foreach ($tahunajaran as $d)
                                                <option value="{{ $d->kode_ta }}"
                                                    {{ Request('kode_ta') == $d->kode_ta || $ta_aktif->kode_ta == $d->kode_ta ? 'selected' : '' }}>
                                                    {{ $d->tahun_ajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-input-with-icon icon="ti ti-search" label="Job Desk" name="programkerja_search" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 col-sm-12 col-md-12 ">
                                    <button class="btn btn-primary w-100" type="submit" value="1" name="cari"><i class="ti ti-search"></i>
                                        Cari</button>
                                </div>
                                <div class="col-lg-1 col-sm-12 col-md-12">
                                    <button class="btn btn-warning" type="submit" value="1" name="cetak" id="cetakButton"><i
                                            class="ti ti-printer me-1"></i>
                                        Cetak
                                    </button>
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
                                        <th>Program Kerja</th>
                                        <th>Target Pencapaian</th>
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
                                            <td>{{ removeHtmltag($d->target_pencapaian) }}</td>
                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ formatNama1($d->name) }}</td>
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
    document.getElementById('cetakButton').addEventListener('click', function(e) {
        e.preventDefault();
        // Ambil data form
        const form = document.getElementById('myForm');
        const formData = new FormData(form);
        const url = "{{ URL::current() }}";
        // URL tujuan untuk cetak
        const printUrl = url + '?' + new URLSearchParams(formData).toString() + '&cetak=1';

        // Buka tab baru untuk cetak
        window.open(printUrl, '_blank');
    });
</script>
<script>
    $(function() {
        $("#btncreateProgramKerja").click(function(e) {
            e.preventDefault();
            $('#mdlProgramkerja').modal("show");
            $("#mdlProgramkerja").find(".modal-title").text("Tambah Program Kerja {{ $ta_aktif->tahun_ajaran }}");
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
