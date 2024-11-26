<form action="{{ route('jenisbiaya.store') }}" id="formBiaya" method="POST">
    @csrf
    <x-input-with-icon-label icon="ti ti-barcode" label="Kode Jenis Biaya" name="kode_jenis_biaya" />
    <x-input-with-icon-label icon="ti ti-file-description" label="Jenis Biaya" name="jenis_biaya" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script src="{{ asset('assets/js/pages/biaya.js') }}"></script>
<script>
    $(function(){
        $('#kode_biaya').mask('A00');
    });
</script>