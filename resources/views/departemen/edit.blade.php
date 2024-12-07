<form action="{{ route('departemen.update', ['kode_dept' => Crypt::encrypt($departemen->kode_dept)]) }}" id="formeditDepartemen" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-barcode" label="Kode Departemen" name="kode_dept" :value="$departemen->kode_dept" />
    <x-input-with-icon icon="ti ti-file-description" label="Nama Departemen" name="nama_dept" :value="$departemen->nama_dept" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Update
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/departemen/edit.js') }}"></script>
