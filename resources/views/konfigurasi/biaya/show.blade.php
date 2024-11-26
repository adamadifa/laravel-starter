<div class="row">
  <div class="col">
    <table class="table">
      <tr>
        <th>Jenjang / Unit</th>
        <td>{{ $biaya->nama_unit }}</td>
      </tr>
      <tr>
        <th>Tingkat</th>
        <td>{{ $biaya->tingkat }}</td>
      </tr>
      <tr>
        <th>Tahun Ajaran</th>
        <td>{{ $biaya->tahun_ajaran }}</td>
      </tr>
    </table>
  </div>
</div>
<div class="divider text-start">
  <div class="divider-text">Detail Biaya</div>
</div>

<table class="table table-bordered" id="tabledetail">
  <thead class="table-dark">
    <tr>
      <th>Kode</th>
      <th>Jenis Biaya</th>
      <th style="width: 25%">Jumlah</th>
    </tr>
  </thead>
  <tbody id="loaddetail">
    @foreach ($detail as $d)
      <tr>
        <td>{{ $d->kode_jenis_biaya }}</td>
        <td>{{ textUpperCase($d->jenis_biaya) }}</td>
        <td class="text-end">{{ formatAngka($d->jumlah) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
