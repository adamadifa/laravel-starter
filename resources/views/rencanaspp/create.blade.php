<form action="" id="formBuatrencanaspp">
    @csrf
    <input type="hidden" name="no_pendaftaran" value="{{ $no_pendaftaran }}" id="no_pendaftaran">
    <div class="form-group mb-3">
        <select name="kode_biaya" id="kode_biaya" class="form-select">
            <option value="">Tahun Ajaran</option>
            @foreach ($biayaSiswa as $d)
                <option value="{{ $d->kode_biaya }}">{{ $d->tahun_ajaran }}</option>
            @endforeach
        </select>
    </div>
    <x-input-with-icon label="Jumlah SPP" icon="ti ti-moneybag" name="jumlah_spp" money="true" textalign="right" readonly />
    <div class="form-group mb-3">
        <select name="mulai_pembayaran" id="mulai_pembayaran" class="form-select">
            <option value="">Mulai Pembayaran</option>
            @foreach ($list_bulan as $d)
                <option value="{{ $d['kode_bulan'] }}" {{ $d['kode_bulan'] == 7 ? 'selected' : '' }}>{{ $d['nama_bulan'] }}</option>
            @endforeach
        </select>
    </div>
    <x-input-with-icon label="Jumlah Bulan" icon="bi bi-cash" name="jumlah_bulan" textalign="right" value="12" />
    <x-input-with-icon label="Jumlah SPP / Bulan" icon="bi bi-cash" name="jumlah_spp_perbulan" money="true" textalign="right" readonly />

    {{-- <x-input-with-icon label="Total SPP" icon="ti ti-moneybag" name="total_spp" money="true" textalign="right" disabled /> --}}
    <button class="btn btn-primary w-100" type="submit"><i class="ti ti-progress me-1"></i> Generate</button>
</form>
<script>
    $(function() {
        $("#jumlah_spp_perbulan").maskMoney();
        const formRencanaspp = $("#formBuatrencanaspp");
        let jumlah_spp;

        function hitungsppperbulan() {
            let jumlah_spp = toNumber(formRencanaspp.find("#jumlah_spp").val());
            let jumlah_bulan = toNumber(formRencanaspp.find("#jumlah_bulan").val());
            let jumlah_spp_perbulan = parseInt(jumlah_spp) / parseInt(jumlah_bulan);
            formRencanaspp.find("#jumlah_spp_perbulan").val(convertToRupiah(Math.round(jumlah_spp_perbulan)));
        }

        formRencanaspp.find("#jumlah_bulan").keyup(function() {
            hitungsppperbulan();
        });


        function getSPP() {
            let kode_biaya = formRencanaspp.find("#kode_biaya").val();
            let no_pendaftaran = formRencanaspp.find("#no_pendaftaran").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('rencanaspp.getspp') }}",
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_biaya: kode_biaya,
                    no_pendaftaran: no_pendaftaran
                },
                success: function(response) {
                    if (response.status) {
                        formRencanaspp.find("#jumlah_spp").val(response.jumlah_spp);
                        hitungsppperbulan();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: response.message,
                            didClose: (e) => {
                                formRencanaspp.find("#kode_biaya").val('');
                                formRencanaspp.find("#kode_biaya").focus();
                            },
                        });
                    }

                },


            });
        }

        formRencanaspp.find("#kode_biaya").change(function() {
            getSPP();

        });

        // function hitungTotalSPP() {
        //     let jumlah_spp_perbulan = toNumber(formRencanaspp.find("#jumlah_spp_perbulan").val());
        //     let jumlah_bulan = toNumber(formRencanaspp.find("#jumlah_bulan").val());
        //     let total_spp = parseInt(jumlah_spp_perbulan) * parseInt(jumlah_bulan);
        //     formRencanaspp.find("#total_spp").val(convertToRupiah(total_spp));
        // }

        // formRencanaspp.find("#jumlah_spp_perbulan").keyup(function() {
        //     hitungTotalSPP();
        // });

        function toNumber(value) {
            let cleanValue = value.replace(/\./g, '');
            return cleanValue;
        }

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
    });
</script>
