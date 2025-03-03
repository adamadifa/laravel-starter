@extends('layouts.app')
@section('titlepage', 'Buat Agenda Kegiatan')
@section('content')
    <form action="{{ route('agendakegiatan.store') }}" id="formCreateAgendakegiatan" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input-with-icon icon="ti ti-calendar" label="Tanggal" name="tanggal" datepicker="flatpickr-date" value="{{ date('Y-m-d') }}" />
        <x-input-with-icon icon="ti ti-file-description" label="Nama Kegiatan" name="nama_kegiatan" />

        <div class="form-group mb-3">
            <textarea name="uraian_kegiatan" id="uraian_kegiatan" class="form-control" rows="10" placeholder="Uraian Kegiatan"></textarea>
        </div>

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

            $('#uraian_kegiatan').summernote({
                height: 200, // Tinggi summernote diatur menjadi 300px
                placeholder: 'Uraian Kegiatan...'
            });

            $("#formCreateAgendakegiatan").submit(function(e) {
                let tanggal = $(this).find('#tanggal').val();
                let nama_kegiatan = $(this).find('#nama_kegiatan').val();
                let kode_dept = $(this).find('#kode_dept').val();
                let kode_jabatan = $(this).find('#kode_jabatan').val();
                let uraian_kegiatan = $(this).find('#uraian_kegiatan').val();
                let kode_jobdesk = $(this).find('#kode_jobdesk').val();

                if (tanggal == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Tanggal tidak boleh kosong!',
                        didClose: (e) => {
                            $(this).find("#tanggal").focus();
                        }
                    });
                    return false;
                } else if (nama_kegiatan == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nama Kegiatan tidak boleh kosong!',
                        didClose: (e) => {
                            $(this).find("#nama_kegiatan").focus();
                        }
                    });
                    return false;
                } else if (uraian_kegiatan == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Uraian kegiatan tidak boleh kosong!',
                        didClose: (e) => {
                            $(this).find("#uraian_kegiatan").focus();
                        }
                    });
                    return false;
                } else {
                    $("#btnSimpan").attr("disabled", true);
                    $("#btnSimpan").html(
                        `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                    );
                }
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

            const select2Kodejobdesk = $('.select2Kodejobdesk');
            if (select2Kodejobdesk.length) {
                select2Kodejobdesk.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Pilih  Jobdesk',
                        allowClear: true,
                        dropdownParent: $this.parent()
                    });
                });
            }


            function getJobdesk() {
                let kode_jabatan = $("#formCreateAgendakegiatan").find('#kode_jabatan').val();
                let kode_dept = $("#formCreateAgendakegiatan").find('#kode_dept').val();

                $.ajax({
                    url: "{{ route('jobdesk.getjobdesk') }}",
                    type: "GET",
                    data: {
                        kode_jabatan: kode_jabatan,
                        kode_dept: kode_dept
                    },
                    cache: false,
                    success: function(response) {
                        for (let i = 0; i < response.length; i++) {
                            $("#formCreateAgendakegiatan").find("#kode_jobdesk").append('<option value="' + response[i]
                                .kode_jobdesk + '">' + response[i].jobdesk + '</option>');
                        }
                    }
                })
            }

            $("#formCreateAgendakegiatan").find('#kode_jabatan, #kode_dept').on('change', function() {
                getJobdesk();
            });

            getJobdesk();
        });
    </script>
@endpush
