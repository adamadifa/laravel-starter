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
        <div class="dark-bg">
            <div class="row mb-1">
                <div class="col-auto align-self-center">
                    <img src="https://sip.persisalamin.com/assets-mobile/img/masterocard.png" alt="">
                </div>
                <div class=" col align-self-center text-right">
                    <p class="small">
                        <span class="text-uppercase" style="font-size: 20px">Validity</span><br>
                        <span class="text-white" style="font-size: 16px">Unlimited</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-1 text-white">
                        200.000
                        <span class="small text-muted">Rp</span>
                    </h1>
                    <p class="mb-0 text-muted size-12">
                        1222-12211-12112
                    <p class="text-muted size-12">Simpanan</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div
                    class="swiper-container cardswiper swiper-container-initialized swiper-container-horizontal swiper-container-ios swiper-container-pointer-events">
                    <div class="swiper-wrapper" id="swiper-wrapper-e7c52537e6cf4732" aria-live="polite"
                        style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
