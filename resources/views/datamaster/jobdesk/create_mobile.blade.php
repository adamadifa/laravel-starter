@extends('layouts.app')
@section('titlepage', 'Buat Realisasi Kegiatan')
@section('content')
    <form action="{{ route('jobdesk.store') }}" id="formcreateJobdesk" method="POST">
        @csrf
        @hasanyrole('super admin')
            <div class="form-group mb-3">
                <select name="kode_jabatan" id="kode_jabatan" class="form-select select2Kodejabatan">
                    <option value="">Jabatan</option>
                    @foreach ($jabatan as $d)
                        <option value="{{ $d->kode_jabatan }}">{{ strtoUpper($d->nama_jabatan) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <select name="kode_dept" id="kode_dept" class="form-select select2Kodedept">
                    <option value="">Departemen</option>
                    @foreach ($departemen as $d)
                        <option value="{{ $d->kode_dept }}">{{ strtoupper($d->nama_dept) }}</option>
                    @endforeach
                </select>
            </div>
        @endhasanyrole
        <x-textarea label="Jobdesk" name="jobdesk" />
        <div class="form-group mb-3">
            <button class="btn btn-primary w-100" id="btnSimpan" type="submit">
                <ion-icon name="send-outline" class="me-1"></ion-icon>
                Submit
            </button>
        </div>
    </form>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#jobdesk").summernote({
                height: 200,
                placeholder: 'Jobdesk...'
            });
            const select2Kodedept = $('.select2Kodedept');
            if (select2Kodedept.length) {
                select2Kodedept.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Pilih  Departemen',
                        allowClear: true,
                        dropdownParent: $this.parent()
                    });
                });
            }

            const select2Kodejabatan = $('.select2Kodejabatan');
            if (select2Kodejabatan.length) {
                select2Kodejabatan.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Pilih  Jabatan',
                        allowClear: true,
                        dropdownParent: $this.parent()
                    });
                });
            }

            const form = $('#formcreateJobdesk');
            form.submit(function(e) {
                let kode_jabatan = form.find('#kode_jabatan').val();
                let kode_dept = form.find('#kode_dept').val();
                let jobdesk = form.find('#jobdesk').val();
                if (kode_jabatan == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Jabatan tidak boleh kosong!',
                        didClose: (e) => {
                            form.find("#kode_jabatan").focus();
                        }
                    });
                    return false;
                } else if (kode_dept == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Departemen tidak boleh kosong!',
                        didClose: (e) => {
                            form.find("#kode_dept").focus();
                        }
                    });
                    return false;
                } else if (jobdesk == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Jobdesk tidak boleh kosong!',
                        didClose: (e) => {
                            form.find("#jobdesk").focus();
                        }
                    });
                    return false;
                } else {
                    $("#btnSimpan").attr("disabled", true);
                    $("#btnSimpan").html(
                        `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                    );
                }
            })
        });
    </script>
@endpush
