@extends('layouts.app')
@section('titlepage', 'Jobdesk')

@section('content')
@section('navigasi')
    <span>Jobdesk</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('jobdesk.create')
                    <a href="#" class="btn btn-primary" id="btncreateJobdesk"><i class="fa fa-plus me-2"></i> Tambah
                        Jobdesk</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('jobdesk.index') }}">
                            @hasrole(['superadmin', 'pimpinan pesantren', 'sekretaris'])
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
                            @endhasrole
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <x-input-with-icon icon="ti ti-search" label="Job Desk" name="jobdesk_search" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <button class="btn btn-primary w-100"><i class="ti ti-search me-1"></i>Cari</button>
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
                                        <th>No.</th>
                                        <th>Kode Jobdesk</th>
                                        <th style="width: 50%">Jobdesk</th>
                                        <th>Jabatan</th>
                                        <th>Departemen</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobdesk as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->kode_jobdesk }}</td>
                                            <td>{{ removeHtmltag($d->jobdesk) }}</td>
                                            <td>{{ $d->nama_jabatan }}</td>
                                            <td>{{ $d->nama_dept }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('jobdesk.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit" kode_jobdesk="{{ Crypt::encrypt($d->kode_jobdesk) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('jobdesk.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('jobdesk.delete', Crypt::encrypt($d->kode_jobdesk)) }}">
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
<x-modal-form id="mdlJobdesk" size="" show="loadJobdesk" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateJobdesk").click(function(e) {
            e.preventDefault();
            $('#mdlJobdesk').modal("show");
            $("#mdlJobdesk").find(".modal-title").text("Tambah Jobdesk");
            $("#loadJobdesk").load('/jobdesk/create');
        });

        $(".btnEdit").click(function(e) {
            var kode_jobdesk = $(this).attr("kode_jobdesk");
            e.preventDefault();
            $('#mdlJobdesk').modal("show");
            $("#mdlJobdesk").find(".modal-title").text("Edit Jobdesk");
            $("#loadJobdesk").load('/jobdesk/' + kode_jobdesk + '/edit');
        });
    });
</script>
@endpush
