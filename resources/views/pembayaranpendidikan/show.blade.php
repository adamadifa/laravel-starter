<div class="row">
    <div class="col-md-12 text-end">
        Nomor Pendaftaran : <span class="fw-bold">{{ $pendaftaran->no_pendaftaran }}</span>
    </div>
</div>
<style>
    .table-report td {
        border: none !important;
        padding: 2px 5px !important;
    }
</style>
<div class="row">
    <div class="col">
        <table class="table table-report" style="width: auto !important; ">

            <tr>
                <td rowspan="6" style="width: 15%">
                    <img src="{{ asset('assets/img/avatars/No_Image_Available.jpg') }}" alt="" class="img-thumbnail rounded ">
                </td>
                <td style="width:20%">NISN</td>
                <td style="width: 1%">:</td>
                <td style="width: 48%">{{ $pendaftaran->nisn }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $pendaftaran->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Tempat / Tanggal Lahir</td>
                <td>:</td>
                <td>{{ textCamelCase($pendaftaran->tempat_lahir) }}, {{ DateToIndo($pendaftaran->tanggal_lahir) }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>:</td>
                <td>{{ $pendaftaran->nama_unit }}</td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td>{{ $pendaftaran->tahun_ajaran }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="nav-align-top  mb-6">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active waves-effect" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><span
                            class="d-none d-sm-block"> Detail Biaya</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                        aria-controls="navs-justified-profile" aria-selected="false" tabindex="-1"><span class="d-none d-sm-block"> SPP</span><i
                            class="ti ti-user ti-sm d-sm-none"></i></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages"
                        aria-controls="navs-justified-messages" aria-selected="false" tabindex="-1"><span class="d-none d-sm-block">
                            Pembayaran</span></button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Biaya</th>
                                <th>Jumlah</th>
                                <th>Potongan</th>
                                <th>Total</th>
                                <th>Mutasi</th>
                                <th>Bayar</th>
                                <th>Tagihan</th>
                            </tr>
                        </thead>
                        <tbody class="tabelbiaya"></tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" id="buatrencanaspp"
                                no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}">Buat Rencana
                                SPP</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tagihan</th>
                                        <th>Bayar</th>
                                        <th>Sisa</th>
                                        <th>Jatuh Tempo</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelrencanaspp">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-primary" id="btnBayar"
                                no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}">
                                <i class="ti ti-zoom-money me-1"></i>
                                Input Pembayaran
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No. Bukti</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Petugas</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelhistoribayar"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
