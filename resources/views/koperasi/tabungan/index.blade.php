@extends('layouts.app')
@section('titlepage', 'Data Tabungan Koperasi')

@section('content')
@section('navigasi')
    <span>Data Tabungan</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
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
<x-modal-form id="mdlAnggota" size="modal-lg" show="loadmodalAnggota" title="" />

@endsection
