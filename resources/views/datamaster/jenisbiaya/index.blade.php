@extends('layouts.app')
@section('titlepage', 'Jenis Biaya')

@section('content')
@section('navigasi')
<span>Jenis Biaya</span>
@endsection
<div class="row">
    <div class="col-lg-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('jenisbiaya.create')
                <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i>Tambah Jenis Biaya</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Jenis Biaya</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenisbiaya as $d)
                                    <tr>
                                        <td>{{ $d->kode_jenis_biaya }}</td>
                                        <td>{{ $d->jenis_biaya }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @can('jenisbiaya.edit')
                                                <div>
                                                    <a href="#" class="me-2 btnEdit"
                                                        kode_jenis_biaya="{{ Crypt::encrypt($d->kode_jenis_biaya) }}">
                                                        <i class="ti ti-edit text-success"></i>
                                                    </a>
                                                </div>
                                                @endcan

                                                @can('jenisbiaya.delete')
                                                <div>
                                                    <form method="POST" name="deleteform" class="deleteform"
                                                        action="{{ route('jenisbiaya.delete', Crypt::encrypt($d->kode_jenis_biaya)) }}">
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
<x-modal-form id="modal" size="" show="loadmodal" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btnCreate").click(function(e) {
            e.preventDefault();
            $('#modal').modal("show");
            $(".modal-title").text("Tambah Data Jenis Biaya");
            $("#loadmodal").load("{{ route('jenisbiaya.create') }}");
        });

        $(".btnEdit").click(function(e) {
            e.preventDefault();
            const kode_jenis_biaya = $(this).attr('kode_jenis_biaya')
            $('#modal').modal("show");
            $(".modal-title").text("Edit Jenis Biaya");
            $("#loadmodal").load(`/jenisbiaya/${kode_jenis_biaya}/edit`);
        });
    });
</script>
@endpush