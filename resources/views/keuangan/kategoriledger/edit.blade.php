<form action="{{ route('kategoriledger.update', $kategoriledger->id) }}" method="POST" id="formeditKategori">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-file-description" label="Kategori Ledger" name="nama_kategori" :value="$kategoriledger->nama_kategori" />
    <div class="form-group">
        <select name="jenis_kategori" id="jenis_kategori" class="form-select">
            <option value="">Jenis Ledger</option>
            <option value="PM" @if ($kategoriledger->jenis_kategori == 'PM') selected @endif>Pemasukan</option>
            <option value="PK" @if ($kategoriledger->jenis_kategori == 'PK') selected @endif>Pengeluaran</option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary w-100" id="btnSimpan" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Simpan
        </button>
    </div>
</form>
<script>
    $(function() {
        $("#formeditKategori").submit(function(e) {
            let nama_kategori = $(this).find("#nama_kategori").val();
            let jenis_kategori = $(this).find("#jenis_kategori").val();
            if (nama_kategori == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Kategori Ledger tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#nama_kategori").focus();
                    }
                });
                return false;
            } else if (jenis_kategori == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jenis Kategori tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#jenis_ledger").focus();
                    }
                });
                return false;
            } else {
                $(this).find("#btnSimpan").prop("disabled", true);
                $(this).find("#btnSimpan").html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                );
                return true;
            }
        })
    });
</script>
