<form action="{{ route('kegiatanibadah.update', ['id' => Crypt::encrypt($kegiatanibadah->id)]) }}" method="POST" id="formKegiatanIbadah">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-file-description" label="Kegiatan Ibadah" name="nama_kegiatan" :value="$kegiatanibadah->nama_kegiatan" />
    <div class="form-group">
        <select name="id_kategori_ibadah" id="id_kategori_ibadah" class="form-select">
            <option value="">Kategori Ibadah</option>
            @foreach ($kategori_ibadah as $item)
                <option value="{{ $item->id }}" @selected($kegiatanibadah->id_kategori_ibadah == $item->id)>{{ $item->kategori_ibadah }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Simpan
        </button>
    </div>
</form>
<script>
    $(function() {
        $('#formKegiatanIbadah').submit(function(e) {
            let nama_kegiatan = $(this).find("#nama_kegiatan").val();
            let id_kategori_ibadah = $(this).find("#id_kategori_ibadah").val();
            if (nama_kegiatan == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nama Kegiatan Ibadah tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#nama_kegiatan").focus();
                    }
                });
                return false;
            } else if (id_kategori_ibadah == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Kategori Ibadah tidak boleh kosong!',
                    didClose: (e) => {
                        $(this).find("#id_kategori_ibadah").focus();
                    }
                })
            } else {
                $(this).find("#btnSimpan").prop("disabled", true);
                $(this).find("#btnSimpan").html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                );
            }
        })
    })
</script>
