<h5 class="title m-0">{{ $agenda->nama_kegiatan }}</h5>
<span class="text-muted">
    <i class="ti ti-calendar mb-1"></i> {{ DateToIndo($agenda->tanggal) }}
</span>
<p class="m-0">
    {!! $agenda->uraian_kegiatan !!}
</p>
