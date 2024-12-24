@foreach ($agendakegiatan as $d)
    <li class="timeline-item ps-4 border-left-dashed pb-1">
        <span class="timeline-indicator-advanced timeline-indicator-success">
            <i class="ti ti-calendar-event"></i>
        </span>
        <div class="timeline-event px-0 pb-0">
            <div class="timeline-header">
                <small class="text-success text-uppercase fw-medium">{{ $d->nama_kegiatan }}</small>
            </div>
            <h6 class="m-0">{!! truncateString(strip_tags($d->uraian_kegiatan, 30)) !!}</h6>
            <p class="text-muted mb-0">{{ DateToIndo($d->tanggal) }}</p>
            <span class="text-info d-flex gap-2">

                <span><i class="ti ti-user me-1 mb-1"></i> {{ $d->name }}</span>
                <span><i class="ti ti-building me-1 mb-1"></i> {{ $d->nama_dept }}</span>
            </span>
        </div>

    </li>
@endforeach
