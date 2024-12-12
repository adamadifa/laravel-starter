<form action="{{ route('ledger.store') }}" method="POST" id="formLedger">
    @csrf
    <x-input-with-icon label="Tanggal" name="tanggal" icon="ti ti-calendar" datepicker="flatpickr-date" />
    <div class="form-group mb-3">
        <select name="kode_ledger" id="kode_ledger" class="form-select select2Kodeledger">
            <option value="">Pilih Ledger</option>
            @foreach ($ledger as $d)
                <option value="{{ $d->kode_ledger }}">{{ $d->nama_ledger }}
                    {{ !empty($d->no_rekening) && $d->no_rekening != '-' ? '(' . $d->no_rekening . ')' : '' }}</option>
            @endforeach
        </select>
    </div>

    <x-textarea label="Keterangan" name="keterangan" />
    <x-input-with-icon label="Jumlah" name="jumlah" icon="ti ti-moneybag" align="right" money="true" />

    <div class="form-group">
        <select name="debet_kredit" id="debet_kredit" class="form-select">
            <option value="">Debet / Kredit</option>
            <option value="D">Debet</option>
            <option value="K">Kredit</option>
        </select>
    </div>
    <div class="form-group">
        <select name="kode_kategori" id="kode_kategori" class="form-select select2Kodekategori">
            <option value="">Pilih Kategori</option>
        </select>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-check mt-3 mb-3">
                <input class="form-check-input agreement" name="aggrement" value="aggrement" type="checkbox" value="" id="defaultCheck3">
                <label class="form-check-label" for="defaultCheck3"> Yakin Akan Disimpan ? </label>
            </div>
            <div class="form-group" id="saveButton">
                <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
                    <ion-icon name="send-outline" class="me-1"></ion-icon>
                    Submit
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
            $.ajax({
                type: 'POST',
                url: '/kategoriledger/getkategoriledger',
                data: {
                    _token: "{{ csrf_token() }}",
                    debet_kredit: debet_kredit
                },
                cache: false,
                success: function(respond) {
                    form.find("#kode_kategori").html(respond);
                }
            });
        }

        form.find("#debet_kredit").change(function() {
            loadkategori();
        });




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




    });
</script>
