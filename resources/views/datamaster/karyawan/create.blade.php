<form action="{{ route('karyawan.store') }}" id="formcreateKaryawan" method="POST">
    @csrf
    <x-input-with-icon-label icon="ti ti-barcode" label="NPP" name="npp" />
    <x-input-with-icon-label icon="ti ti-credit-card" label="No. KK" name="no_kk" />
    <x-input-with-icon-label icon="ti ti-credit-card" label="No. KTP" name="no_ktp" />
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
            <x-input-with-icon-label icon="ti ti-calendar" label="Tanggal Lahir" name="tanggal_lahir"
                datepicker="flatpickr-date" />
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Golongan Darah</label>
        <select name="golongan_darah" id="golongan_darah" class="form-select">
            <option value="">Golongan Darah</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
        </select>
    </div>
    <x-input-with-icon-label icon="ti ti-phone" label="No. HP" name="no_hp" />
    <x-textarea-label name="alamat_ktp" label="Alamat KTP" />
    <x-textarea-label name="alamat_tinggal" label="Alamat Tinggal" />
    <x-input-with-icon-label icon="ti ti-calendar" label="TMT" name="tmt" datepicker="flatpickr-date" />
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Status Karyawan</label>
        <select name="status_karyawan" id="status_karyawan" class="form-select">
            <option value="">Status Karyawan</option>
            <option value="K">Kontrak</option>
            <option value="T">Tetap</option>
            <option value="O">OJT</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Pendidikan
            Terakhir</label>
        <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-select">
            <option value="">Pendidikan Terakhir</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMP</option>
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

    <x-select-label label="Jabatan" name="kode_jabatan" :data="$jabatan" key="kode_jabatan" textShow="nama_jabatan" />
    <x-select-label label="Unit" name="kode_unit" :data="$unit" key="kode_unit" textShow="nama_unit"
        upperCase="true" />
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
<script src="{{ asset('assets/js/pages/karyawan/create.js') }}"></script>
<script>
    $(function() {
        $(".flatpickr-date").flatpickr({

        });
    });
</script>
