@extends('layouts.app')
@section('titlepage', 'Dashboard')
@section('content')
    {{-- <style>
        .table-modal {
            height: auto;
            max-height: 550px;
            overflow-y: scroll;

        }
    </style> --}}
    <style>
        .detail {
            cursor: pointer;
        }
    </style>


    {{-- <div class="w-100" style="height: 30%; background-color: #144725">
        <div class="section-1 d-flex justify-content-between m-3">
            <div class="welcome-section  w-100">
                <h3 class="text-white">Selamat Datang, <br>{{ auth()->user()->name }}</h3>
            </div>
            <div class="avatar-section d-flex justify-content-end">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle w-100" />
            </div>
        </div>

    </div> --}}
    @hasanyrole(['super admin', 'pimpinan pesantren'])
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0 text-body">Saldo</p>
                            <p class="card-text fw-medium text-success"></p>
                        </div>
                        <h4 class="card-title mb-1">Rp. 1.000.000.000</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">
                                <div class="d-flex gap-2 align-items-center mb-2">
                                    <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-sm"></i></span>
                                    <p class="mb-0">Pemasukan</p>
                                </div>
                                {{-- <h5 class="mb-0 pt-1 mb-1">62.2%</h5> --}}
                                <small class="text-muted">5.000.000</small>
                            </div>
                            <div class="col-4">
                                <div class="divider divider-vertical">
                                    <div class="divider-text">
                                        <span class="badge-divider-bg bg-label-secondary">VS</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                    <p class="mb-0">Pengeluaran</p>
                                    <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-sm"></i></span>
                                </div>
                                {{-- <h5 class="mb-0 pt-1">25.5%</h5> --}}
                                <small class="text-muted">2.000.000</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-6">
                            <div class="progress w-100" style="height: 10px;">
                                <div class="progress-bar bg-primary" style="width: 70%" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-12 px-0">
                <div
                    class="swiper-container cardswiper swiper-container-initialized swiper-container-horizontal swiper-container-ios swiper-container-pointer-events">
                    <div class="swiper-wrapper" id="swiper-wrapper-e7c52537e6cf4732" aria-live="polite"
                        style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">

                        @foreach ($ledger as $l)
                            <div class="swiper-slide {{ $loop->first ? 'swiper-slide-active' : '' }}" role="group"
                                aria-label="{{ $loop->index }} / {{ count($ledger) }} }}">
                                <div class="card dark-bg">
                                    <div class="card-body p-3 pb-2">
                                        <div class="row mb-1">
                                            <div class="col-auto align-self-center">
                                                <img src="https://sip.persisalamin.com/assets-mobile/img/masterocard.png" alt="">
                                            </div>
                                            <div class=" col align-self-center text-end">
                                                <p class="small">
                                                    <span class="text-uppercase size-10">Validity</span><br>
                                                    <span class="text-muted">Unlimited</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="fw-normal mb-1">
                                                    200.000
                                                    <span class="small text-muted">Rp</span>
                                                </h4>
                                                <p class="mb-0 text-muted size-12">
                                                    {{ $l->no_rekening }}</p>
                                                <p class="text-muted size-12">{{ $l->nama_ledger }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    @endhasanyrole
    <div class="row mt-2">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header pb-2">
                    <div class="card-title mb-1">
                        <h5 class="m-0 me-2">Agenda & Realisasi Kegiatan</h5>
                        <div class="form-group mt-3">
                            <select name="kode_dept" id="kode_dept" class="form-select select2Kodedept">
                                <option value="">Departemen</option>
                                @foreach ($departemen as $d)
                                    <option value="{{ $d->kode_dept }}">{{ strtoupper($d->nama_dept) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-input-with-icon icon="ti ti-calendar" label="Tanggal" name="dari" datepicker="flatpickr-date"
                                    value="{{ date('Y-m-d') }}" />
                            </div>
                            <div class="col">
                                <x-input-with-icon icon="ti ti-calendar" label="Tanggal" name="sampai" datepicker="flatpickr-date"
                                    value="{{ date('Y-m-d') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">Agenda
                                    Kegiatan</button>

                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing" aria-selected="false"
                                    tabindex="-1">Realisasi Kegiatan</button>
                            </li>
                        </ul>
                        <div class="tab-content px-2 mx-1 pb-0">
                            <div class="tab-pane fade active show" id="navs-justified-new" role="tabpanel">
                                <ul class="timeline mb-0 pb-1" id="getagendakegiatan">

                                </ul>

                            </div>

                            <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                                <ul class="timeline mb-0 pb-1" id="getrealisasikegiatan">

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal-form id="modal" show="loadmodal" title="Detail Aktifitas" size="modal-lg" />
@endsection
@push('myscript')
    <script>
        $(function() {
            function getrealisasikegiatan() {
                // alert('test');
                let dari = $('#dari').val();
                let sampai = $('#sampai').val();
                let kode_dept = $('#kode_dept').val();
                $("#getrealisasikegiatan").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
                $.ajax({
                    method: "POST",
                    url: "{{ route('dashboard.getrealisasikegiatan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        dari: dari,
                        sampai: sampai,
                        kode_dept: kode_dept
                    },
                    cache: false,
                    success: function(data) {
                        $('#getrealisasikegiatan').html(data);
                    }
                })
            }

            function getagendakegiatan() {
                // alert('test');
                let dari = $('#dari').val();
                let sampai = $('#sampai').val();
                let kode_dept = $('#kode_dept').val();
                $("#getrealisasikegiatan").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
                $.ajax({
                    method: "POST",
                    url: "{{ route('dashboard.getagendakegiatan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        dari: dari,
                        sampai: sampai,
                        kode_dept: kode_dept
                    },
                    cache: false,
                    success: function(data) {
                        $('#getagendakegiatan').html(data);
                    }
                })
            }

            $("#kode_dept, #dari, #sampai").on('change', function() {
                getrealisasikegiatan();
                getagendakegiatan();
            });
            getrealisasikegiatan();
            getagendakegiatan();
        });
    </script>
@endpush
