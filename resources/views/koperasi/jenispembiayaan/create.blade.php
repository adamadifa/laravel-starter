<form action="{{ route('jenispembiayaan.store') }}" id="formPembiayaan" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-barcode" label="Kode Jenis Pembiayaan" name="kode_pembiayaan" />
    <x-input-with-icon icon="ti ti-file-description" label="Jenis Pembiayaan" name="jenis_pembiayaan" />
    <x-input-with-icon icon="ti ti-calculator" label="Persentase" name="persentase" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script>
    $(function() {
        $('#kode_pembiayaan').mask('A00');
        $('#formPembiayaan').submit(function(e) {
            if ($('#kode_pembiayaan').val().length < 3 || $('#kode_pembiayaan').val().length > 3) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Jenis Pembiayaan harus terdiri dari 3 karakter!',
                    didClose: () => {
                        $('#kode_pembiayaan').focus();
                    }
                });
            } else if ($('#kode_pembiayaan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Jenis Pembiayaan harus diisi!',
                    didClose: () => {
                        $('#kode_pembiayaan').focus();
                    }
                });
            } else if ($('#jenis_pembiayaan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jenis Pembiayaan harus diisi!',
                    didClose: () => {
                        $('#jenis_pembiayaan').focus();
                    }
                });
            } else if ($('#persentase').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Persentase harus diisi!',
                    didClose: () => {
                        $('#persentase').focus();
                    }
                });
            } else {
                $('#btnSimpan').attr('disabled', 'disabled');
                $('#btnSimpan').html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...'
                );
            }
        });
    });
</script>
