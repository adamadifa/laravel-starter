@extends('layouts.app')
@section('titlepage', 'Ledger')

@section('content')
@section('navigasi')
    <span>Ledger</span>
@endsection
<div class="row">
    <div class="col-lg-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('ledger.create')
                    <a href="#" class="btn btn-primary" id="btncreateLedger"><i class="fa fa-plus me-2"></i> Tambah
                        Ledger</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('ledger.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Nama Ledger" value="{{ Request('nama_ledger') }}" name="nama_ledger"
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
                                        <th>Kode Ledger</th>
                                        <th>Nama Ledger</th>
                                        <th>No Rekening</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ledger as $l)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $l->kode_ledger }}</td>
                                            <td>{{ $l->nama_ledger }}</td>
                                            <td>{{ $l->no_rekening }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('ledger.edit')
                                                        <div>
                                                            <a href="#" class="me-2 editLedger" kode_ledger="{{ Crypt::encrypt($l->kode_ledger) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('ledger.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('ledger.delete', Crypt::encrypt($l->kode_ledger)) }}">
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
<x-modal-form id="mdlcreateLedger" size="" show="loadcreateLedger" title="Tambah Ledger" />
<x-modal-form id="mdleditLedger" size="" show="loadeditLedger" title="Edit Ledger" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateLedger").click(function(e) {
            e.preventDefault();
            $('#mdlcreateLedger').modal("show");
            $("#loadcreateLedger").load('/ledger/create');
        });

        $(".editLedger").click(function(e) {
            var kode_ledger = $(this).attr("kode_ledger");
            e.preventDefault();
            $('#mdleditLedger').modal("show");
            $("#loadeditLedger").load('/ledger/' + kode_ledger + '/edit');
        });
    });
</script>
@endpush
