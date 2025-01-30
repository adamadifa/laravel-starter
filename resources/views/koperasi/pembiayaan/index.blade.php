@extends('layouts.app')
@section('titlepage', 'Data Pembiayaan Koperasi')

@section('content')
@section('navigasi')
    <span>Data Pembiayaan</span>
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
                                        <th>NO</th>
                                        <th>No. Akad</th>
                                        <th>Tanggal</th>
                                        <th>No. Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th>Jenis Pembiayaan</th>
                                        <th>Pokok</th>
                                        <th>Pembiayaan</th>
                                        <th>#</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($pembiayaan) == 0)
                                        <tr>
                                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif
                                    @foreach ($pembiayaan as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration + $pembiayaan->firstItem() - 1 }}</td>
                                            <td class="">{{ $d->no_akad }}</td>
                                            <td class="">{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                            <td class="">{{ $d->no_anggota }}</td>
                                            <td>{{ $d->nama_lengkap }}</td>
                                            <td>{{ $d->jenis_pembiayaan }}</td>
                                            <td class="text-end">{{ formatAngka($d->jumlah) }}</td>
                                            <td class="text-end">
                                                @php
                                                    $jumlah_pembiayaan = $d->jumlah + $d->jumlah * ($d->persentase / 100);
                                                @endphp
                                                {{ formatAngka($jumlah_pembiayaan) }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('tabungan.index')
                                                        <a href="{{ route('pembiayaan.show', Crypt::encrypt($d->no_akad)) }}" class="me-1">
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
                            {{ $pembiayaan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlAnggota" size="modal-lg" show="loadmodalAnggota" title="" />

@endsection
