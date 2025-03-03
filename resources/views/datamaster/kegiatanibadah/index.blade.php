@extends('layouts.app')
@section('titlepage', 'Kegiatan Ibadah')

@section('content')
@section('navigasi')
    <span>Kegiatan Ibadah</span>
@endsection
<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('kegiatanibadah.create')
                    <a href="#" class="btn btn-primary" id="btncreateKegiatanIbadah"><i class="fa fa-plus me-2"></i> Tambah
                        Kegiatan Ibadah</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('kegiatanibadah.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Nama Kegiatan Ibadah" value="{{ Request('nama_kegiatan_ibadah') }}"
                                        name="nama_kegiatan_ibadah" icon="ti ti-search" />
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
                                        <th>Kegiatan</th>
                                        <th>Kategori</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatanibadah as $d)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $d->nama_kegiatan }}</td>
                                            <td>{{ $d->kategori_ibadah }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('kegiatanibadah.edit')
                                                        <div>
                                                            <a href="#" class="me-2 editKegiatanIbadah" id="{{ Crypt::encrypt($d->id) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('kegiatanibadah.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('kegiatanibadah.delete', Crypt::encrypt($d->id)) }}">
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
<x-modal-form id="mdlcreateKegiatanIbadah" size="" show="loadcreateKegiatanIbadah" title="Tambah Kegiatan Ibadah" />
<x-modal-form id="mdleditKegiatanIbadah" size="" show="loadeditKegiatanIbadah" title="Edit Kegiatan Ibadah" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateKegiatanIbadah").click(function(e) {
            e.preventDefault();
            $('#mdlcreateKegiatanIbadah').modal("show");
            $("#loadcreateKegiatanIbadah").load('/kegiatanibadah/create');
        });

        $(".editKegiatanIbadah").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditKegiatanIbadah').modal("show");
            $("#loadeditKegiatanIbadah").load('/kegiatanibadah/' + id + '/edit');
        });
    });
</script>
@endpush
