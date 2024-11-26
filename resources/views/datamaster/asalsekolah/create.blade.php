<form action="{{ route('asalsekolah.store') }}" aria-autocomplete="false" id="formAsalSekolah" method="POST">
    <x-input-with-icon icon="ti ti-user" label="Nama Sekolah" name="nama_sekolah" />
    <div class="form-group mb-3">
        <select name="status_sekolah" id="status_sekolah" class="form-select">
            <option value="">Status Sekolah</option>
            <option value="S">Swasta</option>
            <option value="N">Negeri</option>
        </select>
    </div>
    <x-input-with-icon icon="ti ti-map-pin" label="Kabupaten / Kota" name="kota" />
    <div class="form-group mb-3">
        <button class="btn btn-primary w-100" type="submit" id="btnSimpan"><i class="ti ti-send me-1"></i>Submit</button>
    </div>
</form>
<script>
    $(function() {
        const formAsalSekolah = $('#formAsalSekolah');

        function buttonDisable() {
            $("#btnSimpan").prop("disabled", true);
            $("#btnSimpan").html(`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`);
        }

        function loadasalsekolah() {
            const kode_unit = $("#formPendaftaran").find("#kode_unit").val();
            const kode_sekolah = 0;
            $("#kode_asal_sekolah").load(`/asalsekolah/${kode_unit}/${kode_sekolah}/getasalsekolahbyunit`);
        }

        formAsalSekolah.submit(function(e) {
            e.preventDefault();
            const nama_sekolah = formAsalSekolah.find("#nama_sekolah").val();
            const status_sekolah = formAsalSekolah.find("#status_sekolah").val();
            const kota = formAsalSekolah.find("#kota").val();
            const kode_unit = $("#kode_unit").val();

            if (nama_sekolah == "") {
                Swal.fire({
                    title: "Oops!",
                    text: "Nama Sekolah Harus Diisi !",
                    icon: "warning",
                    showConfirmButton: true,
                    didClose: (e) => {
                        formAsalSekolah.find("#nama_sekolah").focus();
                    },
                });
                return false;
            } else if (status_sekolah == "") {
                Swal.fire({
                    title: "Oops!",
                    text: "Status Sekolah Harus Diisi !",
                    icon: "warning",
                    showConfirmButton: true,
                    didClose: (e) => {
                        formAsalSekolah.find("#status_sekolah").focus();
                    },
                });
                return false;
            } else if (kota == "") {
                Swal.fire({
                    title: "Oops!",
                    text: "Kota Harus Diisi !",
                    icon: "warning",
                    showConfirmButton: true,
                    didClose: (e) => {
                        formAsalSekolah.find("#kota").focus();
                    },
                });
                return false;
            } else {
                buttonDisable();
                $.ajax({
                    type: "POST",
                    url: "{{ route('asalsekolah.store') }}",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nama_sekolah: nama_sekolah,
                        status_sekolah: status_sekolah,
                        kota: kota,
                        kode_unit: kode_unit
                    },
                    success: function(respond) {
                        console.log(respond.status);
                        if (respond.status == true) {
                            formAsalSekolah.trigger("reset");
                            $("#btnSimpan").prop("disabled", false);
                            $("#btnSimpan").html(`<i class="ti ti-send me-1"></i>Submit`);
                            Swal.fire({
                                title: "Success",
                                text: respond.message,
                                icon: "success",
                                showConfirmButton: true,
                                didClose: (e) => {
                                    loadasalsekolah();
                                    $("#modalSekolah").modal("hide");
                                }
                            });
                        } else {
                            $("#btnSimpan").prop("disabled", false);
                            $("#btnSimpan").html(`<i class="ti ti-send me-1"></i>Submit`);
                            Swal.fire({
                                title: "Oops!",
                                text: respond.message,
                                icon: "error",
                                showConfirmButton: true
                            });
                        }
                    }
                });
            }
        });
    });
</script>
