@foreach ($jadwalkerja as $d)
    <div class="card mb-2">
        <div class="card-body d-flex" style="padding: 10px; !important">
            <div>
                <img class="card-img  " src="../../assets/img/elements/9.jpg" alt="Card image" style="width: 60px; height: auto;">
            </div>
            <div class="ms-2">
                <h6 class="m-0">{{ $d->npp }}</h6>
                <h7>{{ textUpperCase($d->nama_lengkap) }}</h7>
            </div>
        </div>
    </div>
@endforeach
