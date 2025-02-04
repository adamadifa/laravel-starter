<form action="{{ route('karyawan.updateharikerja', Crypt::encrypt($karyawan->npp)) }}" method="POST" id="formSetharikerja">
    @csrf
    @method('PUT')
    <div class="row">
        <table class="table">
            <tr>
                <th>NPP</th>
                <td>{{ $karyawan->npp }}</td>
            </tr>
            <tr>
                <th>Nama Karyawan</th>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="harisenin"> Senin </label>
                    <input class="form-check-input harisenin" name="hari[]" value="Senin" type="checkbox" id="harisenin"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'senin') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hariselasa"> Selasa </label>
                    <input class="form-check-input hariselasa" name="hari[]" value="Selasa" type="checkbox" id="hariselasa"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'selasa') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="harirabu"> Rabu </label>
                    <input class="form-check-input harirabu" name="hari[]" value="Rabu" type="checkbox" id="harirabu"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'rabu') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="harikamis"> Kamis </label>
                    <input class="form-check-input harikamis" name="hari[]" value="Kamis" type="checkbox" id="harikamis"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'kamis') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="harijumat"> Jumat </label>
                    <input class="form-check-input harijumat" name="hari[]" value="Jumat" type="checkbox" id="harijumat"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'jumat') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="harisabtu"> Sabtu </label>
                    <input class="form-check-input harisabtu" name="hari[]" value="Sabtu" type="checkbox" id="harisabtu"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'sabtu') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="hariminggu"> Minggu </label>
                    <input class="form-check-input hariminggu" name="hari[]" value="Minggu" type="checkbox" id="hariminggu"
                        {{ str_contains(strtolower($karyawan->hari_kerja), 'minggu') ? 'checked' : '' }}>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <button class="btn btn-primary w-100" type="submit" id="btnUpdateHariKerja"><i class="ti ti-refresh me-1"></i>Update Hari Kerja</button>
        </div>
    </div>
</form>

<script>
    $(function() {
        $("#formSetharikerja").submit(function(e) {
            $("#btnUpdateHariKerja").attr("disabled", true);
            $("#btnUpdateHariKerja").html(
                `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...`
            );
        });
    })
</script>
