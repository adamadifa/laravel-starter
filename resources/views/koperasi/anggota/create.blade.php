<form action="{{ route('anggota.store') }}" id="formcreateAnggota" method="POST">
    @csrf
    <x-input-with-icon-label icon="ti ti-barcode" label="No. Anggota" name="no_anggota" />
    <x-input-with-icon-label icon="ti ti-credit-card" label="NIK" name="nik" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Lengkap" name="nama_lengkap" />
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
            <option value="">Jenis Kelamin</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <x-input-with-icon-label icon="ti ti-map-pin" label="Tempat Lahir" name="tempat_lahir" />
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <x-input-with-icon-label icon="ti ti-calendar" label="Tanggal Lahir" name="tanggal_lahir" datepicker="flatpickr-date" />
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Pendidikan Terakhir</label>
        <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select">
            <option value="">Pendidikan Terakhir</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
            <option value="SMK">SMK</option>
            <option value="D1">D1</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select>
    </div>
    <x-input-with-icon-label icon="ti ti-phone" label="No. HP" name="no_hp" />
    <x-textarea-label name="alamat" label="Alamat" />
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Status Pernikahan</label>
        <select name="status_pernikahan" id="status_pernikahan" class="form-select">
            <option value="">Status Pernikahan</option>
            <option value="B">Belum Menikah</option>
            <option value="M">Menikah</option>
            <option value="J">Janda/Duda</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Jumlah Tanggungan</label>
        <input type="number" name="jml_tanggungan" id="jml_tanggungan" class="form-control">
    </div>
    <x-input-with-icon-label icon="ti ti-user" label="Nama Pasangan" name="nama_pasangan" />
    <x-input-with-icon-label icon="ti ti-briefcase" label="Pekerjaan Pasangan" name="pekerjaan_pasangan" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Ibu" name="nama_ibu" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Saudara" name="nama_saudara" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/anggota/create.js') }}"></script>
<script>
    $(function() {
        $(".flatpickr-date").flatpickr({

        });
    });
</script>
