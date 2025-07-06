<li class="menu-item">
    <a href="{{ route('transaksi.list') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-building-store"></i>
        <div>Data Transaksi</div>
    </a>
</li>
<li class="menu-item">
    <a href="{{ route('master_produk.index') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-database"></i>
        <div>Master Produk</div>
    </a>
</li>
<li class="menu-item">
    <a href="{{ route('master_category.index') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-database"></i>
        <div>Master Kategori</div>
    </a>
</li>
@if (auth()->user()->role == 'admin')
    <li class="menu-item">
        <a href="{{ route('master_user.index') }}" class="menu-link">
            <i class="menu-icon icon-base ti tabler-users-group"></i>
            <div>Master User</div>
        </a>
    </li>
@endif
<li class="menu-item">
    <a href="{{ route('laporan_keuangan.index') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-report-analytics"></i>
        <div>Laporan Keuangan</div>
    </a>
<li class="menu-item">
    <a href="{{route('profil.index', ['id' => auth()->user()->id])}}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-user"></i>
        <div>Profil</div>
    </a>
</li>
