@extends('layouts.app')
@section('titlepage', 'Departemen')

@section('content')
@section('navigasi')
    <span>Departemen</span>
@endsection
<div class="row">
    <div class="col-lg-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('departemen.create')
                    <a href="#" class="btn btn-primary" id="btncreateDepartemen"><i class="fa fa-plus me-2"></i> Tambah
                        Departemen</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('departemen.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Nama Departemen" value="{{ Request('nama_departemen_search') }}"
                                        name="nama_departemen_search" icon="ti ti-search" />
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
                                        <th>Kode Departemen</th>
                                        <th>Nama Departemen</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemen as $d)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ $d->nama_dept }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('departemen.edit')
                                                        <div>
                                                            <a href="#" class="me-2 editDepartemen"
                                                                kode_departemen="{{ Crypt::encrypt($d->kode_dept) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('departemen.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('departemen.delete', Crypt::encrypt($d->kode_dept)) }}">
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
<x-modal-form id="mdlcreateDepartemen" size="" show="loadcreateDepartemen" title="Tambah Departemen" />
<x-modal-form id="mdleditDepartemen" size="" show="loadeditDepartemen" title="Edit Departemen" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateDepartemen").click(function(e) {
            e.preventDefault();
            $('#mdlcreateDepartemen').modal("show");
            $("#loadcreateDepartemen").load('/departemen/create');
        });

        $(".editDepartemen").click(function(e) {
            var kode_departemen = $(this).attr("kode_departemen");
            e.preventDefault();
            $('#mdleditDepartemen').modal("show");
            $("#loadeditDepartemen").load('/departemen/' + kode_departemen + '/edit');
        });
    });
</script>
@endpush
