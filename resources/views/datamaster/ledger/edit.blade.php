<form action="{{ route('ledger.update', ['kode_ledger' => Crypt::encrypt($ledger->kode_ledger)]) }}" id="formeditLedger" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-barcode" label="Auto" name="kode_ledger" disabled="true" :value="$ledger->kode_ledger" />
    <x-input-with-icon icon="ti ti-file-description" label="Nama Ledger" name="nama_ledger" :value="$ledger->nama_ledger" />
    <x-input-with-icon icon="ti ti-credit-card" label="No. Rekening" name="no_rekening" :value="$ledger->no_rekening" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Simpan Perubahan
        </button>
    </div>
</form>
<script>
    $(function() {
        $('#formeditLedger').submit(function(e) {
            let nama_ledger = $(this).find("#nama_ledger").val();
            let no_rekening = $(this).find("#no_rekening").val();

            if (nama_ledger == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nama Ledger tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#nama_ledger").focus();
                    }
                });
                return false;
            } else if (no_rekening == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'No. Rekening tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#no_rekening").focus();
                    }
                });
                return false;
            } else {
                $("#btnSimpan").attr("disabled", true);
                $("#btnSimpan").html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                )
            }
        });
    });
</script>
