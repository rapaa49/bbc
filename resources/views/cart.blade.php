<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <style>
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <div class="text-center mb-12">
            <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Pesanan Anda</span>
            <h1 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4">
                Keranjang Belanja
            </h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1 font-poppins font-medium">Pastikan pesanan kamu sudah sesuai sebelum lanjut ke pembayaran.</p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-center gap-3 mb-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 px-5 py-2.5 rounded-xl font-bold shadow-sm hover:bg-gray-50 transition-all">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if(count($items) > 0)
                <button type="button" onclick="clearCart()" class="inline-flex items-center gap-2 bg-gray-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm hover:bg-red-700 hover:shadow-md transition-all">
                    <i class="fas fa-trash-alt"></i> Kosongkan
                </button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 space-y-4">
                @php
                    $items = $items ?? [];
                    $subtotal = $subtotal ?? 0;
                @endphp

                @if(count($items) === 0)
                    <div class="bg-white rounded-[1.5rem] shadow-sm border border-gray-100 p-12 text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-50 text-red-600 text-4xl mb-6 shadow-inner">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kamu Masih Kosong</h2>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Sepertinya kamu belum memilih hidangan apapun. Yuk, jelajahi menu lezat kami dan temukan favoritmu!</p>
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('home') }}#paket" class="inline-flex items-center justify-center gap-2 bg-red-700 text-white px-8 py-3.5 rounded-xl font-bold shadow-[0_8px_20px_rgba(185,28,28,0.25)] hover:bg-red-800 hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-box-open"></i> Lihat Paket
                            </a>
                            <a href="{{ route('home') }}#menu" class="inline-flex items-center justify-center gap-2 bg-white text-gray-800 border border-gray-200 px-8 py-3.5 rounded-xl font-bold shadow-sm hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-utensils"></i> Eksplor Menu
                            </a>
                        </div>
                    </div>
                @else
                    @foreach($items as $item)
                        @php
                            $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                            $img = $item['image'] ?? null;
                        @endphp
                        <div class="bg-white rounded-[1.25rem] shadow-sm border border-gray-100 p-4 sm:p-5 transition-transform duration-300 hover:shadow-md hover:border-red-100 group">
                            <div class="flex gap-4 sm:gap-6 items-center">
                                <!-- Product Image -->
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-[1rem] overflow-hidden bg-gray-50 shrink-0 relative shadow-inner">
                                    @if($img)
                                        <img src="{{ $img }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                    @else
                                        <img src="https://placehold.co/200x200/fdf5e6/3a2a1a?text=Item" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="min-w-0 flex-1 flex flex-col justify-center">
                                    <div class="flex items-start justify-between gap-3 mb-2">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="shrink-0 text-[10px] font-bold px-2.5 py-1 rounded-md {{ ($item['type'] ?? '') === 'paket' ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-600' }}">
                                                    {{ strtoupper($item['type'] ?? '') }}
                                                </span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800 leading-snug truncate group-hover:text-red-700 transition-colors">{{ $item['name'] }}</h3>
                                            <div class="text-sm font-bold text-red-600 mt-1">Rp {{ number_format((float) ($item['price'] ?? 0), 0, ',', '.') }}</div>
                                        </div>

                                        <button type="button" onclick="removeItem('{{ $item['key'] }}')" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors" aria-label="Hapus">
                                            <i class="fas fa-times text-lg"></i>
                                        </button>
                                    </div>

                                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mt-2">
                                        <!-- Quantity Control -->
                                        <div class="inline-flex items-center p-1 rounded-xl border border-gray-200 bg-gray-50 shadow-sm">
                                            <button type="button" onclick="changeQty('{{ $item['key'] }}', -1)" class="w-8 h-8 rounded-lg bg-white text-gray-600 font-bold hover:text-red-600 hover:shadow-sm transition-all shadow-sm">-</button>
                                            <input id="qty-{{ $item['key'] }}" type="number" min="1" value="{{ (int) ($item['quantity'] ?? 1) }}" class="w-12 text-center bg-transparent font-bold text-gray-800 border-none focus:ring-0 focus:outline-none text-sm" onchange="setQty('{{ $item['key'] }}', this.value)" />
                                            <button type="button" onclick="changeQty('{{ $item['key'] }}', 1)" class="w-8 h-8 rounded-lg bg-white text-gray-600 font-bold hover:text-red-600 hover:shadow-sm transition-all shadow-sm">+</button>
                                        </div>

                                        <!-- Line Total -->
                                        <div class="text-right">
                                            <div class="text-xs text-gray-500 font-medium mb-1">Subtotal Item</div>
                                            <div class="font-bold text-gray-800 text-lg">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>

            <!-- Sidebar Summary -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-[1.5rem] shadow-lg shadow-gray-200/50 border border-gray-100 p-6 sm:p-8 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-4 mb-6">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 text-sm font-medium">
                        <div class="flex items-center justify-between text-gray-600">
                            <span>Subtotal Belanja</span>
                            <span class="font-bold text-gray-800">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-gray-600">
                            <span>Biaya Layanan</span>
                            <span class="font-bold text-green-600">Gratis</span>
                        </div>
                        
                        <div class="pt-4 mt-2 border-t border-gray-100 border-dashed">
                            <div class="flex items-center justify-between">
                                <span class="text-base text-gray-800 font-bold">Total Pembayaran</span>
                                <span class="text-xl font-bold text-red-700">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="{{ route('checkout.index') }}" class="w-full inline-flex items-center justify-center gap-2 bg-red-700 text-white px-5 py-4 rounded-xl font-bold shadow-[0_8px_20px_rgba(185,28,28,0.25)] hover:bg-red-800 hover:-translate-y-1 transition-all duration-300">
                            Lanjut Pembayaran <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('home') }}#menu" class="w-full inline-flex items-center justify-center bg-gray-50 text-gray-700 hover:text-gray-900 border border-gray-200 px-5 py-3.5 rounded-xl font-bold hover:bg-gray-100 transition-all duration-300">
                            Tambah Menu Lain
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <script>
        function csrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        }

        function postJson(url, body) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken(),
                },
                body: JSON.stringify(body || {}),
            });
        }

        function updateCartCountBadge() {
            fetch('/api/cart-count')
                .then(r => r.json())
                .then(data => {
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) cartCount.textContent = data.count;
                });
        }

        function changeQty(key, delta) {
            const input = document.getElementById(`qty-${key}`);
            if (!input) return;
            const next = Math.max(1, (parseInt(input.value || '1', 10) + delta));
            input.value = next;
            setQty(key, next);
        }

        function setQty(key, qty) {
            const quantity = Math.max(1, parseInt(qty || '1', 10));
            postJson('{{ route('cart.update') }}', { key, quantity })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        function removeItem(key) {
            postJson('{{ route('cart.remove') }}', { key })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        function clearCart() {
            postJson('{{ route('cart.clear') }}')
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                    window.location.reload();
                })
                .catch(() => window.location.reload());
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCountBadge();
        });
    </script>
</body>
</html>




