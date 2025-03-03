<form action="{{ route('agendakegiatan.update', Crypt::encrypt($agenda_kegiatan->id)) }}" id="formEditAgendakegiatan" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-calendar" label="Tanggal" name="tanggal" datepicker="flatpickr-date"
        value="{{ date('Y-m-d', strtotime($agenda_kegiatan->tanggal)) }}" />
    <x-input-with-icon icon="ti ti-file-description" label="Nama Kegiatan" name="nama_kegiatan" value="{{ $agenda_kegiatan->nama_kegiatan }}" />
    @if ($user->hasRole('super admin'))
        <div class="form-group mb-3">
            <select name="kode_jabatan" id="kode_jabatan" class="form-select select2Kodejabatan">
                <option value="">Jabatan</option>
                @foreach ($jabatan as $d)
                    <option value="{{ $d->kode_jabatan }}" {{ $d->kode_jabatan == $agenda_kegiatan->kode_jabatan ? 'selected' : '' }}>
                        {{ strtoUpper($d->nama_jabatan) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <select name="kode_dept" id="kode_dept" class="form-select select2Kodedept">
                <option value="">Departemen</option>
                @foreach ($departemen as $d)
                    <option value="{{ $d->kode_dept }}" {{ $d->kode_dept == $agenda_kegiatan->kode_dept ? 'selected' : '' }}>
                        {{ strtoupper($d->nama_dept) }}</option>
                @endforeach
            </select>
        </div>
    @endif


    <div class="form-group mb-3">
        <textarea name="uraian_kegiatan" id="uraian_kegiatan" class="form-control" rows="30">{{ $agenda_kegiatan->uraian_kegiatan }}</textarea>
    </div>

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

        $('#uraian_kegiatan').summernote({
            height: 200 // Tinggi summernote diatur menjadi 300px
        });

        $("#formEditAgendakegiatan").submit(function(e) {
            let tanggal = $(this).find('#tanggal').val();
            let kode_dept = $(this).find('#kode_dept').val();
            let kode_jabatan = $(this).find('#kode_jabatan').val();
            let nama_kegiatan = $(this).find('#nama_kegiatan').val();
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
            } else if (nama_kegiatan == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nama kegiatan tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#uraian_kegiatan").focus();
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





    });
</script>
