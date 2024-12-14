<form action="{{ route('ledgertransaksi.update', Crypt::encrypt($ledgerTransaksi->no_bukti)) }}" method="POST" id="formLedger">
    @csrf
    @method('PUT')
    <x-input-with-icon label="Tanggal" name="tanggal" icon="ti ti-calendar" datepicker="flatpickr-date" :value="$ledgerTransaksi->tanggal" />
    <div class="form-group mb-3">
        <select name="kode_ledger" id="kode_ledger" class="form-select select2Kodeledger">
            <option value="">Pilih Ledger</option>
            @foreach ($ledger as $d)
                <option value="{{ $d->kode_ledger }}" {{ $d->kode_ledger == $ledgerTransaksi->kode_ledger ? 'selected' : '' }}>{{ $d->nama_ledger }}
                    {{ !empty($d->no_rekening) && $d->no_rekening != '-' ? '(' . $d->no_rekening . ')' : '' }}</option>
            @endforeach
        </select>
    </div>

    <x-textarea label="Keterangan" name="keterangan" :value="$ledgerTransaksi->keterangan" />
    <x-input-with-icon label="Jumlah" name="jumlah" icon="ti ti-moneybag" textalign="right" money="true" :value="formatAngka($ledgerTransaksi->jumlah)" />

    <div class="form-group">
        <select name="debet_kredit" id="debet_kredit" class="form-select">
            <option value="">Debet / Kredit</option>
            <option value="D" {{ $ledgerTransaksi->debet_kredit == 'D' ? 'selected' : '' }}>Debet</option>
            <option value="K" {{ $ledgerTransaksi->debet_kredit == 'K' ? 'selected' : '' }}>Kredit</option>
        </select>
    </div>
    <div class="form-group">
        <select name="id_kategori" id="id_kategori" class="form-select select2Kodekategori">
            <option value="">Pilih Kategori</option>
        </select>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            {{-- <div class="form-check mt-3 mb-3">
                <input class="form-check-input agreement" name="aggrement" value="aggrement" type="checkbox" value="" id="defaultCheck3">
                <label class="form-check-label" for="defaultCheck3"> Yakin Akan Disimpan ? </label>
            </div> --}}
            <div class="form-group" id="saveButton">
                <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
                    <ion-icon name="send-outline" class="me-1"></ion-icon>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        const form = $("#formLedger");
        $(".flatpickr-date").flatpickr();
        $(".money").maskMoney();

        function buttonDisable() {
            $("#btnSimpan").prop('disabled', true);
            $("#btnSimpan").html(`
            <div class="spinner-border spinner-border-sm text-white me-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            Loading..`);
        }

        function loadkategori() {
            const debet_kredit = form.find("#debet_kredit").val();
            const id_kategori = "{{ $ledgerTransaksi->id_kategori }}";
            $.ajax({
                type: 'POST',
                url: '/kategoriledger/getkategoriledger',
                data: {
                    _token: "{{ csrf_token() }}",
                    debet_kredit: debet_kredit,
                    id_kategori: id_kategori
                },
                cache: false,
                success: function(respond) {
                    form.find("#id_kategori").html(respond);
                }
            });
        }

        form.find("#debet_kredit").change(function() {
            loadkategori();
        });


        loadkategori();

        const select2Kodeledger = $('.select2Kodeledger');
        if (select2Kodeledger.length) {
            select2Kodeledger.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Pilih Ledger',
                    allowClear: true,
                    dropdownParent: $this.parent()
                });
            });
        }

        const select2Kodekategori = $('.select2Kodekategori');
        if (select2Kodekategori.length) {
            select2Kodekategori.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Pilih  Kategori',
                    allowClear: true,
                    dropdownParent: $this.parent()
                });
            });
        }


        form.submit(function(e) {
            let tanggal = form.find("#tanggal").val();
            let kode_ledger = form.find("#kode_ledger").val();
            let keterangan = form.find("#keterangan").val();
            let jumlah = form.find("#jumlah").val();
            let debet_kredit = form.find("#debet_kredit").val();
            let id_kategori = form.find("#id_kategori").val();
            if (tanggal == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tanggal tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#tanggal").focus();
                    }
                });
                return false;
            } else if (kode_ledger == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Ledger tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#kode_ledger").focus();
                    }
                });
                return false;
            } else if (keterangan == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Keterangan tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#keterangan").focus();
                    }
                });
                return false;
            } else if (jumlah == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Jumlah tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#jumlah").focus();
                    }
                });
                return false;
            } else if (debet_kredit == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debet Kredit tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#debet_kredit").focus();
                    }
                });
                return false;
            } else if (id_kategori == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Kategori tidak boleh kosong!',
                    didClose: (e) => {
                        form.find("#id_kategori").focus();
                    }
                });
                return false;
            } else {
                form.find("#btnSimpan").prop('disabled', true);
                form.find("#btnSimpan").html(`
                <div class="spinner-border spinner-border-sm text-white me-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Loading..`);
            }
        });
    });
</script>
