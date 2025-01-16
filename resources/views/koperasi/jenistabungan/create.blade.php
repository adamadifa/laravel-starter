<form action="{{ route('jenistabungan.store') }}" id="formTabungan" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-barcode" label="Kode Jenis Tabungan" name="kode_tabungan" />
    <x-input-with-icon icon="ti ti-file-description" label="Jenis Tabungan" name="jenis_tabungan" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>
<script>
    $(function() {
        $('#kode_tabungan').mask('A00');
        $('#formTabungan').submit(function(e) {
            if ($('#kode_tabungan').val().length < 3 || $('#kode_tabungan').val().length > 3) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Tabungan harus terdiri dari 3 karakter!',
                });
            } else if ($('#kode_tabungan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kode Tabungan harus diisi!',
                });
            } else if ($('#jenis_tabungan').val() == '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jenis Tabungan harus diisi!',
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
