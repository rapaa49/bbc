<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Spesial - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --brand-red: #8b0000;
            --brand-red-dark: #6b0000;
            --brand-cream: #EFE1D1;
            --brand-brown: #3a2a1a;
            --brand-brown-light: #6a4a34;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--brand-cream);
            color: var(--brand-brown);
        }

        /* Premium Header Section */
        .menu-hero {
            padding: 100px 0 60px;
            text-align: center;
            background: radial-gradient(circle at top, rgba(239, 225, 209, 0.3) 0%, transparent 70%);
        }

        .menu-hero-tag {
            font-size: 11px;
            font-weight: 700;
            color: var(--brand-red);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .menu-hero-tag::before, .menu-hero-tag::after {
            content: '';
            width: 20px;
            height: 1px;
            background: currentColor;
            opacity: 0.3;
        }

        .menu-hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: var(--brand-brown);
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 24px;
        }

        .menu-hero-desc {
            font-size: 16px;
            color: var(--brand-brown-light);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page-bg-image {
            position: relative;
            background-image: url('{{ asset('bg_body.png') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .page-bg-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(239, 225, 209, 0.6) 0%, rgba(239, 225, 209, 0.85) 100%);
            pointer-events: none;
        }

        .menu-shell {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Filter Buttons */
        .filter-btn {
            padding: 0.6rem 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--brand-brown-light);
            background: white;
            border: 1px solid #e0d5c7;
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .filter-btn.filter-active {
            background: var(--brand-red);
            color: #fff;
            border-color: var(--brand-red);
        }

        .filter-btn:hover:not(.filter-active) {
            border-color: var(--brand-red);
            color: var(--brand-red);
        }

        /* Vertical Menu Card with Smaller Image */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .menu-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #ece3d5;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px -8px rgba(139, 0, 0, 0.1);
        }

        .menu-card-img {
            position: relative;
            width: 100%;
            height: 140px; /* Reduced fixed height */
            flex-shrink: 0;
            overflow: hidden;
            background: #fdf5e6;
        }

        .menu-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .menu-card:hover .menu-card-img img {
            transform: scale(1.05);
        }

        .menu-category {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255,255,255,0.92);
            color: var(--brand-red);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .menu-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .menu-badge.reko {
            background: var(--brand-red);
            color: #fff;
        }

        .menu-badge.reko i { color: #DAA520; }

        .menu-badge.porsi {
            background: var(--brand-brown);
            color: #fff;
        }

        .menu-card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .menu-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .menu-card-desc {
            font-size: 12px;
            color: #888;
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .menu-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            margin-top: auto;
            border-top: 1px solid #f5f0e8;
        }

        .menu-card-price {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--brand-red);
        }

        .menu-card-outlet {
            font-size: 10px;
            font-weight: 600;
            color: #999;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Pager */
        .pager-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 2.5rem;
        }

        .pager-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: white;
            color: var(--brand-red);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0d5c7;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pager-btn:hover:not(:disabled) {
            background: var(--brand-red);
            color: white;
        }

        .pager-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .pager-info {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .pager-num {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--brand-brown-light);
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .pager-num:hover {
            background: rgba(139, 0, 0, 0.05);
            color: var(--brand-red);
        }

        .pager-num.active {
            background: var(--brand-red);
            color: #fff;
        }

        /* Visit Card */
        .delivery-card {
            margin-top: 4rem;
            background: var(--brand-red);
            border-radius: 24px;
            padding: 3rem 2rem;
            color: white;
            text-align: center;
        }

        .delivery-gofood-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff;
            color: var(--brand-red);
            padding: 0.8rem 2rem;
            border-radius: 100px;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .delivery-gofood-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1024px) {
            .menu-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 768px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 640px) {
            .menu-grid { 
                grid-template-columns: 1fr; 
                gap: 20px; 
            }
            .menu-card-img { 
                height: 180px; 
            }
            .menu-card-body { 
                padding: 18px; 
            }
            .menu-card-title { 
                font-size: 1.1rem; 
                margin-bottom: 4px;
            }
            .menu-card-desc { 
                font-size: 0.75rem; 
                margin-bottom: 12px; 
                -webkit-line-clamp: 3;
            }
            .menu-card-price { 
                font-size: 1.15rem; 
            }
            .menu-badge { 
                font-size: 9px; 
                padding: 4px 10px; 
                bottom: 12px; 
                left: 12px; 
            }
            .menu-card-footer {
                padding-top: 12px;
            }
            .delivery-card { 
                padding: 2rem 1.5rem; 
            }
            .menu-hero {
                padding: 80px 0 40px;
            }
        }
    </style>
</head>
<body class="overflow-x-hidden">
    @include('partials.navbar')

    <main class="page-bg-image min-h-screen pt-12 pb-24 relative overflow-hidden">
        <div class="menu-shell px-6">

            <!-- Header Section -->
            <header class="text-center mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 mb-4 px-[18px] py-2 rounded-full bg-[rgba(139,0,0,0.08)] border border-[rgba(139,0,0,0.15)] text-xs font-bold uppercase tracking-[0.5px] text-[#8B0000]">
                    <span class="w-2 h-2 rounded-full bg-[#8B0000]"></span>
                    Cita Rasa Legendaris
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-[#1a1a1a] tracking-tight mb-6 leading-tight">
                    Jelajahi <span class="text-red-700">Cita Rasa</span> Kami
                </h1>
                <p class="text-base md:text-xl text-[#4a4a4a] max-w-2xl mx-auto font-medium leading-relaxed">
                    Daftar menu autentik Bakso Bunderan Ciomas. Temukan pilihan favorit Anda dan nikmati kehangatannya langsung di outlet kami.
                </p>
            </header>

            <!-- Filter Section -->
            <nav class="flex flex-wrap justify-center gap-3 mb-16 fade-in-up" style="transition-delay: 0.1s">
                <button class="filter-btn filter-active" data-filter="all">Semua Koleksi</button>
                @foreach(['bakso' => 'Varian Bakso', 'mie' => 'Mie Ayam', 'paket' => 'Paket Spesial', 'minuman' => 'Minuman Segar'] as $val => $label)
                <button class="filter-btn filter-inactive" data-filter="{{ $val }}">{{ $label }}</button>
                @endforeach
            </nav>

            <!-- Menu Grid -->
            <div class="menu-grid" id="menuContainer">
                @include('partials.menu-items')
            </div>

            <!-- Pagination -->
            <div id="menuPagination" class="pager-wrap fade-in-up" style="transition-delay: 0.2s">
                <button id="menuPrevPage" type="button" class="pager-btn" aria-label="Prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="menuPageNumbers" class="pager-info">
                    <!-- Numbers will be injected by JS -->
                </div>
                <button id="menuNextPage" type="button" class="pager-btn" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Visit Us Card -->
            <section class="delivery-card fade-in-up" style="transition-delay: 0.3s">
                <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-3">Lokasi & Kunjungan</p>
                <h2 class="text-2xl md:text-4xl font-bold mb-4">Datang langsung ke outlet kami!</h2>
                <p class="text-white/80 text-sm max-w-lg mx-auto mb-8">Nikmati bakso hangat langsung di Bunderan Ciomas bersama keluarga.</p>
                <a href="/lokasi-kontak" class="delivery-gofood-btn">
                    <i class="fas fa-location-dot"></i>
                    Lihat Lokasi
                </a>
            </section>

        </div>
    </main>

    @include('partials.footer')

    <script>
        let currentPage = 1;
        const menuContainer = document.getElementById('menuContainer');
        const paginationWrap = document.getElementById('menuPagination');
        const prevPageBtn = document.getElementById('menuPrevPage');
        const nextPageBtn = document.getElementById('menuNextPage');
        const pageInfo = document.getElementById('menuPageInfo');

        function getPageSize() {
            const width = window.innerWidth;
            if (width >= 1024) return 8;
            if (width >= 640) return 6;
            return 4;
        }

        function getMenuItems() {
            return Array.from(menuContainer.querySelectorAll('.menu-item'));
        }

        function applyMenuPagination() {
            const items = getMenuItems();
            const pageSize = getPageSize();
            const totalPages = Math.max(1, Math.ceil(items.length / pageSize));

            if (currentPage > totalPages) currentPage = totalPages;

            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;

            items.forEach((item, index) => {
                item.style.display = index >= start && index < end ? '' : 'none';
            });

            // Update Numbered Pagination
            const pageNumbersContainer = document.getElementById('menuPageNumbers');
            if (pageNumbersContainer) {
                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const span = document.createElement('span');
                    span.className = `pager-num ${i === currentPage ? 'active' : ''}`;
                    span.textContent = i;
                    span.onclick = () => {
                        if (i === currentPage) return;
                        currentPage = i;
                        applyMenuPagination();
                        animateVisibleItems();
                        window.scrollTo({ top: menuContainer.offsetTop - 150, behavior: 'smooth' });
                    };
                    pageNumbersContainer.appendChild(span);
                }
            }

            if (prevPageBtn) prevPageBtn.disabled = currentPage === 1;
            if (nextPageBtn) nextPageBtn.disabled = currentPage === totalPages;
            if (paginationWrap) paginationWrap.classList.toggle('hidden', items.length <= pageSize);
        }

        function animateVisibleItems() {
            const items = getMenuItems().filter(item => item.style.display !== 'none');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.transition = 'all 0.5s cubic-bezier(0.22, 1, 0.36, 1)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 80);
            });
        }

        if (prevPageBtn) {
            prevPageBtn.addEventListener('click', () => {
                if (currentPage <= 1) return;
                currentPage -= 1;
                applyMenuPagination();
                animateVisibleItems();
                window.scrollTo({ top: menuContainer.offsetTop - 150, behavior: 'smooth' });
            });
        }

        if (nextPageBtn) {
            nextPageBtn.addEventListener('click', () => {
                const totalItems = getMenuItems().length;
                const totalPages = Math.ceil(totalItems / getPageSize());
                if (currentPage >= totalPages) return;
                currentPage += 1;
                applyMenuPagination();
                animateVisibleItems();
                window.scrollTo({ top: menuContainer.offsetTop - 150, behavior: 'smooth' });
            });
        }

        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('filter-active');
                    btn.classList.add('filter-inactive');
                });
                this.classList.add('filter-active');
                this.classList.remove('filter-inactive');

                // Generate 8 skeleton cards
                const skeletonHtml = Array(8).fill(`
                    <div class="menu-item w-full">
                        <div class="menu-card border border-[#ece3d5]">
                            <div class="menu-card-img bg-[#EFE1D1]" style="animation: pulse-pub-skel 1.5s infinite ease-in-out;"></div>
                            <div class="menu-card-body">
                                <div class="bg-[#EFE1D1] rounded" style="height: 10px; width: 30%; margin-bottom: 12px; animation: pulse-pub-skel 1.5s infinite ease-in-out;"></div>
                                <div class="bg-[#EFE1D1] rounded" style="height: 20px; width: 80%; margin-bottom: 12px; animation: pulse-pub-skel 1.5s infinite ease-in-out; animation-delay: 0.1s;"></div>
                                <div class="bg-[#EFE1D1] rounded" style="height: 12px; width: 100%; margin-bottom: 6px; animation: pulse-pub-skel 1.5s infinite ease-in-out; animation-delay: 0.2s;"></div>
                                <div class="bg-[#EFE1D1] rounded" style="height: 12px; width: 90%; margin-bottom: 6px; animation: pulse-pub-skel 1.5s infinite ease-in-out; animation-delay: 0.2s;"></div>
                                <div class="bg-[#EFE1D1] rounded" style="height: 12px; width: 60%; margin-bottom: 24px; animation: pulse-pub-skel 1.5s infinite ease-in-out; animation-delay: 0.2s;"></div>
                                <div class="menu-card-footer" style="padding-top: 12px; margin-top: auto; border-top: 1px solid #f5f0e8;">
                                    <div class="bg-[#EFE1D1] rounded" style="height: 24px; width: 40%; animation: pulse-pub-skel 1.5s infinite ease-in-out; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');

                menuContainer.innerHTML = skeletonHtml;
                if (paginationWrap) paginationWrap.classList.add('hidden');
                currentPage = 1;

                fetch(`/filter-menu?category=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        menuContainer.innerHTML = data.html;
                        applyMenuPagination();
                        animateVisibleItems();
                    });
            });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    if (entry.target.id === 'menuContainer') animateVisibleItems();
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
        if (menuContainer) observer.observe(menuContainer);

        window.addEventListener('resize', applyMenuPagination);
        applyMenuPagination();
    </script>
</body>
</html>
