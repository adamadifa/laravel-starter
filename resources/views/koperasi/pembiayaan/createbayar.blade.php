<form action="{{ route('pembiayaan.storebayar', Crypt::encrypt($no_akad)) }}" id="formPembiayaan" method="POST">
    @csrf
    @php
        $tagihan = $pembiayaan->jumlah + ($pembiayaan->persentase / 100) * $pembiayaan->jumlah;
        $jmlbayar = $pembiayaan->jmlbayar;
    @endphp
    <x-input-with-icon icon="ti ti-barcode" label="No. Transaksi (Auto)" name="no_transaksi" disabled="true" />
    <x-input-with-icon icon="ti ti-calendar" label="Tanggal Transaksi" name="tanggal" datepicker="flatpickr-date" />
    <x-input-with-icon label="Jumlah" icon="ti ti-moneybag" name="jumlah" money="true" textalign="right" />
    <x-textarea label="Berita" name="berita" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Submit</button>
    </div>
</form>

<script>
    $(function() {
        const formPembiayaan = $('#formPembiayaan');

        $(".flatpickr-date").flatpickr();

        $("#jumlah").maskMoney();

        formPembiayaan.submit(function(e) {
            // e.preventDefault();
            let tanggal = $(this).find('input[name="tanggal"]').val();

            let jumlah = $(this).find('input[name="jumlah"]').val();
            let berita = $(this).find('textarea[name="berita"]').val();
            let tagihan = "{{ $tagihan }}";
            let jmlbayar = "{{ $jmlbayar }}";
            let sisa = parseInt(tagihan) - parseInt(jmlbayar);
            let jml = jumlah.replace(/\./g, '');


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
            } else if (!jumlah || parseInt(jumlah) <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jumlah tidak boleh kosong!',
                    didClose: () => {
                        $(this).find('input[name="jumlah"]').focus();
                    }
                });
                return false;
            } else if (parseInt(jml) > parseInt(sisa)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jumlah melebihi sisa tagihan!',
                    didClose: () => {
                        $(this).find('input[name="jumlah"]').focus();
                    }
                })
                return false;
            } else if (berita == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Berita tidak boleh kosong!',
                    didClose: () => {
                        $(this).find('textarea[name="berita"]').focus();
                    },
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
