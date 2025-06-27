<li class="menu-item">
    <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-building-store"></i>
        <div>POS</div>
    </a>
</li>
<li class="menu-item">
    <a href="#" class="menu-link">
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
<li class="menu-item">
    <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-report-analytics"></i>
        <div>Laporan Penjualan</div>
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
    <a href="laporan keuangan" class="menu-link">
        <i class="menu-icon icon-base ti tabler-report-analytics"></i>
        <div>Laporan Pengeluaran</div>
    </a>
<li class="menu-item">
    <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-user"></i>
        <div>Profil</div>
    </a>
</li>
