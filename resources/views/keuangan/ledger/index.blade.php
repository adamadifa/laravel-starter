@extends('layouts.app')
@section('titlepage', 'Ledger')

@section('content')
@section('navigasi')
    <span>Ledger</span>
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            @include('layouts.navigation.navigation_ledger')
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                    @can('ledger.create')
                        <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>
                            Input Ledger
                        </a>
                    @endcan

                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="{{ route('ledgertransaksi.index') }}">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-md-12">
                                        <x-input-with-icon label="Dari" value="{{ Request('dari') }}" name="dari" icon="ti ti-calendar"
                                            datepicker="flatpickr-date" />
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12">
                                        <x-input-with-icon label="Sampai" value="{{ Request('sampai') }}" name="sampai" icon="ti ti-calendar"
                                            datepicker="flatpickr-date" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <select name="kode_ledger" id="kode_ledger" class="form-select select2Kodebanksearch">
                                                <option value="">Pilih Ledger</option>
                                                @foreach ($ledger as $d)
                                                    <option {{ Request('kode_ledger') == $d->kode_ledger ? 'selected' : '' }}
                                                        value="{{ $d->kode_ledger }}">{{ $d->nama_ledger }}
                                                        {{ !empty($d->no_rekening) && $d->no_rekening != '-' ? '(' . $d->no_rekening . ')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <button class="btn btn-primary w-100"><i class="ti ti-search me-2"></i>Cari
                                                Data</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mb-2">
                                <table class="table  table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                            <th>#</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">SALDO AWAL</th>
                                            <td class="text-end {{ $saldo_awal == null ? 'bg-danger text-white' : '' }}">
                                                @if ($saldo_awal != null)
                                                    {{ formatAngka($saldo_awal->jumlah - $mutasi->debet + $mutasi->kredit) }}
                                                @else
                                                    BELUM DI SET
                                                @endif
                                            </td>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $saldo = $saldo_awal != null ? $saldo_awal->jumlah - $mutasi->debet + $mutasi->kredit : 0;
                                            $total_debet = 0;
                                            $total_kredit = 0;
                                        @endphp
                                        @foreach ($ledgertransaksi as $d)
                                            @php
                                                $debet = $d->debet_kredit == 'D' ? $d->jumlah : 0;
                                                $kredit = $d->debet_kredit == 'K' ? $d->jumlah : 0;
                                                $saldo = $saldo - $debet + $kredit;
                                                $total_debet += $debet;
                                                $total_kredit += $kredit;
                                            @endphp
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                                <td>{{ $d->keterangan }}</td>
                                                <td class="text-end">{{ $d->debet_kredit == 'D' ? formatAngka($d->jumlah) : '' }} </td>
                                                <td class="text-end">{{ $d->debet_kredit == 'K' ? formatAngka($d->jumlah) : '' }} </td>
                                                <td class="text-end">{{ formatAngka($saldo) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @can('ledgertransaksi.edit')
                                                            <a href="#" class="btnEdit me-1" no_bukti="{{ Crypt::encrypt($d->no_bukti) }}"><i
                                                                    class="ti ti-edit text-success"></i>
                                                            </a>
                                                        @endcan
                                                        @can('ledgertransaksi.delete')
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('ledgertransaksi.delete', Crypt::encrypt($d->no_bukti)) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="delete-confirm ml-1">
                                                                    <i class="ti ti-trash text-danger"></i>
                                                                </a>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-dark">
                                        <tr>
                                            <th colspan="2" class="font-bold">TOTAL</th>
                                            <th class="text-end font-bold">{{ formatAngka($total_debet) }}</th>
                                            <th class="text-end font-bold">{{ formatAngka($total_kredit) }}</th>
                                            <th class="text-end font-bold">{{ formatAngka($saldo) }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="modal" size="modal-lg" show="loadmodal" title="" />
<x-modal-form id="modalEdit" show="loadmodalEdit" title="" />

@endsection
@push('myscript')
<script>
    $(function() {

        function loading() {
            $("#loadmodal,#loadmodalEdit").html(`<div class="sk-wave sk-primary" style="margin:auto">
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            </div>`);
        };

        const select2Kodebanksearch = $('.select2Kodebanksearch');
        if (select2Kodebanksearch.length) {
            select2Kodebanksearch.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Pilih  Ledger',
                    allowClear: true,
                    dropdownParent: $this.parent()
                });
            });
        }

        $("#btnCreate").click(function(e) {
            e.preventDefault();
            loading();
            $("#modal").modal("show");
            $("#modal").find(".modal-title").text('Input Ledger');
            $("#loadmodal").load('/ledgertransaksi/create');
        });

        $(".btnEdit").click(function(e) {
            e.preventDefault();
            loading();
            const no_bukti = $(this).attr('no_bukti');
            $("#modalEdit").modal("show");
            $("#modalEdit").find(".modal-title").text('Edit Ledger');
            $("#modalEdit").find("#loadmodalEdit").load(`/ledgertransaksi/${no_bukti}/edit`);
        });

    });
</script>
@endpush
