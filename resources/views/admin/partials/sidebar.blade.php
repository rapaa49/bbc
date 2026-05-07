@php
    $activeMenu = $activeMenu ?? '';
    $pendingCount = $pendingCount ?? 0;

    $adminUser = auth('admin')->user();
    $adminName = $adminUser->name ?? $adminUser->username ?? 'Admin';
    $adminEmail = $adminUser->email ?? '';

    $menuTitles = [
        'dashboard' => 'Dashboard',
        'menu' => 'Menu Management',
        'pesanan' => 'Pesanan',
        'laporan' => 'Laporan Penjualan',
        'testimoni' => 'Testimoni',
        'admin' => 'Kelola Admin',
    ];
    $activeTitle = $menuTitles[$activeMenu] ?? 'Dashboard';

    $adminInitials = collect(explode(' ', trim((string) $adminName)))
        ->filter()
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');

    if ($adminInitials === '') {
        $adminInitials = 'AD';
    }
@endphp

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .sidebar.admin-sidebar {
        width: 272px;
        background: #ffffff;
        border-right: 1px solid #e2e8f0;
        box-shadow: 0 18px 40px rgba(45, 55, 72, 0.10);
        font-family: 'Poppins', sans-serif;
        position: fixed;
        height: 100vh;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        top: 0;
        left: 0;
    }

    .sidebar.admin-sidebar .sidebar-top {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 18px 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .sidebar.admin-sidebar .brand-logo {
        display: block;
        width: 72px;
        height: 72px;
        object-fit: contain;
        flex: 0 0 auto;
        border-radius: 0;
        background: transparent;
        border: none;
        padding: 0;
        filter: drop-shadow(0 8px 16px rgba(45, 55, 72, 0.10));
    }

    .sidebar.admin-sidebar .brand-title {
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.3px;
        color: #2D3748;
        line-height: 1.2;
    }

    .sidebar.admin-sidebar .brand-subtitle {
        margin-top: 4px;
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .sidebar.admin-sidebar .menu {
        display: flex;
        flex-direction: column;
        padding: 14px 0 12px;
    }

    .sidebar.admin-sidebar .menu-item {
        display: flex;
        align-items: center;
        margin: 5px 10px;
        border-radius: 14px;
        border-left: 0;
        color: #475569;
        font-weight: 600;
        padding: 13px 14px;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, color 0.22s ease;
    }

    .sidebar.admin-sidebar .menu-item i {
        width: 18px;
        margin-right: 10px;
        font-size: 15px;
        color: inherit;
    }

    .sidebar.admin-sidebar .menu-item:hover {
        background: #f1f5f9;
        color: #dc2626;
        transform: translateX(2px);
    }

    .sidebar.admin-sidebar .menu-item.active {
        background: linear-gradient(90deg, #8B0000 0%, #a70f0f 100%);
        color: #fff;
        box-shadow: 0 10px 22px rgba(139, 0, 0, 0.22);
    }

    .sidebar.admin-sidebar .menu-item.active::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(255,255,255,0.18), transparent 35%, rgba(255,255,255,0.10));
        pointer-events: none;
    }

    .sidebar.admin-sidebar .pending-badge {
        margin-left: auto;
        background: rgba(255,255,255,0.96);
        color: #8B0000;
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(139, 0, 0, 0.12);
        border: none;
    }

    .sidebar.admin-sidebar .user-info {
        display: flex;
        align-items: center;
        border-top: 1px solid #e2e8f0;
        padding: 14px 14px 16px;
        gap: 12px;
        margin: auto 12px 12px;
        border-radius: 16px;
        background: #f8fafc;
        box-shadow: 0 10px 22px rgba(45, 55, 72, 0.06);
        border: none;
    }

    .sidebar.admin-sidebar .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 999px;
        background: linear-gradient(135deg, #8B0000 0%, #DAA520 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        letter-spacing: 0.4px;
        flex: 0 0 auto;
        box-shadow: 0 8px 18px rgba(139, 0, 0, 0.18);
        border: none;
    }

    .sidebar.admin-sidebar .user-name {
        font-size: 13px;
        color: #2D3748;
        font-weight: 700;
    }

    .sidebar.admin-sidebar .user-role {
        font-size: 11px;
        color: #64748b;
        font-weight: 600;
        margin-top: 2px;
    }

    .sidebar.admin-sidebar .user-email {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 2px;
    }

    @media (max-width: 992px) {
        .sidebar.admin-sidebar {
            position: static;
            width: 100%;
            height: auto;
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
        }
        .sidebar.admin-sidebar .menu {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 10px;
        }
        .sidebar.admin-sidebar .menu-item {
            flex: 1 1 45%;
            margin: 0;
        }
    }

    @media (max-width: 640px) {
        .sidebar.admin-sidebar .menu-item {
            flex: 1 1 100%;
        }
    }
</style>

<aside class="sidebar admin-sidebar">
    <div class="sidebar-top">
        <img src="{{ asset('logo.jpeg') }}" alt="Logo" onerror="this.onerror=null;this.style.display='none';" class="brand-logo">
        <div>
            <div class="brand-title">ADMIN BBC</div>
            <div class="brand-subtitle">Panel Manajemen</div>
        </div>
    </div>

    <nav class="menu">
        <a href="/admin/dashboard" class="menu-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a href="/admin/menu-management" class="menu-item {{ $activeMenu === 'menu' ? 'active' : '' }}">
            <i class="fas fa-utensils"></i>
            <span>Menu Management</span>
        </a>
        <a href="/admin/kelola-pesanan" class="menu-item {{ $activeMenu === 'pesanan' ? 'active' : '' }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Pesanan</span>
            @if((int) $pendingCount > 0)
                <span class="pending-badge">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="/laporan" class="menu-item {{ $activeMenu === 'laporan' ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan Penjualan</span>
        </a>
        <a href="{{ route('admin.testimoni.index') }}" class="menu-item {{ $activeMenu === 'testimoni' ? 'active' : '' }}">
            <i class="fas fa-comment"></i>
            <span>Testimoni</span>
        </a>
        <a href="/kelola-admin" class="menu-item {{ $activeMenu === 'admin' ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i>
            <span>Kelola Admin</span>
        </a>
        <a href="{{ route('admin.change-password') }}" class="menu-item {{ $activeMenu === 'password' ? 'active' : '' }}">
            <i class="fas fa-lock"></i>
            <span>Ganti Password</span>
        </a>
    </nav>

    <div class="user-info">
        <div class="user-avatar">
            {{ $adminInitials }}
        </div>
        <div class="user-details">
            <div class="user-name">{{ $adminName }}</div>
            <div class="user-role">Administrator</div>
            @if(!empty($adminEmail))
                <div class="user-email">{{ $adminEmail }}</div>
            @endif
        </div>
    </div>
</aside>
