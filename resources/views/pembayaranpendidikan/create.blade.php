<form action="#" id="formDetailbayar" method="POST">
    @csrf
    <input type="hidden" name="no_pendaftaran" value="{{ Crypt::encrypt($no_pendaftaran) }}">
    <x-input-with-icon label="Auto" icon="ti ti-barcode" name="no_bukti" placeholeder="Auto" disabled />
    <x-input-with-icon label="Tanggal" icon="ti ti-calendar" name="tanggal" datepicker="flatpickr-date" />
    <hr>

    <div class="row mt-3">
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="form-group mb3">
                <select name="kode_biaya" id="kode_biaya" class="form-select select2Kodebiaya">
                    <option value="">Pilih Biaya</option>
                    @foreach ($biaya as $d)
                        <option value="{{ $d->kode_jenis_biaya . '|' . $d->kode_biaya }}">{{ $d->jenis_biaya }}
                            {{ in_array($d->kode_jenis_biaya, ['B01', 'B07']) ? $d->tahun_ajaran : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <x-input-with-icon label="Sisa Tagihan" icon="ti ti-moneybag" name="sisa_tagihan" money="true" textalign="right" />
        </div>
        <div class="col">
            <x-input-with-icon label="Jumlah Bayar" icon="ti ti-moneybag" name="jumlah" money="true" textalign="right" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-textarea name="keterangan" label="Keterangan" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="#" id="btnTambahdetailbayar" class="btn btn-warning w-100"><i class="ti ti-plus me-1"></i>Tambah</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-bordered" id="tableDetailbayar">
                <thead class="table-dark">
                    <tr>
                        <th>Jenis Biaya</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="detailbayar"></tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td class="text-end">Total Bayar</td>
                        <td class="text-end" id="totalbayar"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Simpan</button>
        </div>
    </div>
</form>
<style>
    .flatpickr-calendar {
        z-index: 9999 !important;
    }
</style>
<script>
    $(function() {
        $("#jumlah").maskMoney();
        $(".flatpickr-date").flatpickr({

        });

        const select2Kodebiaya = $('.select2Kodebiaya');
        if (select2Kodebiaya.length) {
            select2Kodebiaya.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Pilih Biaya',
                    dropdownParent: $this.parent(),

                });
            });
        }


        function getsisatagihan() {
            let biaya = $("#formDetailbayar").find("#kode_biaya").val().split("|");
            let kode_jenis_biaya = biaya[0];
            let kode_biaya = biaya[1];
            let no_pendaftaran = $("#formDetailbayar").find("#no_pendaftaran").val();

            alert(kode_jenis_biaya);

        }

        $("#kode_biaya").change(function() {
            getsisatagihan();
        })

    });
</script>
