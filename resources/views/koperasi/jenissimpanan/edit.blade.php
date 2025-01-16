<form action="{{ route('jenissimpanan.update', ['kode_simpanan' => Crypt::encrypt($jenissimpanan->kode_simpanan)]) }}" id="formSimpanan" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-barcode" label="Kode Jenis Simpanan" name="kode_simpanan" :value="$jenissimpanan->kode_simpanan" />
    <x-input-with-icon icon="ti ti-file-description" label="Jenis Simpanan" name="jenis_simpanan" :value="$jenissimpanan->jenis_simpanan" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Simpan Perubahan
        </button>
    </div>
</form>
<script>
    $(function() {
        $('#kode_simpanan').mask('A00');
        $('#formSimpanan').submit(function(e) {
            if ($('#kode_simpanan').val().length < 3 || $('#kode_simpanan').val().length > 3) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Simpanan harus terdiri dari 3 karakter!',
                });
            } else if ($('#kode_simpanan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Simpanan harus diisi!',
                });
            } else if ($('#jenis_simpanan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jenis Simpanan harus diisi!',
                });
            } else {
                $('#btnSimpan').attr('disabled', 'disabled');
                $('#btnSimpan').html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...'
                );
            }
        });
    });
</script>
