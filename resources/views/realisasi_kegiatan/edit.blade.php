<form action="{{ route('realisasikegiatan.update', ['id' => Crypt::encrypt($realisasikegiatan->id)]) }}" id="formEditerealisasikegiatan" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-calendar" label="Tanggal" name="tanggal" datepicker="flatpickr-date" :value="$realisasikegiatan->tanggal" />
    <x-input-with-icon icon="ti ti-file-description" label="Nama Kegiatan" name="nama_kegiatan" :value="$realisasikegiatan->nama_kegiatan" />

    @if ($user->hasRole('super admin'))
        <div class="form-group mb-3">
            <select name="kode_jabatan" id="kode_jabatan" class="form-select select2Kodejabatan">
                <option value="">Jabatan</option>
                @foreach ($jabatan as $d)
                    <option value="{{ $d->kode_jabatan }}" {{ $realisasikegiatan->kode_jabatan == $d->kode_jabatan ? 'selected' : '' }}>
                        {{ strtoUpper($d->nama_jabatan) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <select name="kode_dept" id="kode_dept" class="form-select select2Kodedept">
                <option value="">Departemen</option>
                @foreach ($departemen as $d)
                    <option value="{{ $d->kode_dept }}" {{ $realisasikegiatan->kode_dept == $d->kode_dept ? 'selected' : '' }}>
                        {{ strtoupper($d->nama_dept) }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="form-group mb-3">
        <select name="kode_jobdesk" id="kode_jobdesk" class="form-select select2Kodejobdesk">
            <option value="">Job Desk</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <select name="kode_program_kerja" id="kode_program_kerja" class="form-select select2Kodeprogramkerja">
            <option value="">Program Kerja</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <textarea name="uraian_kegiatan" id="uraian_kegiatan" class="form-control" rows="30">{{ $realisasikegiatan->uraian_kegiatan }}</textarea>
    </div>
    <div class="form-group">
        <x-input-file name="foto" :value="$realisasikegiatan->foto" />
    </div>
    <div class="form-group mb-3">
        <button class="btn btn-primary w-100" id="btnSimpan" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Simpan
        </button>
    </div>
</form>

<script></script>
<script>
    $(function() {

        $('#uraian_kegiatan').summernote({
            height: 200 // Tinggi summernote diatur menjadi 300px
        });

        $("#formEditerealisasikegiatan").submit(function(e) {
            let tanggal = $(this).find('#tanggal').val();
            let kode_dept = $(this).find('#kode_dept').val();
            let kode_jabatan = $(this).find('#kode_jabatan').val();
            let uraian_kegiatan = $(this).find('#uraian_kegiatan').val();
            let kode_jobdesk = $(this).find('#kode_jobdesk').val();
            let nama_kegiatan = $(this).find('#nama_kegiatan').val();

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
            } else if (kode_dept == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Departemen tidak boleh kosong!',
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
            } else if (kode_jobdesk == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jobdesk tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#kode_jobdesk").focus();
                    }
                });
                return false;
            } else {
                let file = document.getElementById('foto').files[0];
                if (file) {
                    let fileType = file['type'];
                    let validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
                    if ($.inArray(fileType, validImageTypes) < 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tipe file tidak valid. Hanya JPG, JPEG, PNG yang diperbolehkan.',
                            didClose: (e) => {
                                document.getElementById('file').focus();
                            }
                        });
                        return false;
                    } else if (file.size > 1048576) { // 1MB
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ukuran file terlalu besar. Maksimal 1MB.',
                            didClose: (e) => {
                                document.getElementById('file').focus();
                            }
                        });
                        return false;
                    } else {
                        $("#btnSimpan").attr("disabled", true);
                        $("#btnSimpan").html(
                            `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                        );
                    }
                }
            }
        });
        $("#tanggal").flatpickr();
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
            let kode_jabatan = $("#formEditerealisasikegiatan").find('#kode_jabatan').val();
            let kode_dept = $("#formEditerealisasikegiatan").find('#kode_dept').val();
            let kode_jobdesk = "{{ $realisasikegiatan->kode_jobdesk }}";
            $.ajax({
                url: "{{ route('jobdesk.getjobdesk') }}",
                type: "GET",
                data: {
                    kode_jabatan: kode_jabatan,
                    kode_dept: kode_dept,
                },
                cache: false,
                success: function(response) {
                    for (let i = 0; i < response.length; i++) {
                        $("#formEditerealisasikegiatan").find("#kode_jobdesk").append('<option value="' + response[i]
                            .kode_jobdesk + '" selected>' + response[i].jobdesk + '</option>');
                    }
                }
            })
        }

        function getProgramkerja() {
            let kode_jabatan = $("#formEditerealisasikegiatan").find('#kode_jabatan').val();
            let kode_dept = $("#formEditerealisasikegiatan").find('#kode_dept').val();
            let kode_program_kerja = "{{ $realisasikegiatan->kode_program_kerja }}";
            $.ajax({
                url: "{{ route('programkerja.getprogramkerja') }}",
                type: "GET",
                data: {
                    kode_jabatan: kode_jabatan,
                    kode_dept: kode_dept
                },
                cache: false,
                success: function(response) {
                    for (let i = 0; i < response.length; i++) {
                        $("#formEditerealisasikegiatan").find("#kode_program_kerja").append('<option value="' + response[i]
                            .kode_program_kerja + '" selected>' + response[i].kode_program_kerja + ' - ' + response[i]
                            .program_kerja +
                            '</option>');
                    }
                }
            })
        }


        $("#formEditerealisasikegiatan").find('#kode_jabatan, #kode_dept').on('change', function() {
            getJobdesk();
            getProgramkerja();
        });

        getJobdesk();
        getProgramkerja();
    });
</script>
