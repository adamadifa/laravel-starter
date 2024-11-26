<form action="{{ route('unit.store') }}" id="formcreateUnit" method="POST">
    @csrf
    <x-input-with-icon-label icon="ti ti-barcode" label="Kode Unit" name="kode_unit" />
    <x-input-with-icon-label icon="ti ti-file-description" label="Nama Unit" name="nama_unit" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/unit/create.js') }}"></script>
