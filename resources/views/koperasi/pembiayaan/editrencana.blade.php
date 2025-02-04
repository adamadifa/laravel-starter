<form action="{{ route('pembiayaan.updaterencanacicilan', Crypt::encrypt($pembiayaan->no_akad)) }}" method="POST" id="formEditRencanapembiayaan">
    @csrf
    @method('PUT')
    <div class="row">
        <table class="table">
            @php
                $jumlah_pembiayaan = $pembiayaan->jumlah + ($pembiayaan->persentase / 100) * $pembiayaan->jumlah;
            @endphp
            <tr>
                <th>No. Akad</th>
                <td class="text-end">{{ $pembiayaan->no_akad }}</td>
            </tr>
            <tr>
                <th>No. Anggota</th>
                <td class="text-end">{{ $pembiayaan->no_anggota }}</td>
            </tr>
            <tr>
                <th>Jenis Pembiayaan</th>
                <td class="text-end">{{ $pembiayaan->jenis_pembiayaan }}</td>
            </tr>
            <tr>
                <th>Pokok</th>
                <td class="text-end">{{ formatAngka($pembiayaan->jumlah) }}</th>
            </tr>
            <tr>
                <th>Persentase</th>
                <td class="text-end">{{ $pembiayaan->persentase }} %</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td class="text-end" id="totalpembiayaan">{{ formatAngka($jumlah_pembiayaan) }}</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($rencana as $d)
                        @php
                            $jatuh_tempo = $d->tahun . '-' . $d->bulan . '-05';
                            $total += $d->jumlah;
                        @endphp
                        <tr>
                            <td>
                                <input type="hidden" name="cicilan_ke[]" value="{{ $d->cicilan_ke }}" class="cicilan_ke">
                                {{ $d->cicilan_ke }}
                            </td>
                            <td>
                                <input type="hidden" name="tahun[]" value="{{ $d->tahun }}" class="tahun">
                                <input type="hidden" name="bulan[]" value="{{ $d->bulan }}" class="bulan">
                                {{ date('d-m-Y', strtotime($jatuh_tempo)) }}
                            </td>
                            <td class="text-end">
                                <input type="text" name="jumlah[]" value="{{ formatAngka($d->jumlah) }}"
                                    class="noborder-form money jumlah text-end">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="2">TOTAL</td>
                        <td class="text-end" id="totalrencanapembiayaan">{{ formatAngka($total) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <button type="submit" class="btn btn-primary w-100" id="btnSimpan"><i class="ti ti-refresh me-1"></i>Update</button>
        </div>
    </div>
</form>

<script>
    $(function() {
        const form = $('#formEditRencanapembiayaan');
        $(".jumlah").maskMoney();

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

        function updateTotalPembiayaan() {
            let total = 0;
            form.find('.jumlah').each(function() {
                let jumlah = $(this).val().replace(/\./g, '');
                total += parseInt(jumlah);;
            });
            form.find('#totalrencanapembiayaan').text(convertToRupiah(total));
        }
        updateTotalPembiayaan();
        form.find('.jumlah').on('keyup keydown', function() {
            updateTotalPembiayaan();
        });

        form.submit(function(e) {
            let total_pembiayaan = form.find('#totalpembiayaan').text().replace(/\./g, '');
            let totalrencanapembiayaan = form.find('#totalrencanapembiayaan').text().replace(/\./g, '');
            // alert(total_pembiayaan);
            if (total_pembiayaan != totalrencanapembiayaan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Total Rencana Pembiayaan tidak sama dengan Total Pembiayaan!',
                    didClose: (e) => {
                        form.find('#totalrencanapembiayaan').focus();
                    }
                });
                return false;
            } else {
                $("#btnSimpan").attr('disabled', true);
                $("#btnSimpan").html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
                );
            }
        });
    })
</script>
