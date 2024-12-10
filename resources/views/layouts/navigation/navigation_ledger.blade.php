@if (auth()->user()->hasAnyPermission(['ledger.index', 'kategoripemasukan.index']))
    <ul class="nav nav-tabs" role="tablist">

        @can('saldoawalledger.index')
            <li class="nav-item" role="presentation">
                <a href="{{ route('saldoawalledger.index') }}" class="nav-link {{ request()->is(['saldoawalledger']) ? 'active' : '' }}">
                    <i class="tf-icons ti ti-file-description ti-md me-1"></i> Saldo Awal
                </a>
            </li>
        @endcan

        @can('ledger.index')
            <li class="nav-item" role="presentation">
                <a href="{{ route('ledger.index') }}" class="nav-link {{ request()->is(['ledger']) ? 'active' : '' }}">
                    <i class="tf-icons ti ti-file-description ti-md me-1"></i> Ledger
                </a>
            </li>
        @endcan
        @can('kategoriledger.index')
            <li class="nav-item" role="presentation">
                <a href="{{ route('kategoriledger.index') }}" class="nav-link {{ request()->is(['kategoriledger']) ? 'active' : '' }}">
                    <i class="tf-icons ti ti-file-description ti-md me-1"></i>Kategori
                </a>
            </li>
        @endcan


    </ul>
@endif
