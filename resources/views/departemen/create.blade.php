<form action="{{ route('departemen.store') }}" id="formcreateDepartemen" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-barcode" label="Kode Departemen" name="kode_dept" />
    <x-input-with-icon icon="ti ti-file-description" label="Nama Departemen" name="nama_dept" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/departemen/create.js') }}"></script>
