<form action="#" id="formTabungan" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-barcode" label="No. Rekening (Auto)" name="no_rekening" disabled="true" />
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="no_anggota" id="no_anggota" readonly="" placeholder="Cari Anggota" aria-label="Cari Anggota"
            aria-describedby="no_anggota">
        <a class="btn btn-primary waves-effect" id="no_anggota_search"><i class="ti ti-search text-white"></i></a>
    </div>
    <div class="form-group">
        <select name="kode_tabungan" id="kode_tabungan" class="form-select select2Kodetabungan">
            <option value="">Jenis Tabungan</option>
            @foreach ($jenis_tabungan as $d)
                <option value="{{ $d->kode_tabungan }}">{{ $d->kode_tabungan }} - {{ textUpperCase($d->jenis_tabungan) }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Submit</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        const formTabungan = $('#formTabungan');
        const select2Kodetabungan = $('.select2Kodetabungan');
        if (select2Kodetabungan.length) {
            select2Kodetabungan.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Jenis Tabungan',
                    dropdownParent: $this.parent(),
                    allowClear: true
                });
            });
        }

    });
</script>
