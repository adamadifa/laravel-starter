@extends('layouts.mobile.app')
<style>
    #section-header {
        background: linear-gradient(135deg, #187938 0%, #3ac79b 100%);
        height: 25%;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-image: url("{{ asset('assets/template/img/creditcard2.png') }}");
        background-size: cover;
    }

    #section-transaction {
        height: 70%;
        background-color: #dff9fb;
    }

    #section-logout {
        position: absolute;
        top: 15px;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .logout-btn,
    .back-btn {
        color: white;
        font-size: 30px;
        text-decoration: none;
        margin: 0px 10px;
    }



    .logout-btn:hover {
        color: var(--color-nav-hover);

    }

    .transactions {
        padding: 0px 10px;
        /* background-color: red; */
        height: calc(100vh - 270px);
        overflow: scroll;
    }

    .transactions .item {
        background: #ffffff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.09);
        border-radius: 10px;
        padding: 20px 24px;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        justify-content: space-between;

    }

    .transactions .item:last-child {
        margin-bottom: 0
    }

    .transactions .item p {
        font-size: 14px;
        margin: 0;
        color: #958d9e;
        font-weight: 500
    }

    .transactions .item .detail {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        line-height: 1.2em;
        gap: 10px
    }

    .transactions .item .detail .image-block {
        margin-right: 16px
    }

    .transactions .item .detail strong {
        display: block;
        font-weight: 500;
        color: #27173E;
        margin-bottom: 3px
    }

    .transactions .item .right {
        padding-left: 10px
    }

    .transactions .item .right .price {
        font-weight: 700;
        color: #27173E;
        letter-spacing: -0.03em
    }

    .avatar {
        position: relative;
        width: 2.5rem;
        height: 2.5rem;
        cursor: pointer;
    }

    .avatar-sm {
        width: 2rem;
        height: 2rem;
    }

    .avatar-sm .avatar-initial {
        font-size: .8125rem;
    }

    .avatar .avatar-initial {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background-color: #eeedf0;
        font-size: .9375rem;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .bg-label-warning {
        background-color: #fff0e1 !important;
        color: #ff9f43 !important;
    }
</style>
@section('content')
    <div id="section-header">
        <div id="section-logout">
            <a href="/proseslogout" class="back-btn">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
            <a href="/proseslogout" class="logout-btn">
                <ion-icon name="exit-outline"></ion-icon>
            </a>
        </div>
        <div id="section-saldo" class="mt-5  text-center">
            <h1 class="fw-bold text-white mb-3" style="line-height: 0px; font-size:60px" id="saldo">{{ formatAngka($saldo_simpanan->jumlah) }}</h1>
            <span class="text-white">Saldo {{ $saldo_simpanan->jenis_simpanan }}</span>
        </div>
    </div>
    <div class="transactions mt-2">
        <!-- item -->
        @foreach ($mutasi as $d)
            <a href="app-transaction-detail.html" class="item">
                <div class="detail">
                    <div class="avatar-wrapper">
                        <div class="avatar avatar-sm me-4"><span class="avatar-initial rounded-circle bg-label-warning">VK</span></div>
                    </div>
                    <div>
                        <strong>{{ DateToIndo($d->tanggal) }}</strong>
                        <p>{{ $d->jenis_transaksi == 'S' ? 'Setoran' : 'Penarikan' }}</p>
                    </div>
                </div>
                <div class="right">
                    <div class="price {{ $d->jenis_transaksi == 'S' ? 'text-success' : 'text-dangger' }}"> {{ $d->jenis_transaksi == 'S' ? '+' : '-' }}
                        {{ formatAngka($d->jumlah) }}</div>
                </div>
            </a>
        @endforeach

    </div>
@endsection
