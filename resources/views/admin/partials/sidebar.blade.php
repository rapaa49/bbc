@php
    $activeMenu = $activeMenu ?? '';
    $pendingCount = $pendingCount ?? 0;

    $adminUser = auth('admin')->user() ?? (object)['name' => 'Admin', 'username' => 'Admin', 'email' => ''];
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
    /* â”€â”€ GLOBAL SKELETON LOADING â”€â”€ */
    .main-content {
        opacity: 0;
        visibility: hidden;
    }
    body.skeleton-loaded .main-content {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.5s ease-in-out;
    }
    #page-skeleton {
        position: fixed;
        top: 0;
        left: 272px;
        right: 0;
        bottom: 0;
        padding: 32px;
        background: var(--bg, #f8fafc);
        z-index: 990;
        overflow-y: auto;
    }
    @media (max-width: 992px) {
        #page-skeleton { left: 0; padding: 80px 20px 20px; z-index: 990; }
    }
    
    @keyframes pulse-skeleton {
        0% { background-color: #e2e8f0; }
        50% { background-color: #cbd5e1; }
        100% { background-color: #e2e8f0; }
    }
    
    .skel-box {
        background: #e2e8f0;
        border-radius: 8px;
        animation: pulse-skeleton 1.5s infinite ease-in-out;
        margin-bottom: 20px;
    }
    .skel-title { height: 32px; width: 35%; margin-bottom: 8px; }
    .skel-subtitle { height: 16px; width: 25%; margin-bottom: 32px; }
    .skel-card { height: 120px; width: 100%; border-radius: 12px; }
    .skel-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 24px; }
    .skel-table { height: 400px; width: 100%; border-radius: 12px; }

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
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
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
        /* Intentionally no position:relative â€” it breaks offsetTop for the slider */
    }

    .menu-dropdown-toggle {
        display: flex;
        align-items: center;
        width: calc(100% - 20px);
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
        padding: 10px 13px 10px 38px;
        margin: 5px 10px;
        border-radius: 14px;
        border: 1px solid transparent;
        text-decoration: none;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        box-sizing: border-box;
        width: calc(100% - 20px);
        transition: color 0.22s ease, background 0.22s ease, border-color 0.22s ease;
        position: relative;
    }

    .menu-dropdown-link:hover {
        color: #8B0000;
        background: rgba(139, 0, 0, 0.04);
        border-color: rgba(139, 0, 0, 0.25);
    }

    .menu-dropdown-link.is-active {
        color: #8B0000;
        font-weight: 600;
        background: rgba(139, 0, 0, 0.06);
    }
    
    .menu-dropdown-link i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        font-size: 13px;
        opacity: 0.75;
        transition: opacity 0.2s ease;
    }
    
    .menu-dropdown-link:hover i,
    .menu-dropdown-link.is-active i {
        opacity: 1;
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
        background: rgba(139, 0, 0, 0.04);
        color: #8B0000;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: color 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .sidebar-logout .logout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #8B0000;
        transform: translateX(-101%);
        transition: transform 0.4s ease-out;
        z-index: 0;
    }

    .sidebar-logout .logout-btn > * {
        position: relative;
        z-index: 1;
    }

    .sidebar-logout .logout-btn:hover {
        color: #fff;
        box-shadow: 0 10px 22px rgba(139, 0, 0, 0.2);
    }

    .sidebar-logout .logout-btn:hover::before {
        transform: translateX(0);
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
        background: #ffffff;
        color: #2D3748;
        border: 1px solid #e2e8f0;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(45, 55, 72, 0.06);
        font-size: 18px;
        transition: all 0.2s ease;
    }

    .sidebar-mobile-toggle:hover {
        background: #f8fafc;
        box-shadow: 0 6px 16px rgba(45, 55, 72, 0.1);
        color: #8B0000;
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
        pointer-events: none;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .sidebar-close {
        display: none;
        background: #f1f5f9;
        border: none;
        color: #64748b;
        font-size: 20px;
        cursor: pointer;
        margin-left: auto;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .sidebar-close:hover {
        color: #ef4444;
        background: #fee2e2;
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
            pointer-events: auto;
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

        .sidebar-close {
            display: flex;
        }

        .sidebar-mobile-toggle.is-hidden {
            display: none !important;
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
        <button class="sidebar-close" id="sidebarClose" aria-label="Close menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="menu">
        <a href="/admin/dashboard" class="menu-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <div class="menu-dropdown {{ in_array($activeMenu, ['menu', 'paket']) ? 'is-active' : '' }}">
            <a class="menu-item menu-dropdown-toggle {{ in_array($activeMenu, ['menu', 'paket']) ? 'active' : '' }}" href="javascript:void(0)">
                <i class="fas fa-utensils"></i>
                <span>Kelola Produk</span>
                <i class="fas fa-chevron-down dropdown-arrow" style="margin-left:auto;font-size:12px;"></i>
            </a>
            <div class="menu-dropdown-list {{ in_array($activeMenu, ['menu', 'paket']) ? 'is-open' : '' }}">
                <a href="/admin/menu-management" class="menu-dropdown-link {{ $activeMenu === 'menu' ? 'is-active' : '' }}">
                    <i class="fas fa-list-ul"></i>
                    <span>Daftar Menu</span>
                </a>
                <a href="/paket" class="menu-dropdown-link {{ $activeMenu === 'paket' ? 'is-active' : '' }}">
                    <i class="fas fa-boxes"></i>
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
            <a class="menu-item menu-dropdown-toggle {{ in_array($activeMenu, ['testimoni', 'ulasan']) ? 'active' : '' }}" href="javascript:void(0)">
                <i class="fas fa-comment"></i>
                <span>Testimoni</span>
                <i class="fas fa-chevron-down dropdown-arrow" style="margin-left:auto;font-size:12px;"></i>
            </a>
            <div class="menu-dropdown-list {{ in_array($activeMenu, ['testimoni', 'ulasan']) ? 'is-open' : '' }}">
                <a href="{{ route('admin.testimoni.index') }}" class="menu-dropdown-link {{ $activeMenu === 'testimoni' ? 'is-active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Influencer</span>
                </a>
                <a href="{{ route('admin.testimoni.ulasan') }}" class="menu-dropdown-link {{ $activeMenu === 'ulasan' ? 'is-active' : '' }}">
                    <i class="fas fa-star"></i>
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
        const closeBtn = document.getElementById('sidebarClose');
        const menu = sidebar.querySelector('.menu');
        const slider = menu.querySelector('.menu-slider');
        const items = menu.querySelectorAll('.menu-item');
        const dropdownToggles = menu.querySelectorAll('.menu-dropdown-toggle');

        function isMobile() {
            return window.innerWidth <= 992;
        }

        function openSidebar() {
            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');
            document.body.style.overflow = 'hidden';
            if (toggleBtn) toggleBtn.classList.add('is-hidden');
        }

        function closeSidebar() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            document.body.style.overflow = '';
            if (toggleBtn) toggleBtn.classList.remove('is-hidden');
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

        if (closeBtn) {
            closeBtn.addEventListener('click', closeSidebar);
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

        function trackSliderMovement() {
            let start = performance.now();
            function step(time) {
                const currentActive = menu.querySelector('.menu-item.is-active') || activeItem;
                if (currentActive) {
                    positionSlider(currentActive, false);
                }
                if (time - start < 450) {
                    requestAnimationFrame(step);
                }
            }
            requestAnimationFrame(step);
        }

        function clearActiveVisual() {
            items.forEach(el => el.classList.remove('is-active'));
        }

        function setActiveVisual(item) {
            if (item) item.classList.add('is-active');
        }

        const activeItem = menu.querySelector('.menu-item.active') || menu.querySelector('.menu-dropdown-toggle.active');
        if (activeItem) {
            activeItem.classList.remove('active');
            positionSlider(activeItem, false);
            setActiveVisual(activeItem);
        }

        // Accordion behavior for dropdowns
        dropdownToggles.forEach(toggle => {
            // Remove the inline onclick attribute
            toggle.removeAttribute('onclick');
            
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                
                const dropdown = toggle.closest('.menu-dropdown');
                const list = dropdown.querySelector('.menu-dropdown-list');
                const isOpen = list.classList.contains('is-open');

                // Close other dropdowns
                const allDropdowns = menu.querySelectorAll('.menu-dropdown');
                allDropdowns.forEach(dd => {
                    if (dd !== dropdown) {
                        dd.classList.remove('is-active');
                        const otherList = dd.querySelector('.menu-dropdown-list');
                        if (otherList) otherList.classList.remove('is-open');
                    }
                });

                // Toggle current
                if (isOpen) {
                    list.classList.remove('is-open');
                    dropdown.classList.remove('is-active');
                } else {
                    list.classList.add('is-open');
                    dropdown.classList.add('is-active');
                }

                // Smoothly track slider position as layout shifts
                clearActiveVisual();
                setActiveVisual(toggle);
                trackSliderMovement();
            });
        });

        items.forEach(item => {
            if (item.classList.contains('menu-dropdown-toggle')) return; // handled above

            item.addEventListener('click', function(e) {
                const href = item.getAttribute('href');
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

<!-- Global Skeleton Loader -->
<div id="page-skeleton">
    <div class="skel-box skel-title"></div>
    <div class="skel-box skel-subtitle"></div>
    
    <div class="skel-grid">
        <div class="skel-box skel-card"></div>
        <div class="skel-box skel-card"></div>
        <div class="skel-box skel-card"></div>
        <div class="skel-box skel-card"></div>
    </div>
    
    <div class="skel-box skel-table"></div>
</div>

<script>
    (function() {
        function hideSkeleton() {
            const skel = document.getElementById('page-skeleton');
            if (skel) {
                skel.style.opacity = '0';
                skel.style.pointerEvents = 'none';
                skel.style.transition = 'opacity 0.4s ease';
                setTimeout(() => skel.remove(), 400);
            }
            document.body.classList.add('skeleton-loaded');
        }

        if (document.readyState === 'complete') {
            hideSkeleton();
        } else {
            const maxTime = setTimeout(() => hideSkeleton(), 3000);
            window.addEventListener('load', () => {
                clearTimeout(maxTime);
                hideSkeleton();
            });
        }
    })();
</script>

<script>
    function confirmAction(e, text, url) {
        if(e) e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8B0000',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                if(url) window.location.href = url;
            }
        });
    }

    function confirmFormSubmit(e, formId, text) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8B0000',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

