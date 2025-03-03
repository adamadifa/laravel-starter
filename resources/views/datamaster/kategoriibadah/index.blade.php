@extends('layouts.app')
@section('titlepage', 'Kategori Ibadah')

@section('content')
@section('navigasi')
    <span>Kategori Ibadah</span>
@endsection
<div class="row">
    <div class="col-lg-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('kategoriibadah.create')
                    <a href="#" class="btn btn-primary" id="btncreateKategoriIbadah"><i class="fa fa-plus me-2"></i> Tambah
                        Kategori Ibadah</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('kategoriibadah.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Nama Kategori Ibadah" value="{{ Request('nama_kategori_ibadah') }}"
                                        name="nama_kategori_ibadah" icon="ti ti-search" />
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
                                        <th>Kategori</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriibadah as $d)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $d->kategori_ibadah }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('kategoriibadah.edit')
                                                        <div>
                                                            <a href="#" class="me-2 editKategoriIbadah" id="{{ Crypt::encrypt($d->id) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('kategoriibadah.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('kategoriibadah.delete', Crypt::encrypt($d->id)) }}">
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
<x-modal-form id="mdlcreateKategoriIbadah" size="" show="loadcreateKategoriIbadah" title="Tambah Kategori Ibadah" />
<x-modal-form id="mdleditKategoriIbadah" size="" show="loadeditKategoriIbadah" title="Edit Kategori Ibadah" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateKategoriIbadah").click(function(e) {
            e.preventDefault();
            $('#mdlcreateKategoriIbadah').modal("show");
            $("#loadcreateKategoriIbadah").load('/kategoriibadah/create');
        });

        $(".editKategoriIbadah").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditKategoriIbadah').modal("show");
            $("#loadeditKategoriIbadah").load('/kategoriibadah/' + id + '/edit');
        });
    });
</script>
@endpush
