@foreach ($jobdesk as $d)
    <div class="card mb-1 border border-primary p-0 shadow" id="{{ Crypt::encrypt($d->id) }} }}">
        <div class="card-body p-3">
            <div class="d-flex">
                <div class="detail ms-2 btnShow" id="{{ Crypt::encrypt($d->kode_jobdesk) }}">
                    <h6 class="title m-0">{{ removehtmlTag($d->kode_jobdesk) }}</h6>
                    <p>{{ removehtmlTag($d->jobdesk) }}</p>
                </div>
                <div class="ms-auto">
                    <div class="d-flex">
                        <a href="{{ route('jobdesk.edit', Crypt::encrypt($d->kode_jobdesk)) }}" class="btn btn-primary btn-xs me-1">
                            <i class="ti ti-edit"></i>
                        </a>
                        <form method="POST" name="deleteform" class="deleteform {{ Crypt::encrypt($d->kode_jobdesk) }}"
                            action="{{ route('jobdesk.delete', Crypt::encrypt($d->kode_jobdesk)) }}">
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
