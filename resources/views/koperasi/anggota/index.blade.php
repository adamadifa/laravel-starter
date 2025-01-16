@extends('layouts.app')
@section('titlepage', 'Anggota Koperasi')

@section('content')
@section('navigasi')
    <span>Anggota Koperasi</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('anggota.create')
                    <a href="#" class="btn btn-primary" id="btncreateAnggota"><i class="fa fa-plus me-2"></i> Tambah
                        Anggota Koperasi</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('anggota.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Cari Nama Anggota Koperasi" value="{{ Request('nama_lengkap') }}" name="nama_lengkap"
                                        icon="ti ti-search" />
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
                                        <th>NO</th>
                                        <th>No. Anggota</th>
                                        <th>NIK</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>TTL</th>
                                        <th>No. HP</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($anggota) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif
                                    @foreach ($anggota as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration + $anggota->firstItem() - 1 }}</td>
                                            <td class="">{{ $d->no_anggota }}</td>
                                            <td class="">{{ $d->nik }}</td>
                                            <td><a href="">{{ $d->nama_lengkap }}</a></td>
                                            <td>{{ $d->tempat_lahir }}, {{ $d->tanggal_lahir }}</td>
                                            <td>{{ $d->no_hp }}</td>
                                            <td class="table-report__action w-56">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @can('anggota.edit')
                                                        <a href="#" class="btnEditAnggota me-1" no_anggota="{{ Crypt::encrypt($d->no_anggota) }}"><i
                                                                class="ti ti-edit"></i>
                                                        </a>
                                                    @endcan

                                                    <a class="me-1" href="{{ route('anggota.show', Crypt::encrypt($d->no_anggota)) }}"><i
                                                            class="ti ti-file-description text-info"></i></a>
                                                    @can('anggota.delete')
                                                        <form method="POST" class="deleteform"
                                                            action="{{ route('anggota.delete', Crypt::encrypt($d->no_anggota)) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="delete-confirm ml-1">
                                                                <i class="ti ti-trash text-danger"></i>
                                                            </a>
                                                        </form>
                                                    @endcan

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="float: right;">
                            {{-- {{ $anggota->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlAnggota" size="modal-lg" show="loadmodalAnggota" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateAnggota").click(function(e) {
            e.preventDefault();
            $('#mdlAnggota').modal("show");
            $("#loadmodalAnggota").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#modalAnggota").find(".modal-title").text("Tambah Anggota Koperasi");
            $("#loadmodalAnggota").load('/anggota/create');
        });

        $(".btnEditAnggota").click(function(e) {
            var no_anggota = $(this).attr("no_anggota");
            e.preventDefault();
            $('#mdlAnggota').modal("show");
            $("#loadmodalAnggota").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#modalAnggota").find(".modal-title").text("Edit Anggota Koperasi");
            $("#loadmodalAnggota").load('/anggota/' + no_anggota + '/edit');
        });
    });
</script>
@endpush
