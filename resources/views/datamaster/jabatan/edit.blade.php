<form action="{{ route('jabatan.update', Crypt::encrypt($jabatan->kode_jabatan)) }}" id="formeditJabatan" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon-label icon="ti ti-barcode" label="Kode Jabatan" name="kode_jabatan"
        value="{{ $jabatan->kode_jabatan }}" readonly="true" />
    <x-input-with-icon-label icon="ti ti-file-description" label="Nama Jabatan" name="nama_jabatan"
        value="{{ $jabatan->nama_jabatan }}" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/jabatan/edit.js') }}"></script>
