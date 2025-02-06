@extends('layouts.mobile.app')
@section('content')
    <style>
        #section-user {
            display: flex;
            align-items: center;
            gap: 10px
        }

        #user-info {
            margin-left: 0px !important;
            line-height: 2px;
        }

        #user-info h3 {
            color: var(--bg-indicator);
        }

        #user-info span {
            color: var(--color-nav);
        }

        #header {
            height: 100px;
            padding: 0px 20px 0px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #section-card {
            padding: 0px 20px 0px 20px;
        }

        .swiper-slide {
            width: 85% !important;
        }
    </style>
    <div id="header">
        <div id="section-user">
            <div class="avatar">
                <img src="{{ asset('assets/template/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w32 rounded">
            </div>
            <div id="user-info">
                <h3 id="user-name">{{ $karyawan->nama_lengkap }}👋</h3>
                <span id="user-role">{{ $karyawan->nama_jabatan }}</span>
                <span id="user-role">({{ $karyawan->nama_unit }})</span>
            </div>
        </div>
        <div id="section-logout">
            <a href="/proseslogout" class="logout-btn">
                <ion-icon name="exit-outline"></ion-icon>
            </a>
        </div>
    </div>
    <div id="#section-card">
        <div class="row">
            <div class="col">
                <div class="card dark-bg">
                    <img src="{{ asset('assets/template/img/tsarwah.png') }}" alt="" class="imaged"
                        style="position: absolute; top:75px; right:30px; width: 55px">
                    <div class="row mt-3 mr-3">
                        <div class=" col align-self-center text-right">
                            <p class="text-uppercase mb-3" style="font-size: 20px;line-height: 0px">Validity</p>
                            <p class="text-white" style="font-size: 16px; line-height: 0px">Unlimited</p>
                        </div>
                    </div>
                    <div class="row align-items-center mt-5">
                        <div class="col text-center">
                            <h1 class="text-white mb-2" style="line-height: 0px">
                                {{ formatAngka($saldosimpanan->total_saldo) }}
                            </h1>
                            <h3 class="mb-0 text-white">
                                {{ $saldosimpanan->no_anggota }}
                            </h3>
                            <span class="text-white mt-5" style="font-size: 18px">
                                SIMPANAN KOPERASI
                            </span>
                        </div>
                    </div>
                    <div class="row mt-3" style="padding-top:10px">
                        <div class="col align-self-center text-center">
                            <h4 class="text-white">KOPONTREN TSARWAH AL AMIN</h4>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div
                            class="swiper-container cardswiper swiper-container-initialized swiper-container-horizontal swiper-container-ios swiper-container-pointer-events">
                            <div class="swiper-wrapper" id="swiper-wrapper-e7c52537e6cf4732" aria-live="polite"
                                style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                @foreach ($saldo_simpanan as $s)
                                    <div class="swiper-slide {{ $loop->first ? 'swiper-slide-active' : '' }}" role="group"
                                        aria-label="{{ $loop->index }} / {{ count($saldo_simpanan) }} }}">
                                        <div class="card theme-radial-gradient" style="width: 300px; margin-right:30px">
                                            <div class="card-body p-3 pb-2">
                                                <div class="row mb-1">
                                                    <div class="col-auto align-self-center">
                                                        <img src="https://sip.persisalamin.com/assets-mobile/img/masterocard.png" alt="">
                                                    </div>
                                                    <div class=" col align-self-center text-right">
                                                        <p class="small">
                                                            <span class="text-uppercase text-white" style="font-size: 16px">Validity</span><br>
                                                            <span class="text-white" style="font-size: 14px">Unlimited</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="fw-normal mb-1 text-white">
                                                            {{ formatAngka($s->jumlah) }}
                                                            <span class="text-white" style="font-size: 12px">Rp</span>
                                                        </h2>
                                                        <p class="mb-0 text-white" style="font-weight: 24px">
                                                            {{ $s->kode_simpanan }}</p>
                                                        <p class="text-white" style="font-weight: 24px;">{{ $s->jenis_simpanan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
