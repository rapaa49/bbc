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
        overflow-x: hidden;
    }

    .sidebar.admin-sidebar .sidebar-top {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 18px 16px;
        border-bottom: 1px solid #e2e8f0;
        flex-shrink: 0;
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
        position: relative;
        overflow-y: auto;
        flex: 1;
    }

    .menu-slider {
        position: absolute;
        left: 10px;
        right: 10px;
        border-radius: 14px;
        background: #8B0000;
        pointer-events: none;
        z-index: 0;
        opacity: 0;
        transition: top 0s, height 0s, opacity 0.2s ease;
    }

    .menu-slider.is-animating {
        transition: top 0.35s cubic-bezier(0.4, 0, 0.2, 1), height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
    }

    /* Dropdown styles */
    .menu-dropdown {
        /* Intentionally no position:relative — it breaks offsetTop for the slider */
    }

    .menu-dropdown-toggle {
        display: flex;
        align-items: center;
        width: 100%;
        margin: 5px 10px;
        box-sizing: border-box;
    }

    .menu-dropdown-toggle .dropdown-arrow {
        transition: transform 0.3s ease;
    }

    .menu-dropdown.is-active .menu-dropdown-toggle .dropdown-arrow {
        transform: rotate(180deg);
    }

    .menu-dropdown-list {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease, padding 0.25s ease;
        opacity: 0;
        background: rgba(0,0,0,0.02);
        border-radius: 0 0 12px 12px;
        padding: 0;
        width: 100%;
        box-sizing: border-box;
    }

    .menu-dropdown-list.is-open {
        max-height: 200px;
        opacity: 1;
        padding: 4px 0;
    }

    .menu-dropdown-link {
        display: flex;
        align-items: center;
        padding: 10px 12px 10px 44px;
        margin: 2px 10px;
        border-radius: 10px;
        text-decoration: none;
        color: #2D3748;
        font-size: 14px;
        font-weight: 500;
        box-sizing: border-box;
        max-width: calc(100% - 20px);
        transition: all 0.2s ease;
        position: relative;
    }

    .menu-dropdown-link:hover {
        background: rgba(139, 0, 0, 0.04);
        color: #8B0000;
    }

    .menu-dropdown-link.is-active {
        color: #8B0000;
        font-weight: 600;
        background: rgba(139, 0, 0, 0.06);
    }

    .menu-dropdown-link.is-active::before {
        content: '';
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        background: #8B0000;
        border-radius: 50%;
    }

    .sidebar-logout {
        padding: 14px 10px;
        border-top: 1px solid rgba(0,0,0,0.04);
        flex-shrink: 0;
    }

    .sidebar-logout .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 13px 14px;
        border-radius: 14px;
        border: 0;
        background: linear-gradient(to right, #8B0000 50%, rgba(139, 0, 0, 0.04) 50%);
        background-size: 200% 100%;
        background-position: right bottom;
        color: #8B0000;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-position 0.4s ease-out, color 0.3s ease, box-shadow 0.3s ease;
    }

    .sidebar-logout .logout-btn:hover {
        background-position: left bottom;
        color: #fff;
        box-shadow: 0 10px 22px rgba(139, 0, 0, 0.2);
    }

    .sidebar.admin-sidebar .menu-item {
        display: flex;
        align-items: center;
        margin: 5px 10px;
        border-radius: 14px;
        border: 1px solid transparent;
        color: #475569;
        font-weight: 600;
        padding: 12px 13px;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        transition: color 0.22s ease, background 0.22s ease, border-color 0.22s ease;
        z-index: 1;
        box-sizing: border-box;
    }

    .sidebar.admin-sidebar .menu-item i {
        width: 18px;
        margin-right: 10px;
        font-size: 15px;
        color: inherit;
    }

    .sidebar.admin-sidebar .menu-item:hover {
        color: #8B0000;
        background: rgba(139, 0, 0, 0.04);
        border-color: rgba(139, 0, 0, 0.25);
    }

    .sidebar.admin-sidebar .menu-item.is-active {
        color: #fff;
    }

    .sidebar.admin-sidebar .menu-item.is-active::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(255,255,255,0.18), transparent 35%, rgba(255,255,255,0.10));
        pointer-events: none;
    }

    .sidebar.admin-sidebar .menu-item .pending-badge {
        margin-left: auto;
        background: rgba(255,255,255,0.96);
        color: #8B0000;
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(139, 0, 0, 0.12);
        border: none;
        transition: background 0.22s ease, color 0.22s ease;
    }

    .sidebar.admin-sidebar .menu-item.is-active .pending-badge {
        background: rgba(255,255,255,0.96);
        color: #8B0000;
    }

    /* Mobile Toggle Button */
    .sidebar-mobile-toggle {
        display: none;
        position: fixed;
        top: 16px;
        left: 16px;
        z-index: 1001;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #8B0000;
        color: #fff;
        border: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
        font-size: 18px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .sidebar-mobile-toggle:active {
        transform: scale(0.95);
    }

    /* Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }

    @media (max-width: 992px) {
        .sidebar-mobile-toggle {
            display: flex;
        }

        .sidebar-overlay {
            display: block;
        }

        .sidebar-overlay.is-visible {
            opacity: 1;
        }

        .sidebar.admin-sidebar {
            transform: translateX(-100%);
            height: 100vh;
            top: 0;
            left: 0;
            border-right: none;
        }

        .sidebar.admin-sidebar.is-open {
            transform: translateX(0);
        }

        .sidebar.admin-sidebar .menu {
            padding: 10px 0;
        }
    }
</style>

<button class="sidebar-mobile-toggle" id="sidebarToggle" aria-label="Toggle menu">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar admin-sidebar" id="adminSidebar">
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
        <div class="menu-dropdown {{ in_array($activeMenu, ['menu', 'paket']) ? 'is-active' : '' }}">
            <a class="menu-item menu-dropdown-toggle {{ in_array($activeMenu, ['menu', 'paket']) ? 'active' : '' }}" onclick="toggleDropdown(this)" href="javascript:void(0)">
                <i class="fas fa-utensils"></i>
                <span>Kelola Produk</span>
                <i class="fas fa-chevron-down dropdown-arrow" style="margin-left:8px;font-size:12px;"></i>
            </a>
            <div class="menu-dropdown-list {{ in_array($activeMenu, ['menu', 'paket']) ? 'is-open' : '' }}">
                <a href="/admin/menu-management" class="menu-dropdown-link {{ $activeMenu === 'menu' ? 'is-active' : '' }}">
                    <span>Daftar Menu</span>
                </a>
                <a href="/paket" class="menu-dropdown-link {{ $activeMenu === 'paket' ? 'is-active' : '' }}">
                    <span>Paket</span>
                </a>
            </div>
        </div>
        <a href="/admin/kelola-pesanan" class="menu-item {{ $activeMenu === 'pesanan' ? 'active' : '' }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Pesanan</span>
        </a>
        <a href="/laporan" class="menu-item {{ $activeMenu === 'laporan' ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan Penjualan</span>
        </a>
        <div class="menu-dropdown {{ in_array($activeMenu, ['testimoni', 'ulasan']) ? 'is-active' : '' }}">
            <a class="menu-item menu-dropdown-toggle {{ in_array($activeMenu, ['testimoni', 'ulasan']) ? 'active' : '' }}" onclick="toggleDropdown(this)" href="javascript:void(0)">
                <i class="fas fa-comment"></i>
                <span>Testimoni</span>
                <i class="fas fa-chevron-down dropdown-arrow" style="margin-left:8px;font-size:12px;"></i>
            </a>
            <div class="menu-dropdown-list {{ in_array($activeMenu, ['testimoni', 'ulasan']) ? 'is-open' : '' }}">
                <a href="{{ route('admin.testimoni.index') }}" class="menu-dropdown-link {{ $activeMenu === 'testimoni' ? 'is-active' : '' }}">
                    <span>Influencer</span>
                </a>
                <a href="{{ route('admin.testimoni.ulasan') }}" class="menu-dropdown-link {{ $activeMenu === 'ulasan' ? 'is-active' : '' }}">
                    <span>Ulasan</span>
                </a>
            </div>
        </div>
        <a href="/kelola-admin" class="menu-item {{ $activeMenu === 'admin' ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i>
            <span>Kelola Admin</span>
        </a>
        <div class="menu-slider" aria-hidden="true"></div>
    </nav>

    <div class="sidebar-logout">
        <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleDropdown(element) {
        const dropdown = element.closest('.menu-dropdown');
        const list = dropdown.querySelector('.menu-dropdown-list');
        if (list.classList.contains('is-open')) {
            list.classList.remove('is-open');
            dropdown.classList.remove('is-active');
        } else {
            list.classList.add('is-open');
            dropdown.classList.add('is-active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');
        const menu = sidebar.querySelector('.menu');
        const slider = menu.querySelector('.menu-slider');
        const items = menu.querySelectorAll('.menu-item');

        function isMobile() {
            return window.innerWidth <= 992;
        }

        function openSidebar() {
            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            document.body.style.overflow = '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (sidebar.classList.contains('is-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        function positionSlider(element, animate) {
            if (!element || !slider) return;
            if (animate) {
                slider.classList.add('is-animating');
                slider.style.transition = '';
            } else {
                slider.classList.remove('is-animating');
                slider.style.transition = 'none';
            }
            slider.style.top = element.offsetTop + 'px';
            slider.style.height = element.offsetHeight + 'px';
            slider.style.opacity = '1';
            if (!animate) {
                slider.offsetHeight;
                slider.style.transition = '';
            }
        }

        function clearActiveVisual() {
            items.forEach(el => el.classList.remove('is-active'));
        }

        function setActiveVisual(item) {
            if (item) item.classList.add('is-active');
        }

        const activeItem = menu.querySelector('.menu-item.active');
        if (activeItem) {
            activeItem.classList.remove('active');
            positionSlider(activeItem, false);
            setActiveVisual(activeItem);
        }

        items.forEach(item => {
            item.addEventListener('click', function(e) {
                const href = item.getAttribute('href');
                const isDropdownToggle = href && href.startsWith('javascript:');

                if (isDropdownToggle) {
                    e.preventDefault();
                    clearActiveVisual();
                    positionSlider(item, true);
                    setTimeout(() => setActiveVisual(item), 280);
                    return;
                }

                if (!href || href === '#' || item.classList.contains('is-active')) return;

                e.preventDefault();
                clearActiveVisual();
                positionSlider(item, true);
                setTimeout(() => setActiveVisual(item), 280);
                setTimeout(() => {
                    if (isMobile()) closeSidebar();
                    window.location.href = href;
                }, 350);
            });
        });

        window.addEventListener('resize', function() {
            const currentActive = menu.querySelector('.menu-item.is-active') || activeItem;
            if (currentActive) {
                positionSlider(currentActive, false);
            }
        });

        // Auto-dismiss alerts
        const alerts = document.querySelectorAll('.alert, .auth-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-12px)';
                setTimeout(() => {
                    alert.remove();
                }, 600);
            }, 3000);
        });
    });
</script>
