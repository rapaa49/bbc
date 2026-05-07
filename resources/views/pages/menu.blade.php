<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <style>
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .page-bg-image {
            position: relative;
            background-image: url('{{ asset('bg_body.png') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
        }

        .page-bg-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(239, 225, 209, 0.72);
            pointer-events: none;
        }

        .page-bg-image > * {
            position: relative;
            z-index: 1;
        }

        .menu-shell {
            max-width: 1080px;
            margin: 0 auto;
            position: relative;
        }

        .filter-btn {
            border-radius: 9999px;
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1;
            background: #fff;
            border: 1px solid rgba(58, 32, 24, 0.1);
            color: #6a4a34;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .filter-btn.filter-active {
            background: #8b0000;
            color: #ffffff;
            border-color: #8b0000;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
            font-weight: 700;
            transform: translateY(-2px);
        }

        .filter-btn.filter-inactive {
            background: #ffffff;
            color: #6a4a34;
            border-color: rgba(58, 32, 24, 0.1);
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            background: #fdf5e6;
            color: #8b0000;
            border-color: #8b0000;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.1);
        }

        .filter-btn.filter-active:hover {
            background: #6b0000;
            color: #ffffff;
            border-color: #6b0000;
            box-shadow: 0 6px 14px rgba(107, 0, 0, 0.3);
        }

        .pager-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.2rem;
        }

        .pager-btn {
            width: 2.1rem;
            height: 2.1rem;
            border-radius: 999px;
            border: 1px solid rgba(58, 32, 24, 0.2);
            background: #fff7ee;
            color: #3a2018;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .pager-btn:hover:not(:disabled) {
            background: #ef2f24;
            border-color: #ef2f24;
            color: #fff;
            transform: translateY(-1px);
        }

        .pager-btn:disabled {
            opacity: 0.42;
            cursor: not-allowed;
        }

        .pager-info {
            min-width: 130px;
            text-align: center;
            font-size: 0.82rem;
            font-weight: 600;
            color: #4a2d21;
        }

        .delivery-availability {
            margin-top: 1.6rem;
            padding-top: 1.25rem;
            border-top: 2px solid rgba(239, 47, 36, 0.9);
        }

        .delivery-title {
            text-align: center;
            color: #ef2f24;
            font-size: 2.05rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 1rem;
            letter-spacing: 0.01em;
        }

        .delivery-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.9rem;
            justify-items: center;
        }

        .delivery-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            min-width: 190px;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            color: #7a0f15;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .delivery-link:hover {
            transform: translateY(-1px);
            filter: brightness(0.96);
        }

        .delivery-pill-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #ef2f24;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
        }

        .delivery-pill-text {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 0.005em;
            line-height: 1;
            color: #8b0f16;
        }

        @media (min-width: 768px) {
            .delivery-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
                gap: 1.4rem;
            }

            .delivery-title {
                margin-bottom: 1.2rem;
            }
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden" style="font-family: 'Poppins', sans-serif;">
    @include('partials.navbar')

    <section class="py-20 page-bg-image">
        <div class="menu-shell px-4 sm:px-6">
            <div class="text-center mb-10">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Kelezatan Tiada Tara</span>
                <h1 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4 text-center">
                    Menu
                    Spesial
                </h1>
                <p class="text-base md:text-lg text-gray-700 max-w-2xl mx-auto font-medium font-poppins">Temukan hidangan favorit Anda dari berbagai varian bakso dan mie ayam autentik yang diolah dengan bahan-bahan pilihan terbaik.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <button class="filter-btn filter-active" data-filter="all">Semua</button>
                @foreach(['bakso', 'mie', 'paket', 'minuman'] as $category)
                <button class="filter-btn filter-inactive" data-filter="{{ $category }}">{{ $category == 'mie' ? 'Mie Ayam' : ucfirst($category) }}</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5 items-stretch" id="menuContainer">
                @include('partials.menu-items')
            </div>

            <div id="menuPagination" class="pager-wrap">
                <button id="menuPrevPage" type="button" class="pager-btn" aria-label="Halaman sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="menuPageInfo" class="pager-info">Halaman 1 dari 1</div>
                <button id="menuNextPage" type="button" class="pager-btn" aria-label="Halaman berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="delivery-availability">
                <h4 class="delivery-title">Tersedia di</h4>
                <div class="delivery-grid">
                    <a href="https://gofood.co.id" target="_blank" rel="noopener" class="delivery-link" aria-label="GoFood">
                        <span class="delivery-pill-icon"><i class="fas fa-utensils"></i></span>
                        <span class="delivery-pill-text">gofood</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
            if (width >= 1280) return 8;
            if (width >= 1024) return 6;
            if (width >= 640) return 4;
            return 4;
        }

        function getMenuItems() {
            if (!menuContainer) return [];
            return Array.from(menuContainer.querySelectorAll('.menu-item'));
        }

        function applyMenuPagination() {
            const items = getMenuItems();
            const pageSize = getPageSize();
            const totalPages = Math.max(1, Math.ceil(items.length / pageSize));

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;

            items.forEach((item, index) => {
                item.style.display = index >= start && index < end ? '' : 'none';
            });

            if (pageInfo) {
                pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
            }

            if (prevPageBtn) {
                prevPageBtn.disabled = currentPage === 1;
            }

            if (nextPageBtn) {
                nextPageBtn.disabled = currentPage === totalPages;
            }

            if (paginationWrap) {
                paginationWrap.classList.toggle('hidden', items.length <= pageSize);
            }
        }

        function animateVisibleItems() {
            const items = getMenuItems().filter(item => item.style.display !== 'none');
            items.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(16px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 55);
            });
        }

        if (prevPageBtn) {
            prevPageBtn.addEventListener('click', () => {
                if (currentPage <= 1) return;
                currentPage -= 1;
                applyMenuPagination();
                animateVisibleItems();
            });
        }

        if (nextPageBtn) {
            nextPageBtn.addEventListener('click', () => {
                const totalItems = getMenuItems().length;
                const totalPages = Math.max(1, Math.ceil(totalItems / getPageSize()));
                if (currentPage >= totalPages) return;
                currentPage += 1;
                applyMenuPagination();
                animateVisibleItems();
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

                if (!menuContainer) return;

                menuContainer.innerHTML = '<div class="col-span-full text-center py-8"><i class="fas fa-spinner fa-spin text-3xl text-red-600"></i><p class="mt-4 text-gray-600">Memuat menu...</p></div>';
                if (paginationWrap) {
                    paginationWrap.classList.add('hidden');
                }
                currentPage = 1;

                fetch(`/filter-menu?category=${filter}`)
                    .then(response => response.json())
                    .then(data => {
                        menuContainer.innerHTML = data.html;
                        applyMenuPagination();
                        animateVisibleItems();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        menuContainer.innerHTML = '<div class="col-span-full text-center py-8 text-red-600"><i class="fas fa-exclamation-triangle text-3xl"></i><p class="mt-4">Terjadi kesalahan saat memuat menu</p></div>';
                    });
            });
        });

        window.addEventListener('resize', () => {
            applyMenuPagination();
            animateVisibleItems();
        });

        applyMenuPagination();
        animateVisibleItems();
    </script>
</body>
</html>




