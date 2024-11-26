<form action="#" method="POST" id="formEditrencanaspp">
    @csrf
    <input type="hidden" name="kode_rencana_spp" value="{{ $rencana_spp->kode_rencana_spp }}">
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Tagihan SPP</th>
                        <td class="text-end" id="tagihanspppertahun">
                            {{ formatAngka($biaya->jumlah - $biaya->jumlah_potongan - $biaya->jumlah_mutasi) }}</td>
                    </tr>
                    <tr>
                        <th>Bulan</th>
                        <th>Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailrencanaspp as $d)
                        <tr>
                            <td>
                                {{ $listbulan[$d->bulan] }} {{ $d->tahun }}
                                <input type="hidden" name="bulan[]" value="{{ $d->bulan }}">
                                <input type="hidden" name="tahun[]" value="{{ $d->tahun }}">
                            </td>
                            <td class="text-end">
                                <input type="text" name="jumlah[]" value="{{ formatAngka($d->jumlah) }}" style="text-align: right"
                                    class="noborder-form money jmlsppperbulan">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <td>TOTAL</td>
                    <td class="text-end" id="totalspppertahun"></td>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="form-group mb-3">
                <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Update</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".money").maskMoney();

        function convertToRupiah(number) {
            if (number) {
                var rupiah = "";
                var numberrev = number
                    .toString()
                    .split("")
                    .reverse()
                    .join("");
                for (var i = 0; i < numberrev.length; i++)
                    if (i % 3 == 0) rupiah += numberrev.substr(i, 3) + ".";
                return (
                    rupiah
                    .split("", rupiah.length - 1)
                    .reverse()
                    .join("")
                );
            } else {
                return number;
            }
        }

        function hitungTotalSPP() {
            let totalSPP = 0;
            $(".jmlsppperbulan").each(function() {
                totalSPP += parseInt($(this).val().replace(/[^0-9]/g, ''))
            });
            $("#totalspppertahun").text(convertToRupiah(totalSPP));
        }



        hitungTotalSPP();

        $(".jmlsppperbulan").keyup(function() {
            hitungTotalSPP();
        });



    });
</script>
