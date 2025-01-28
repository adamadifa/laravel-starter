@extends('layouts.app')
@section('titlepage', 'Data Tabungan Koperasi')

@section('content')
@section('navigasi')
    <span>Data Tabungan</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary" id="btncreateRekening"><i class="fa fa-plus me-2"></i> Buat Rekening</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ URL::current() }}">
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
                                        <th>No. Rekening</th>
                                        <th>No. Anggota</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kode</th>
                                        <th>Jenis Tabungan</th>
                                        <th>Saldo</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tabungan) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif
                                    @foreach ($tabungan as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration + $tabungan->firstItem() - 1 }}</td>
                                            <td class="">{{ $d->no_rekening }}</td>
                                            <td class="">{{ $d->no_anggota }}</td>
                                            <td><a href="">{{ $d->nama_lengkap }}</a></td>
                                            <td>{{ $d->kode_tabungan }}</td>
                                            <td>{{ $d->jenis_tabungan }}</td>
                                            <td class="text-end">{{ formatAngka($d->saldo) }}</td>
                                            <td class="table-report__action w-56">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @can('tabungan.index')
                                                        <a href="{{ route('tabungan.show', Crypt::encrypt($d->no_rekening)) }}">
                                                            <i class="ti ti-book"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="float: right;">
                            {{ $tabungan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlRekening" size="" show="loadmodalRekening" title="" />
<div class="modal fade" id="mdlAnggota" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Data Anggota</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="tabelanggota">
                    <thead class="table-dark">
                        <tr>
                            <th>No. Anggota</th>
                            <th>NIK</th>
                            <th>NAMA LENGKAP</th>
                            <th>No. HP</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function() {
        $(document).on('show.bs.modal', '.modal', function() {
            const zIndex = 1090 + 10 * $('.modal:visible').length;
            $(this).css('z-index', zIndex);
            setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1)
                .addClass('modal-stack'));
        });

        $("#btncreateRekening").click(function() {
            $('#mdlRekening').modal("show");
            $("#loadmodalRekening").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
            $("#mdlRekening").find(".modal-title").text("Buat Rekening");
            $("#loadmodalRekening").load("{{ route('tabungan.createrekening') }}");
        });

        $(document).on('click', '#no_anggota_search', function() {
            $('#mdlAnggota').modal("show");
        })


        $('#tabelanggota').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url()->current() }}', // memanggil route yang menampilkan data json
            columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                    data: 'no_anggota',
                    name: 'no_anggota'
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],

        });
    });
</script>
@endpush
