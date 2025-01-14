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
                                        <th>No.</th>
                                        <th>NPP</th>
                                        <th>Nama Anggota Koperasi</th>
                                        <th>Jabatan</th>
                                        <th>Unit</th>
                                        <th>TMT</th>
                                        <th>No. HP</th>
                                        <th>Foto</th>
                                        <th>PIN</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>

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
<x-modal-form id="mdlAnggota" size="" show="loadmodalAnggota" title="" />
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

        $(".editAnggota").click(function(e) {
            var npp = $(this).attr("npp");
            e.preventDefault();
            $('#mdleditAnggota').modal("show");
            $("#loadeditAnggota").load('/anggota/' + npp + '/edit');
        });
    });
</script>
@endpush
