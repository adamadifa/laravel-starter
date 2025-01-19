<form action="{{ route('simpanan.store', ['no_anggota' => $no_anggota, 'jenis_transaksi', $jenis_transaksi]) }}" id="formSimpanan" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-barcode" label="No. Transaksi (Auto)" name="no_transaksi" disabled="true" />
    <x-input-with-icon icon="ti ti-calendar" label="Tanggal Transaksi" name="tanggal" datepicker="flatpickr-date" />
    <div class="form-group">
        <select name="kode_simpanan" id="kode_simpanan" class="form-select select2Kodesimpanan">
            <option value="">Jenis Simpanan</option>
            @foreach ($jenis_simpanan as $d)
                <option value="{{ $d->kode_simpanan }}">{{ $d->kode_simpanan }} - {{ $d->jenis_simpanan }}</option>
            @endforeach
        </select>
    </div>
    <x-input-with-icon label="Jumlah" icon="ti ti-moneybag" name="jumlah" money="true" textalign="right" />
    <x-textarea label="Berita" name="berita" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Submit</button>
    </div>
</form>

<script>
    $(function() {
        const formSimpanan = $('#formSimpanan');
        const select2Kodesimpanan = $('.select2Kodesimpanan');
        if (select2Kodesimpanan.length) {
            select2Kodesimpanan.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Jenis Simpanan',
                    dropdownParent: $this.parent(),
                    allowClear: true
                });
            });
        }

        $(".flatpickr-date").flatpickr();

        $("#jumlah").maskMoney();

        formSimpanan.submit(function(e) {
            // e.preventDefault();
            let tanggal = $(this).find('input[name="tanggal"]').val();
            let kode_simpanan = $(this).find('select[name="kode_simpanan"]').val();
            let jumlah = $(this).find('input[name="jumlah"]').val();
            let berita = $(this).find('textarea[name="berita"]').val();

            if (!tanggal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tanggal Transaksi tidak boleh kosong!',
                    didClose: () => {
                        $(this).find('input[name="tanggal"]').focus();
                    }
                });
                return false;
            } else if (!kode_simpanan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jenis Simpanan harus dipilih!',
                    didClose: () => {
                        $(this).find('select[name="kode_simpanan"]').focus();
                    }
                });
                return false;
            } else if (!jumlah) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jumlah tidak boleh kosong!',
                    didClose: () => {
                        $(this).find('input[name="jumlah"]').focus();
                    }
                });
                return false;
            } else {
                $(this).find("#btnSimpan").prop("disabled", true);
                $(this).find("#btnSimpan").html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`);
            }
        });
    });
</script>
