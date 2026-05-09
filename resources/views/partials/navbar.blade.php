<!-- NAVBAR -->
<header id="mainNavbar" class="fixed inset-x-0 top-4 z-50 px-3">
    <div class="navbar-shell max-w-[1180px] mx-auto flex items-center justify-between gap-2.5 rounded-[36px] border border-white/20 bg-white/10 pl-4 pr-4 sm:pl-5 sm:pr-5 py-2 shadow-2xl shadow-black/15 backdrop-blur-3xl transition-all duration-500">
        <div class="flex items-center justify-start md:min-w-[146px] h-10">
            <img src="/logo.jpeg" alt="logo" class="navbar-logo h-12 w-auto object-contain" />
        </div>

        <div class="hidden md:flex relative items-center justify-center flex-1 px-3">
            <div class="nav-items-group relative z-10 inline-flex max-w-[720px] items-center justify-center gap-2.5 px-1 py-1 rounded-full">
                <button type="button" data-url="{{ route('home') }}" data-active="{{ request()->routeIs('home') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">HOME</button>
                <button type="button" data-url="{{ route('pages.tentang') }}" data-active="{{ request()->routeIs('pages.tentang') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">TENTANG BBC</button>
                <button type="button" data-url="{{ route('menu.public') }}" data-active="{{ request()->routeIs('menu.public') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">MENU</button>
                <button type="button" data-url="{{ route('pages.lokasi_kontak') }}" data-active="{{ request()->routeIs('pages.lokasi_kontak') ? 'true' : 'false' }}" class="nav-item-button relative z-10 px-3.5 py-0.5 rounded-full text-[13px] font-semibold transition-colors duration-300 text-[#3a2a1a] hover:text-[#1f1410]">LOKASI DAN KONTAK</button>
                <span class="nav-active-bg absolute left-0 top-0 rounded-full bg-red-600/90 shadow-[0_20px_80px_-55px_rgba(139,0,0,0.85)] transition-all duration-500 z-0"></span>
            </div>
        </div>

        <div class="md:hidden inline-flex items-center gap-2">
            @auth
            <a href="{{ route('my-orders') }}" aria-label="Pesanan Saya" class="mobile-cart-btn mr-1 {{ request()->routeIs('my-orders') ? 'text-red-700' : 'text-[#3a2a1a]' }} hover:text-red-700 transition">
                <i class="fas fa-clipboard-list text-lg"></i>
            </a>
            <a href="{{ route('cart.index') }}" aria-label="Keranjang" class="mobile-cart-btn">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span id="cartCountMobile" class="mobile-cart-count">0</span>
            </a>
            @endauth

            <button id="mobileNavToggle" type="button" aria-label="Toggle mobile menu" aria-controls="mobileNavbarMenu" aria-expanded="false" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-transparent bg-transparent text-[#3a2a1a] hover:text-[#1f1410]">
                <i id="mobileNavIconOpen" class="fas fa-bars text-xl"></i>
                <i id="mobileNavIconClose" class="fas fa-times text-xl hidden"></i>
            </button>
        </div>

        <div class="hidden md:flex items-center justify-end gap-2 md:min-w-[112px]">
            @auth
            <div class="action-items-group relative inline-flex items-center gap-3 px-1 py-1">
                <div class="relative inline-flex items-center" id="userDropdownWrap">
                    <button type="button" id="userDropdownBtn" class="relative flex items-center justify-center w-8 h-8 rounded-full bg-red-600/10 text-red-700 hover:bg-red-600 hover:text-white transition-all duration-300" aria-label="Menu pengguna">
                        <i class="fas fa-user text-xs"></i>
                        <span id="cartCount" class="absolute -top-1.5 -right-1.5 bg-yellow-400 text-red-600 text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                    </button>
                    <div id="userDropdownMenu" class="hidden absolute right-0 top-full mt-2 w-44 bg-white/95 backdrop-blur-xl rounded-xl shadow-lg shadow-black/10 border border-white/40 py-2 z-50">
                        <div class="px-3 py-1.5 border-b border-gray-100">
                            <p class="text-[11px] text-gray-500 font-medium truncate">{{ auth()->user()->name ?? 'Pengguna' }}</p>
                        </div>
                        <a href="{{ route('my-orders') }}" class="flex items-center gap-2 px-3 py-2 text-[12px] text-[#3a2a1a] hover:bg-red-50 hover:text-red-700 transition">
                            <i class="fas fa-clipboard-list text-[10px]"></i> Pesanan Saya
                        </a>
                        <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-3 py-2 text-[12px] text-[#3a2a1a] hover:bg-red-50 hover:text-red-700 transition">
                            <i class="fas fa-shopping-cart text-[10px]"></i> Keranjang
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 text-[12px] text-red-700 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt text-[10px]"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <button type="button" class="nav-action-btn bg-red-600 text-white px-[18px] py-0.5 rounded-full text-[13px] font-semibold hover:bg-red-700 transition-all duration-300" onclick="window.location.href='{{ route('login') }}'">MASUK</button>
            @endauth

            <a href="https://wa.me/6281947260782?text=Halo%20BBC%2C%20saya%20ingin%20tanya%20menu." target="_blank" rel="noopener" class="wa-top-chat" aria-label="Chat WhatsApp">
                <span class="wa-top-chat-orbit" aria-hidden="true"></span>
                <span class="wa-top-chat-core">
                    <i class="fab fa-whatsapp"></i>
                    <span class="wa-top-chat-text">Chat WA</span>
                </span>
            </a>
        </div>
    </div>

    <div id="mobileNavbarMenu" class="md:hidden mx-auto max-w-[1180px]">
        <div class="mobile-menu-inner rounded-[24px] border border-white/50 bg-white/95 backdrop-blur-2xl shadow-2xl shadow-black/10">
            <div class="flex flex-col p-3 gap-1">
                <a href="{{ route('home') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('home') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3"><i class="fas fa-home text-[18px] w-6 text-center transition-colors duration-300 {{ request()->routeIs('home') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i> Home</span>
                    @if(request()->routeIs('home')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>
                <a href="{{ route('pages.tentang') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('pages.tentang') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3"><i class="fas fa-info-circle text-[18px] w-6 text-center transition-colors duration-300 {{ request()->routeIs('pages.tentang') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i> Tentang BBC</span>
                    @if(request()->routeIs('pages.tentang')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>
                <a href="{{ route('menu.public') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('menu.public') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3"><i class="fas fa-utensils text-[18px] w-6 text-center transition-colors duration-300 {{ request()->routeIs('menu.public') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i> Menu</span>
                    @if(request()->routeIs('menu.public')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>
                <a href="{{ route('pages.lokasi_kontak') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('pages.lokasi_kontak') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-[18px] w-6 text-center transition-colors duration-300 {{ request()->routeIs('pages.lokasi_kontak') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i> Lokasi & Kontak</span>
                    @if(request()->routeIs('pages.lokasi_kontak')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>

                @auth
                <div class="h-px bg-gradient-to-r from-transparent via-[#8b7355]/20 to-transparent my-1"></div>
                
                <div class="px-4 py-2 mt-1 mb-1 bg-[#f8f5f0]/50 rounded-xl border border-[#8b7355]/10">
                    <p class="text-[10px] text-[#8b7355] font-bold uppercase tracking-widest mb-0.5">Akun Saya</p>
                    <p class="text-[14px] font-bold text-[#3a2a1a] truncate">{{ auth()->user()->name ?? 'Pengguna' }}</p>
                </div>

                <a href="{{ route('my-orders') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('my-orders') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3"><i class="fas fa-clipboard-list text-[18px] w-6 text-center transition-colors duration-300 {{ request()->routeIs('my-orders') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i> Pesanan Saya</span>
                    @if(request()->routeIs('my-orders')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>
                <a href="{{ route('cart.index') }}" class="group relative flex items-center justify-between px-4 py-3.5 rounded-xl text-[14px] font-semibold transition-all duration-300 {{ request()->routeIs('cart.index') ? 'bg-red-50 text-red-700' : 'text-[#3a2a1a] hover:bg-[#f8f5f0]' }}">
                    <span class="flex items-center gap-3">
                        <div class="relative flex items-center justify-center w-6">
                            <i class="fas fa-shopping-cart text-[18px] transition-colors duration-300 {{ request()->routeIs('cart.index') ? 'text-red-600' : 'text-[#8b7355] group-hover:text-red-600' }}"></i>
                            <span id="cartCountMobileMenu" class="absolute -top-2 -right-2 bg-yellow-400 text-red-600 text-[9px] w-[16px] h-[16px] rounded-full flex items-center justify-center font-bold shadow-sm">0</span>
                        </div>
                        Keranjang
                    </span>
                    @if(request()->routeIs('cart.index')) <i class="fas fa-chevron-right text-[11px] text-red-500"></i> @endif
                </a>
                
                <div class="mt-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50/50 border border-red-100 text-red-700 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300 py-3.5 rounded-xl font-bold text-[13px]">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-2">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 transition-all duration-300 py-3.5 rounded-xl font-bold text-[13px] shadow-lg shadow-red-600/20">
                        <i class="fas fa-sign-in-alt"></i> MASUK
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</header>
@unless(request()->routeIs('home'))
<div class="h-24 sm:h-28"></div>
@endunless
<style>
    #mainNavbar {
        transition: none;
    }

    #mainNavbar .navbar-shell {
        transition: transform 0.35s ease, background-color 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        transform-origin: center top;
    }

    #mainNavbar.nav-transitioning .navbar-shell,
    #mainNavbar.nav-transitioning .navbar-logo {
        transition: none;
    }

    #mainNavbar .navbar-logo {
        transition: transform 0.35s ease;
        transform-origin: left center;
    }

    #mainNavbar .nav-item-button,
    #mainNavbar .nav-action-btn {
        transition: padding 0.35s ease, color 0.3s ease, background-color 0.3s ease;
    }

    #mainNavbar .nav-item-button {
        position: relative;
    }

    #mainNavbar .nav-active-bg {
        pointer-events: none;
    }

    #mainNavbar .action-text {
        position: relative;
        display: inline-block;
    }

    #mainNavbar .action-underline {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -4px;
        height: 2px;
        background: #dc2626;
        border-radius: 999px;
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.25s ease;
    }

    #mainNavbar .action-underline-active,
    #mainNavbar .nav-action-btn:hover .action-underline {
        transform: scaleX(1);
    }

    /* Mobile nav link styles handled by Tailwind classes */

    .mobile-cart-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 999px;
        color: #2f2218;
        text-decoration: none;
    }

    .mobile-cart-count {
        position: absolute;
        top: -0.25rem;
        right: -0.3rem;
        width: 1rem;
        height: 1rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #facc15;
        color: #dc2626;
        font-size: 10px;
        font-weight: 700;
        line-height: 1;
    }

    /* Mobile action button styles handled by Tailwind classes */

    #mainNavbar .nav-gofood-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.1rem 0.25rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.45);
        border: 1px solid rgba(255, 255, 255, 0.45);
        transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
    }

    #mainNavbar .nav-gofood-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.12);
        background: rgba(255, 255, 255, 0.66);
    }

    #mainNavbar .nav-gofood-logo {
        height: 20px;
        width: auto;
        object-fit: contain;
        display: block;
    }

    #mobileNavbarMenu {
        display: grid;
        grid-template-rows: 0fr;
        opacity: 0;
        margin-top: 0;
        transform: translateY(-12px) scale(0.98);
        pointer-events: none;
        transition: grid-template-rows 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), margin-top 0.4s ease;
    }

    #mobileNavbarMenu .mobile-menu-inner {
        min-height: 0;
        overflow: hidden;
    }

    #mobileNavbarMenu.mobile-open {
        grid-template-rows: 1fr;
        opacity: 1;
        margin-top: 0.5rem;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    #mainNavbar.navbar-scrolled .navbar-shell {
        transform: scale(0.92);
        background-color: rgba(255, 255, 255, 0.16);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
    }

    #mainNavbar.navbar-scrolled .navbar-logo {
        transform: scale(0.94);
    }

    .wa-top-chat {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        margin-left: 0.15rem;
    }

    .wa-top-chat-orbit {
        position: absolute;
        width: 56px;
        height: 56px;
        border-radius: 999px;
        border: 1px dashed rgba(34, 197, 94, 0.65);
        animation: waOrbitSpin 7s linear infinite;
        pointer-events: none;
    }

    .wa-top-chat-core {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.42rem;
        padding: 0.52rem 0.9rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #1fbf5b 0%, #159447 100%);
        color: #fff;
        box-shadow: 0 12px 22px rgba(21, 148, 71, 0.34);
        transform-origin: top center;
        transition: transform 0.35s ease, box-shadow 0.35s ease, filter 0.35s ease;
        animation: waIdleFloat 3.6s ease-in-out infinite;
    }

    .wa-top-chat-core i {
        font-size: 0.95rem;
    }

    .wa-top-chat-text {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        white-space: nowrap;
    }

    .wa-top-chat:hover .wa-top-chat-core {
        animation: waHoverSwing 1.9s ease-in-out infinite;
        box-shadow: 0 16px 30px rgba(21, 148, 71, 0.45);
        filter: brightness(1.04);
    }

    .wa-top-chat:hover .wa-top-chat-orbit {
        animation-duration: 2.8s;
        border-color: rgba(34, 197, 94, 0.9);
    }

    @keyframes waOrbitSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes waIdleFloat {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-2px) rotate(0deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }

    @keyframes waHoverSwing {
        0% { transform: rotate(0deg) translateY(-1px); }
        25% { transform: rotate(-4deg) translateY(-2px); }
        50% { transform: rotate(3.4deg) translateY(0); }
        75% { transform: rotate(-2.6deg) translateY(-1px); }
        100% { transform: rotate(0deg) translateY(-1px); }
    }

    @media (max-width: 767px) {
        .wa-top-chat {
            display: none;
        }

        .wa-top-chat-core {
            padding: 0.5rem 0.75rem;
        }

        .wa-top-chat-text {
            display: none;
        }

        .wa-top-chat-orbit {
            width: 44px;
            height: 44px;
        }
    }

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.__bbcNavbarInit) return;
    window.__bbcNavbarInit = true;

    const navGroup = document.querySelector('.nav-items-group');
    const activeBg = document.querySelector('.nav-active-bg');
    const navBtns = document.querySelectorAll('.nav-item-button');
    const navbar = document.getElementById('mainNavbar');
    const mobileToggle = document.getElementById('mobileNavToggle');
    const mobileMenu = document.getElementById('mobileNavbarMenu');
    const mobileIconOpen = document.getElementById('mobileNavIconOpen');
    const mobileIconClose = document.getElementById('mobileNavIconClose');
    const desktopCartCount = document.getElementById('cartCount');
    const mobileCartCount = document.getElementById('cartCountMobile');
    let activeBtn = null;

    function syncMobileCartCount() {
        if (!desktopCartCount) return;
        if (mobileCartCount) {
            mobileCartCount.textContent = desktopCartCount.textContent || '0';
        }
        const mobileMenuCartCount = document.getElementById('cartCountMobileMenu');
        if (mobileMenuCartCount) {
            mobileMenuCartCount.textContent = desktopCartCount.textContent || '0';
        }
    }

    function refreshCartCount() {
        if (!desktopCartCount) return;

        fetch('/api/cart-count', {
            headers: {
                'Accept': 'application/json'
            }
        })
            .then((response) => {
                if (!response.ok) throw new Error('Failed to fetch cart count');
                return response.json();
            })
            .then((data) => {
                desktopCartCount.textContent = String(data.count ?? 0);
                syncMobileCartCount();
            })
            .catch(() => {
                // Keep existing badge value if request fails.
            });
    }

    function syncNavbarOnScroll() {
        if (!navbar || navbar.classList.contains('nav-transitioning')) return;
        if (window.scrollY > 24) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    }

    function moveActiveBtn(button) {
        if (!navGroup || !activeBg || !button) return;
        const btnLeft = button.offsetLeft;
        const btnTop = button.offsetTop;
        const btnWidth = button.offsetWidth;
        const btnHeight = button.offsetHeight;
        activeBg.style.width = `${btnWidth}px`;
        activeBg.style.height = `${btnHeight}px`;
        activeBg.style.transform = `translate(${btnLeft}px, ${btnTop}px)`;
    }


    if (navGroup && activeBg && navBtns.length > 0) {
        activeBtn = Array.from(navBtns).find(btn => btn.dataset.active === 'true');

        navBtns.forEach(btn => {
            btn.style.transition = 'none';
            btn.classList.remove('text-white');
        });
        activeBg.style.transition = 'none';

        if (activeBtn) {
            activeBg.style.opacity = '1';
            moveActiveBtn(activeBtn);
            activeBtn.classList.add('text-white');

            // Force reflow to apply styles without transition
            navBtns.forEach(btn => btn.offsetHeight);
            activeBg.offsetHeight;

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    navBtns.forEach(btn => {
                        btn.style.transition = '';
                    });
                    activeBg.style.transition = 'transform 500ms cubic-bezier(0.22, 1, 0.36, 1), width 500ms cubic-bezier(0.22, 1, 0.36, 1), height 500ms cubic-bezier(0.22, 1, 0.36, 1)';
                });
            });
        } else {
            activeBg.style.opacity = '0';
            activeBg.style.width = '0px';
            activeBg.style.height = '0px';
        }

        navBtns.forEach(btn => {
            btn.addEventListener('click', function(event) {
                const url = this.dataset.url;
                if (!url || this === activeBtn) return;
                event.preventDefault();
                navbar.classList.add('nav-transitioning');
                activeBtn = this;
                activeBg.style.opacity = '1';
                moveActiveBtn(this);
                navBtns.forEach(b => b.classList.remove('text-white'));
                // Delay text-white until slider arrives (sync with transition)
                setTimeout(() => {
                    this.classList.add('text-white');
                }, 400);
                setTimeout(() => window.location.href = url, 550);
            });
        });
    }


    function setMobileMenu(open) {
        if (!mobileMenu || !mobileToggle) return;
        mobileMenu.classList.toggle('mobile-open', open);
        mobileToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (mobileIconOpen && mobileIconClose) {
            mobileIconOpen.classList.toggle('hidden', open);
            mobileIconClose.classList.toggle('hidden', !open);
        }
    }

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('mobile-open');
            setMobileMenu(!isOpen);
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => setMobileMenu(false));
        });

        setMobileMenu(false);
    }

    syncMobileCartCount();
    if (desktopCartCount && mobileCartCount && 'MutationObserver' in window) {
        const cartObserver = new MutationObserver(syncMobileCartCount);
        cartObserver.observe(desktopCartCount, { childList: true, subtree: true, characterData: true });
    }

    refreshCartCount();

    // Desktop user dropdown toggle
    const userDropdownBtn = document.getElementById('userDropdownBtn');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    const userDropdownWrap = document.getElementById('userDropdownWrap');
    if (userDropdownBtn && userDropdownMenu && userDropdownWrap) {
        userDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
            if (!userDropdownWrap.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            setMobileMenu(false);
        }
        if (activeBtn) {
            activeBg.style.transition = 'none';
            moveActiveBtn(activeBtn);
        }
    });

    window.addEventListener('scroll', syncNavbarOnScroll, { passive: true });
    syncNavbarOnScroll();
});
</script>
