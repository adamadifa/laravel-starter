@extends('layouts.app')
@section('titlepage', 'Jam Kerja')

@section('content')
@section('navigasi')
    <span>Jam Kerja</span>
@endsection
<div class="row">
    <div class="col-lg-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                @can('unit.create')
                    <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i> Buat
                        Jam Kerja</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Jam Kerja</th>
                                        <th>Nama Jam Kerja</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Total Jam</th>
                                        <th>Lintas Hari</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jamkerja as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->kode_jam_kerja }}</td>
                                            <td>{{ $d->nama_jam_kerja }}</td>
                                            <td>{{ $d->jam_masuk }}</td>
                                            <td>{{ $d->jam_pulang }}</td>
                                            <td>{{ $d->total_jam }}</td>
                                            <td class="text-center">
                                                @if ($d->lintas_hari == 1)
                                                    <i class="ti ti-check text-success"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('jamkerja.edit')
                                                        <div>
                                                            <a href="#" class="me-2 btnEdit"
                                                                kode_jam_kerja="{{ Crypt::encrypt($d->kode_jam_kerja) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('jamkerja.delete')
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('jamkerja.delete', Crypt::encrypt($d->kode_jam_kerja)) }}">
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
<x-modal-form id="mdlCreate" size="" show="loadCreate" title="Buat Jam Kerja" />
<x-modal-form id="mdlEdit" size="" show="loadEdit" title="Edit Jam Kerja" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btnCreate").click(function(e) {
            e.preventDefault();
            $('#mdlCreate').modal("show");
            $("#loadCreate").load("{{ route('jamkerja.create') }}");
        });

        $(".btnEdit").click(function(e) {
            var kode_jam_kerja = $(this).attr("kode_jam_kerja");
            e.preventDefault();
            $('#mdlEdit').modal("show");
            $("#loadEdit").load('/jamkerja/' + kode_jam_kerja + '/edit');
        });
    });
</script>
@endpush
