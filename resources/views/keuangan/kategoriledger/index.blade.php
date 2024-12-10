@extends('layouts.app')
@section('titlepage', 'Kategori Ledger')

@section('content')
@section('navigasi')
    <span>Kategori Ledger</span>
@endsection
<div class="row">
    <div class="col-lg-6">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            @include('layouts.navigation.navigation_ledger')
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                    @can('kategoriledger.create')
                        <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>
                            Tambah Kategori
                        </a>
                    @endcan
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="{{ route('kategoriledger.index') }}">
                                <div class="row">
                                    <div class="col-lg-10 col-sm-12 col-md-12">
                                        <x-input-with-icon label="Nama Kategori Ledger" value="{{ Request('nama_kategori_ledger') }}"
                                            name="nama_kategori_ledger" icon="ti ti-search" />
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
                                            <th>Nama Kategori</th>
                                            <th>Jenis Kategori</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $jenis_kategori = ['PM' => 'Pemasukan', 'PK' => 'Pengeluaran'];
                                        @endphp
                                        @foreach ($kategoriledger as $k)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $k->nama_kategori }}</td>
                                                <td>{{ strtoUpper($jenis_kategori[$k->jenis_kategori]) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @can('kategoriledger.edit')
                                                            <div>
                                                                <a href="#" class="me-2 btnEdit" id="{{ $k->id }}">
                                                                    <i class="ti ti-edit text-success"></i>
                                                                </a>
                                                            </div>
                                                        @endcan

                                                        @can('kategoriledger.delete')
                                                            <div>
                                                                <form method="POST" name="deleteform" class="deleteform"
                                                                    action="{{ route('kategoriledger.delete', $k->id) }}">
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
</div>
<x-modal-form id="modal" size="" show="loadmodal" title="" />
<x-modal-form id="modalEdit" show="loadmodalEdit" title="" />

@endsection
@push('myscript')
<script>
    $(function() {
        $("#btnCreate").click(function(e) {
            e.preventDefault();
            $("#modal").modal("show");
            $(".modal-title").text("Tambah Data Kategori Ledger");
            $("#loadmodal").html(`<div class="sk-wave sk-primary" style="margin:auto">
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            </div>`);
            $("#loadmodal").load("{{ route('kategoriledger.create') }}");
        })

        $(".btnEdit").click(function(e) {
            e.preventDefault();
            let id = $(this).attr("id");
            $("#modalEdit").modal("show");
            $(".modal-title").text("Edit Data Kategori Ledger");
            $("#loadmodalEdit").html(`<div class="sk-wave sk-primary" style="margin:auto">
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            </div>`);
            $("#loadmodalEdit").load(`/kategoriledger/${id}/edit`);
        })
    });
</script>
@endpush
