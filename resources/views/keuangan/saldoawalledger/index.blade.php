@extends('layouts.app')
@section('titlepage', 'Saldo Awal Ledger')

@section('content')
@section('navigasi')
    <span>Saldo Awal Ledger</span>
@endsection
<div class="row">
    <div class="col-lg-8">
        <div class="nav-align-top nav-tabs-shadow mb-4">
            @include('layouts.navigation.navigation_ledger')
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                    @can('saldoawalledger.create')
                        <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>
                            Buat Saldo Awal
                        </a>
                    @endcan
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="{{ URL::current() }}">
                                <div class="row">
                                    <div class="col-lg-5 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <select name="kode_ledger_search" id="kode_ledger_search" class="form-select select2Kodeledger">
                                                <option value="">Pilih Ledger</option>
                                                @foreach ($ledger as $d)
                                                    <option value="{{ $d->kode_ledger }}">{{ $d->nama_ledger }}
                                                        {{ !empty($d->no_rekening) && $d->no_rekening != '-' ? '(' . $d->no_rekening . ')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <select name="bulan" id="bulan" class="form-select">
                                                <option value="">Bulan</option>
                                                @foreach ($list_bulan as $d)
                                                    <option {{ Request('bulan') == $d['kode_bulan'] ? 'selected' : '' }}
                                                        value="{{ $d['kode_bulan'] }}">{{ $d['nama_bulan'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <select name="tahun" id="tahun" class="form-select">
                                                <option value="">Tahun</option>
                                                @for ($t = $start_year; $t <= date('Y'); $t++)
                                                    <option
                                                        @if (!empty(Request('tahun'))) {{ Request('tahun') == $t ? 'selected' : '' }}
                                                        @else
                                                        {{ date('Y') == $t ? 'selected' : '' }} @endif
                                                        value="{{ $t }}">{{ $t }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 col-md-12">
                                        <button class="btn btn-primary"><i class="ti ti-icons ti-search me-1"></i></button>
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
                                            <th>Kode</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Ledger</th>
                                            <th>Jumlah</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saldo_awal as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->kode_ledger }}</td>
                                                <td>{{ $listbulan[$d->bulan] }}</td>
                                                <td>{{ $d->tahun }}</td>
                                                <td>{{ $d->nama_ledger }}
                                                    {{ !empty($d->no_rekening) && $d->no_rekening != '-' ? '(' . $d->no_rekening . ')' : '' }}
                                                </td>
                                                <td class="text-end">{{ formatAngka($d->jumlah) }}</td>

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
            $(".modal-title").text("Buat Saldo Awal Ledger");
            $("#loadmodal").html(`<div class="sk-wave sk-primary" style="margin:auto">
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            </div>`);
            $("#loadmodal").load("{{ route('saldoawalledger.create') }}");
        })

        // $(".btnEdit").click(function(e) {
        //     e.preventDefault();
        //     let id = $(this).attr("id");
        //     $("#modalEdit").modal("show");
        //     $(".modal-title").text("Edit Data Saldo Awal Ledger");
        //     $("#loadmodalEdit").html(`<div class="sk-wave sk-primary" style="margin:auto">
        //     <div class="sk-wave-rect"></div>
        //     <div class="sk-wave-rect"></div>
        //     <div class="sk-wave-rect"></div>
        //     <div class="sk-wave-rect"></div>
        //     <div class="sk-wave-rect"></div>
        //     </div>`);
        //     $("#loadmodalEdit").load(`/saldoawalledger/${id}/edit`);
        // });


        const select2Kodeledger = $('.select2Kodeledger');
        if (select2Kodeledger.length) {
            select2Kodeledger.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Pilih  Ledger',
                    allowClear: true,
                    dropdownParent: $this.parent()
                });
            });
        }
    });
</script>
@endpush
