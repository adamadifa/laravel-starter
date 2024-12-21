@extends('layouts.app')
@section('titlepage', 'Agenda Kegiatan')

@section('content')
@section('navigasi')
    <span>Agenda Kegiatan</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('agendakegiatan.create')
                    <a href="#" class="btn btn-primary" id="btncreateAgendaKegiatan"><i class="fa fa-plus me-2"></i> Tambah
                        Agenda Kegiatan</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('agendakegiatan.index') }}">
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
                                        <th style="width: 1%">No.</th>
                                        <th style="width: 10%">Tanggal</th>
                                        <th>Uraian Kegiatan</th>

                                        <th style="width: 5%">Dept</th>
                                        <th style="width: 10%">User</th>
                                        <th style="width: 5%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agenda_kegiatan as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                            <td>{{ strip_tags($d->uraian_kegiatan) }}</td>

                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ formatNama($d->name) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('agendakegiatan.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit" id="{{ Crypt::encrypt($d->id) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('agendakegiatan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('agendakegiatan.delete', Crypt::encrypt($d->id)) }}">
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
<x-modal-form id="mdlcreateAgendaKegiatan" size="" show="loadcreateAgendaKegiatan" title="Tambah Agenda Kegiatan" />
<x-modal-form id="mdleditAgendaKegiatan" size="" show="loadeditAgendaKegiatan" title="Edit Agenda Kegiatan" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateAgendaKegiatan").click(function(e) {
            e.preventDefault();
            $('#mdlcreateAgendaKegiatan').modal("show");
            $("#loadcreateAgendaKegiatan").load('/agendakegiatan/create');
        });

        $(".btnEdit").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditAgendaKegiatan').modal("show");
            $("#loadeditAgendaKegiatan").load('/agendakegiatan/' + id + '/edit');
        });
    });
</script>
@endpush
