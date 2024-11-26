<form action="{{ route('unit.update', Crypt::encrypt($unit->kode_unit)) }}" id="formeditUnit" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon-label icon="ti ti-barcode" label="Kode Unit" name="kode_unit" value="{{ $unit->kode_unit }}"
        readonly="true" />
    <x-input-with-icon-label icon="ti ti-file-description" label="Nama Unit" name="nama_unit"
        value="{{ $unit->nama_unit }}" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/unit/edit.js') }}"></script>
