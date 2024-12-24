<h5 class="title m-0">{{ $realisasi->nama_kegiatan }}</h5>
<span class="text-muted">
    <i class="ti ti-calendar mb-1"></i> {{ DateToIndo($realisasi->tanggal) }}
</span>
<p class="m-0">
    {!! $realisasi->uraian_kegiatan !!}
</p>
@if (!empty($realisasi->foto))
    @php
        $path = Storage::url('realisasikegiatan/' . $realisasi->kode_dept . '/' . $realisasi->foto);
    @endphp
    <img src="{{ url($path) }}" class="img-fluid h-50 rounded" alt="">
@else
    <img src="{{ asset('assets/img/marker/default.png') }}" alt="">
@endif
