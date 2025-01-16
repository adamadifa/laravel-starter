@extends('layouts.app')
@section('titlepage', 'Jenis Pembiayaan')

@section('content')
@section('navigasi')
    <span>Jenis Pembiayaan</span>
@endsection
<div class="row">
    <div class="col-lg-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('jenispembiayaan.create')
                    <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>Tambah Jenis Pembiayaan</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ URL::current() }}">
                            <x-input-with-icon label="Cari Jenis Pembiayaan" value="{{ Request('jenis_pembiayaan_search') }}"
                                name="jenis_pembiayaan_search" icon="ti ti-search" />
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Jenis Pembiayaan</th>
                                        <th>Persentase</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenispembiayaan as $d)
                                        <tr>
                                            <td>{{ $d->kode_pembiayaan }}</td>
                                            <td>{{ $d->jenis_pembiayaan }} </td>
                                            <td class="text-center">{{ $d->persentase }} % </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('jenispembiayaan.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit"
                                                                kode_pembiayaan="{{ Crypt::encrypt($d->kode_pembiayaan) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('jenispembiayaan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('jenispembiayaan.delete', Crypt::encrypt($d->kode_pembiayaan)) }}">
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
                {{ $jenispembiayaan->links() }}
            </div>
        </div>
    </div>
</div>
<x-modal-form id="modal" size="" show="loadmodal" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btnCreate").click(function(e) {
            e.preventDefault();
            $('#modal').modal("show");
            $(".modal-title").text("Tambah Data Jenis Pembiayaan");
            $("#loadmodal").load("{{ route('jenispembiayaan.create') }}");
        });

        $(".btnEdit").click(function(e) {
            e.preventDefault();
            const kode_pembiayaan = $(this).attr('kode_pembiayaan')
            $('#modal').modal("show");
            $(".modal-title").text("Edit Jenis Pembiayaan");
            $("#loadmodal").load(`/jenispembiayaan/${kode_pembiayaan}/edit`);
        });
    });
</script>
@endpush
