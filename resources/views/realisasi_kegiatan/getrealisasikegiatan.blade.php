@foreach ($realisasikegiatan as $d)
    <div class="card mb-1 border border-primary p-0 shadow" id="{{ Crypt::encrypt($d->id) }} }}">
        <div class="card-body p-3">
            <div class="d-flex">
                <div class="img-thumbnail">
                    <i class="ti ti-calendar-event text-primary" style="font-size: 3rem"></i>
                </div>
                <div class="detail ms-2 btnShow" id="{{ Crypt::encrypt($d->id) }}">
                    <h5 class="title m-0">{{ $d->nama_kegiatan }}</h5>
                    <span class="m-0 text-muted">
                        <i class="ti ti-calendar me-1 mb-1"></i>
                        {{ DateToIndo($d->tanggal) }}
                    </span>
                    <p class="m-0">{!! truncateString(strip_tags($d->uraian_kegiatan), 50) !!}</p>
                    <span class="text-info"><i class="ti ti-user me-1 mb-1 "></i>{{ $d->name }}</span>
                </div>
                <div class="ms-auto">
                    <div class="d-flex">
                        <a href="{{ route('realisasikegiatan.edit', Crypt::encrypt($d->id)) }}" class="btn btn-primary btn-sm me-1">
                            <i class="ti ti-edit"></i>
                        </a>
                        <form method="POST" name="deleteform" class="deleteform"
                            action="{{ route('realisasikegiatan.delete', Crypt::encrypt($d->id)) }}">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="delete-confirm ml-1 btn btn-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endforeach
