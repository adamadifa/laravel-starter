@if (auth()->user()->hasAnyPermission(['ledger.index', 'kategoripemasukan.index']))
    <ul class="nav nav-tabs" role="tablist">

        @can('ledger.index')
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link {{ request()->is(['saledger']) ? 'active' : '' }}">
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
        @can('kategoripemasukan.index')
            <li class="nav-item" role="presentation">
                <a href="{{ route('kategoripemasukan.index') }}" class="nav-link {{ request()->is(['kategoripemasukan']) ? 'active' : '' }}">
                    <i class="tf-icons ti ti-file-description ti-md me-1"></i>Kategori Pemasukan
                </a>
            </li>
        @endcan

        @can('kategoripengeluaran.index')
            <li class="nav-item" role="presentation">
                <a href="{{ route('kategoripengeluaran.index') }}" class="nav-link {{ request()->is(['kategoripengeluaran']) ? 'active' : '' }}">
                    <i class="tf-icons ti ti-file-description ti-md me-1"></i>Kategori Pengeluaran
                </a>
            </li>
        @endcan
    </ul>
@endif
