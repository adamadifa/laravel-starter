<form action="#" method="post" id="formMutasi">
    @csrf
    <input type="hidden" name="no_pendaftaran" value="{{ $no_pendaftaran }}">
    <input type="hidden" name="kode_jenis_biaya" value="{{ $kode_jenis_biaya }}">
    <input type="hidden" name="kode_biaya" value="{{ $kode_biaya }}">
    <x-input-with-icon icon="ti ti-moneybag" label="Jumlah Mutasi" name="jumlah" textalign="right"
        value="{{ $mutasi != null ? formatAngka($mutasi->jumlah_mutasi) : '' }}" />
    <x-textarea label="Keterangan" name="keterangan" value="{{ $mutasi != null ? $mutasi->keterangan : '' }}" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#jumlah").maskMoney();
    });
</script>
