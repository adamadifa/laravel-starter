@extends('layouts.app')
@section('titlepage', 'Jenis Tabungan')

@section('content')
@section('navigasi')
    <span>Jenis Tabungan</span>
@endsection
<div class="row">
    <div class="col-lg-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('jenistabungan.create')
                    <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>Tambah Jenis Tabungan</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ URL::current() }}">
                            <x-input-with-icon label="Cari Jenis Tabungan" value="{{ Request('jenis_tabungan_search') }}" name="jenis_tabungan_search"
                                icon="ti ti-search" />
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
                                        <th>Jenis Tabungan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenistabungan as $d)
                                        <tr>
                                            <td>{{ $d->kode_tabungan }}</td>
                                            <td>{{ $d->jenis_tabungan }} </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('jenistabungan.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit"
                                                                kode_tabungan="{{ Crypt::encrypt($d->kode_tabungan) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('jenistabungan.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('jenistabungan.delete', Crypt::encrypt($d->kode_tabungan)) }}">
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
                {{ $jenistabungan->links() }}
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
            $(".modal-title").text("Tambah Data Jenis Tabungan");
            $("#loadmodal").load("{{ route('jenistabungan.create') }}");
        });

        $(".btnEdit").click(function(e) {
            e.preventDefault();
            const kode_tabungan = $(this).attr('kode_tabungan')
            $('#modal').modal("show");
            $(".modal-title").text("Edit Jenis Tabungan");
            $("#loadmodal").load(`/jenistabungan/${kode_tabungan}/edit`);
        });
    });
</script>
@endpush
