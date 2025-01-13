@if (count($program_kerja) == 0)
    <div class="alert alert-warning">
        Tidak ada data program kerja. Silakan tambah baru.
    </div>
@else
    @foreach ($program_kerja as $d)
        <div class="card mb-1 border border-primary p-0 shadow" id="{{ Crypt::encrypt($d->kode_program_kerja) }} }}">
            <div class="card-body p-3">
                <div class="d-flex">
                    <div class="detail ms-2 btnShow" id="{{ Crypt::encrypt($d->kode_program_kerja) }}">
                        <h6 class="title m-0">{{ removehtmlTag($d->program_kerja) }}</h6>
                        <p>{{ removehtmlTag($d->target_pencapaian) }}</p>
                        <span class="text-info d-flex gap-2 mt-1">
                            <span><i class="ti ti-user me-1 mb-1"></i> {{ formatNama1($d->name) }}</span>
                            <span><i class="ti ti-building me-1 mb-1"></i> {{ $d->kode_dept }}</span>
                        </span>
                    </div>
                    <div class="ms-auto">
                        <div class="d-flex">
                            <a href="{{ route('programkerja.edit', Crypt::encrypt($d->kode_program_kerja)) }}" class="btn btn-primary btn-xs me-1">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form method="POST" name="deleteform" class="deleteform {{ Crypt::encrypt($d->kode_program_kerja) }}"
                                action="{{ route('programkerja.delete', Crypt::encrypt($d->kode_program_kerja)) }}">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="delete-confirm ml-1 btn btn-danger btn-xs">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
