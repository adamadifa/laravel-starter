<form action="{{ route('programkerja.store') }}" id="formCreateProgramKerja" method="POST" enctype="multipart/form-data">
    @csrf
    <x-input-with-icon icon="ti ti-file" label="Program Kerja" name="program_kerja" />
    <div class="form-group mb-3">
        <textarea name="target_pencapaian" id="target_pencapaian" class="form-control" rows="30"></textarea>
    </div>
    <div class="form-group mb-3">
        <textarea name="keterangan" id="keterangan" class="form-control" rows="30"></textarea>
    </div>
    @if ($user->hasRole('super admin'))
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
    @endif

    <x-input-with-icon icon="ti ti-calendar" label="Tanggal Pelaksanaan" name="tanggal_pelaksanaan" datepicker="flatpickr-date" />


    <div class="form-group mb-3">
        <button class="btn btn-primary w-100" id="btnSimpan" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>



<script></script>
<script>
    $(function() {

        $('#target_pencapaian').summernote({
            height: 100,
            placeholder: 'Target Pencapaian...' // Tinggi summernote diatur menjadi 300px
        });

        $('#keterangan').summernote({
            height: 100,
            placeholder: 'Keterangan...' // Tinggi summernote diatur menjadi 300px
        });

        $("#formCreateProgramKerja").submit(function(e) {
            let tanggal_pelaksanaan = $(this).find('#tanggal_pelaksanaan').val();
            let kode_dept = $(this).find('#kode_dept').val();
            let kode_jabatan = $(this).find('#kode_jabatan').val();
            let program_kerja = $(this).find('#program_kerja').val();
            let target_pencapaian = $(this).find('#target_pencapaian').val();
            let keterangan = $(this).find('#keterangan').val();

            if (program_kerja == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Program Kerja tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#program_kerja").focus();
                    }
                });
                return false;
            } else if (target_pencapaian == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Target Pencapaian tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#kode_dept").focus();
                    }
                });
                return false;
            } else if (tanggal_pelaksanaan == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tanggal Pelaksanaan tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#kode_dept").focus();
                    }
                });
                return false;
            } else if (kode_jabatan == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jabatan tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#kode_jabatan").focus();
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
        $("#tanggal_pelaksanaan").flatpickr();
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
            let kode_jabatan = $("#formCreateProgramKerja").find('#kode_jabatan').val();
            let kode_dept = $("#formCreateProgramKerja").find('#kode_dept').val();

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
                        $("#formCreateProgramKerja").find("#kode_jobdesk").append('<option value="' + response[i]
                            .kode_jobdesk + '">' + response[i].jobdesk + '</option>');
                    }
                }
            })
        }

        $("#formCreateProgramKerja").find('#kode_jabatan, #kode_dept').on('change', function() {
            getJobdesk();
        });
    });
</script>
