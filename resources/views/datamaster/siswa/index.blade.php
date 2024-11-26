@extends('layouts.app')
@section('titlepage', 'Siswa')

@section('content')
@section('navigasi')
  <span>Siswa</span>
@endsection
<div class="row">
  <div class="col-lg-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="card-header">
        @can('siswa.create')
          <a href="#" class="btn btn-primary" id="btnCreate"><i class="fa fa-plus me-2"></i> Tambah
            Siswa</a>
        @endcan
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('siswa.index') }}">
              <div class="row">
                <div class="col-lg-10 col-sm-12 col-md-12">
                  <x-input-with-icon label="Cari Nama Siswa" value="{{ Request('nama_lengkap') }}"
                    name="nama_lengkap" icon="ti ti-search" />
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
                    <th>ID Siswa</th>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>PIN</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($siswa as $d)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $d->id_siswa }}</td>
                      <td>{{ $d->nisn }}</td>
                      <td>{{ $d->nama_lengkap }}</td>
                      <td>{{ !empty($d->tanggal_lahir) ? DateToIndo($d->tanggal_lahir) : '' }}</td>
                      <td>{{ !empty($d->jenis_kelamin) ? $jenis_kelamin[$d->jenis_kelamin] : '' }}</td>
                      <td>{{ $d->pin }}</td>
                      <td>
                        <div class="d-flex">
                          @can('siswa.edit')
                            <div>
                              <a href="#" class="me-2 btnEdit"
                                id_siswa="{{ Crypt::encrypt($d->id_siswa) }}">
                                <i class="ti ti-edit text-success"></i>
                              </a>
                            </div>
                          @endcan
                          @can('siswa.show')
                            <div>
                              <a href="{{ route('siswa.show', Crypt::encrypt($d->id_siswa)) }}"
                                class="me-2">
                                <i class="ti ti-file-description text-info"></i>
                              </a>
                            </div>
                          @endcan
                          @can('siswa.delete')
                            <div>
                              <form method="POST" name="deleteform" class="deleteform"
                                action="{{ route('siswa.delete', Crypt::encrypt($d->id_siswa)) }}">
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
            <div style="float: right;">
              {{ $siswa->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<x-modal-form id="modal" size="modal-lg" show="loadmodal" title="" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
  $(function() {
    $("#btnCreate").click(function(e) {
      e.preventDefault();
      $("#modal").modal("show");
      $(".modal-title").text("Tambah Data Siswa");
      $("#loadmodal").load(`/siswa/create`);
    });

    $(".btnEdit").click(function(e) {
      e.preventDefault();
      var id_siswa = $(this).attr("id_siswa");
      e.preventDefault();
      $("#modal").modal("show");
      $(".modal-title").text("Edit Data Siswa");
      $("#loadmodal").load(`/siswa/${id_siswa}/edit`);
    });
  });
</script>
@endpush
