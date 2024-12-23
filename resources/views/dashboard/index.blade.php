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

    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-body">Sales Overview</p>
                        <p class="card-text fw-medium text-success">+18.2%</p>
                    </div>
                    <h4 class="card-title mb-1">$42.5k</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-sm"></i></span>
                                <p class="mb-0">Order</p>
                            </div>
                            <h5 class="mb-0 pt-1 mb-1">62.2%</h5>
                            <small class="text-muted">6,440</small>
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
                                <p class="mb-0">Visits</p>
                                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-sm"></i></span>
                            </div>
                            <h5 class="mb-0 pt-1">25.5%</h5>
                            <small class="text-muted">12,749</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-6">
                        <div class="progress w-100" style="height: 10px;">
                            <div class="progress-bar bg-info" style="width: 70%" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
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
                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3">
                        <div class="card dark-bg">
                            <div class="card-body">
                                <div class="row mb-3">
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
                                        <h4 class="fw-normal mb-2">
                                            200.000
                                            <span class="small text-muted">RP</span>
                                        </h4>
                                        <p class="mb-0 text-muted size-12">
                                            2202-00024</p>
                                        <p class="text-muted size-12">Simpanan Pokok</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 3">
                        <div class="card theme-radial-gradient border-0">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-auto align-self-center">
                                        <i class="bi bi-wallet2"></i> Wallet
                                    </div>
                                    <div class="col align-self-center text-end">
                                        <p class="small">
                                            <span class="text-uppercase size-10">Validity</span><br>
                                            <span class="text-muted">Unlimited</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-normal mb-2">
                                            875.000
                                            <span class="small text-muted">RP</span>
                                        </h4>
                                        <p class="mb-0 text-muted size-12">
                                            2202-000244</p>
                                        <p class="text-muted size-12">Simpanan Wajib</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" role="group" aria-label="3 / 3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
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
                                        <h4 class="fw-normal mb-2">
                                            0
                                            <span class="small text-muted">RP</span>
                                        </h4>
                                        <p class="mb-0 text-muted size-12">
                                        </p>
                                        <p class="text-muted size-12">Simpanan Sukarela</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between pb-2">
                    <div class="card-title mb-1">
                        <h5 class="m-0 me-2">Orders</h5>
                        <small class="text-muted">62 Deliveries in Progress</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">New</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing" aria-selected="false"
                                    tabindex="-1">Preparing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping" aria-selected="false"
                                    tabindex="-1">Shipping</button>
                            </li>
                        </ul>
                        <div class="tab-content px-2 mx-1 pb-0">
                            <div class="tab-pane fade active show" id="navs-justified-new" role="tabpanel">
                                <ul class="timeline mb-0 pb-1">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Myrtle Ullrich</h6>
                                            <p class="text-muted mb-0">101 Boulder, California(CA), 95959</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Barry Schowalter</h6>
                                            <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Veronica Herman</h6>
                                            <p class="text-muted mb-0">162 Windsor, California(CA), 95492</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Helen Jacobs</h6>
                                            <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                                <ul class="timeline mb-0 pb-1">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Barry Schowalter</h6>
                                            <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Myrtle Ullrich</h6>
                                            <p class="text-muted mb-0">101 Boulder, California(CA), 95959 </p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Veronica Herman</h6>
                                            <p class="text-muted mb-0">162 Windsor, California(CA), 95492</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Helen Jacobs</h6>
                                            <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                                <ul class="timeline mb-0 pb-1">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Veronica Herman</h6>
                                            <p class="text-muted mb-0">101 Boulder, California(CA), 95959</p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Barry Schowalter</h6>
                                            <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                <ul class="timeline mb-0">
                                    <li class="timeline-item ps-4 border-left-dashed pb-1">
                                        <span class="timeline-indicator-advanced timeline-indicator-success">
                                            <i class="ti ti-circle-check"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-success text-uppercase fw-medium">sender</small>
                                            </div>
                                            <h6 class="mb-1">Myrtle Ullrich</h6>
                                            <p class="text-muted mb-0">162 Windsor, California(CA), 95492 </p>
                                        </div>
                                    </li>
                                    <li class="timeline-item ps-4 border-transparent">
                                        <span class="timeline-indicator-advanced timeline-indicator-primary">
                                            <i class="ti ti-map-pin"></i>
                                        </span>
                                        <div class="timeline-event px-0 pb-0">
                                            <div class="timeline-header">
                                                <small class="text-primary text-uppercase fw-medium">Receiver</small>
                                            </div>
                                            <h6 class="mb-1">Helen Jacobs</h6>
                                            <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                                        </div>
                                    </li>
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
@endpush
