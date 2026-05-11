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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* ── Cart item card ── */
        .cart-item-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #ece3d5;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .cart-item-card:hover {
            border-color: #d6c9b8;
            box-shadow: 0 8px 28px -8px rgba(26, 18, 11, 0.1);
        }

        /* ── Quantity control ── */
        .qty-control {
            display: inline-flex;
            align-items: center;
            background: #f8f5f0;
            border: 1px solid #ece3d5;
            border-radius: 12px;
            padding: 3px;
            gap: 0;
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: #fff;
            border: none;
            color: #5a4a3a;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(26, 18, 11, 0.06);
        }
        .qty-btn:hover {
            color: #8B0000;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.12);
        }
        .qty-input {
            width: 40px;
            text-align: center;
            background: transparent;
            border: none;
            font-weight: 700;
            font-size: 14px;
            color: #1a120b;
            outline: none;
            -moz-appearance: textfield;
        }
        .qty-input::-webkit-inner-spin-button,
        .qty-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* ── Summary card ── */
        .summary-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #ece3d5;
            box-shadow: 0 8px 32px -12px rgba(26, 18, 11, 0.08);
        }

        /* ── Fade-in ── */
        .fade-in-item {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInItem 0.35s ease forwards;
        }
        @keyframes fadeInItem {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 sm:px-5 pt-12 pb-12">

        {{-- ── Header ── --}}
        <div class="flex items-end justify-between mb-5">
            <div>
                <p class="text-[11px] font-bold text-[#8B0000] uppercase tracking-[0.18em] mb-1 font-poppins">Pesanan Anda</p>
                <h1 class="text-2xl sm:text-[1.65rem] font-extrabold text-[#1a120b] tracking-tight leading-tight">Keranjang Belanja</h1>
                <p class="text-[13px] text-[#8a7b6a] mt-1 font-poppins">Pastikan pesanan kamu sudah sesuai sebelum lanjut.</p>
            </div>
        </div>

        {{-- ── Action bar ── --}}
        <div class="flex items-center gap-2 mb-5">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-white text-[#1a120b] border border-[#ece3d5] px-4 py-2.5 rounded-xl text-xs font-bold hover:bg-[#f8f5f0] transition-all">
                <i class="fas fa-arrow-left text-[10px] opacity-50"></i> Kembali
            </a>
            @if(count($items) > 0)
            <button type="button" onclick="clearCart()" class="inline-flex items-center gap-2 bg-[#1a120b] text-white px-4 py-2.5 rounded-xl text-xs font-bold hover:bg-[#8B0000] transition-all">
                <i class="fas fa-trash-alt text-[10px]"></i> Kosongkan
            </button>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- ── Items ── --}}
            <section class="lg:col-span-2 space-y-3">
                @php
                    $items = $items ?? [];
                    $subtotal = $subtotal ?? 0;
                @endphp

                @if(count($items) === 0)
                    <div class="bg-white rounded-2xl border border-[#ece3d5] p-10 sm:p-14 flex flex-col items-center justify-center text-center">
                        <div class="w-20 h-20 bg-[#f8f5f0] rounded-2xl flex items-center justify-center mb-5 border border-[#ece3d5]">
                            <i class="fas fa-shopping-basket text-3xl text-[#c4b5a2]"></i>
                        </div>
                        <h2 class="text-lg font-bold text-[#1a120b] mb-1.5">Keranjang Kamu Masih Kosong</h2>
                        <p class="text-sm text-[#8a7b6a] mb-6 max-w-xs font-poppins">Yuk, jelajahi paket lezat kami dan temukan favoritmu!</p>
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <a href="{{ route('home') }}#paket" class="inline-flex items-center justify-center gap-2 bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300">
                                <i class="fas fa-box-open text-xs"></i> Lihat Paket
                            </a>
                        </div>
                    </div>
                @else
                    @foreach($items as $index => $item)
                        @php
                            $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                            $img = $item['image'] ?? null;
                        @endphp
                        <div class="cart-item-card fade-in-item" style="animation-delay: {{ $index * 0.05 }}s">
                            <div class="p-4 sm:p-5">
                                <div class="flex gap-4 items-start">
                                    {{-- Image --}}
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-[#f8f5f0] shrink-0 border border-[#ece3d5]">
                                        @if($img)
                                            <img src="{{ $img }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[#c4b5a2]">
                                                <i class="fas fa-utensils text-xl"></i>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Details --}}
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-md uppercase {{ ($item['type'] ?? '') === 'paket' ? 'bg-orange-50 text-orange-700 border border-orange-200/60' : 'bg-[#f8f5f0] text-[#8a7b6a] border border-[#ece3d5]' }}">
                                                    {{ strtoupper($item['type'] ?? '') }}
                                                </span>
                                                <h3 class="text-[15px] font-bold text-[#1a120b] leading-snug mt-1.5 truncate">{{ $item['name'] }}</h3>
                                                <p class="text-[13px] font-bold text-[#8B0000] mt-0.5">Rp {{ number_format((float) ($item['price'] ?? 0), 0, ',', '.') }}</p>
                                            </div>
                                            <button type="button" onclick="removeItem('{{ $item['key'] }}')" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#c4b5a2] hover:bg-red-50 hover:text-[#8B0000] transition-all shrink-0" aria-label="Hapus">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mt-3">
                                            {{-- Qty --}}
                                            <div class="qty-control">
                                                <button type="button" onclick="changeQty('{{ $item['key'] }}', -1)" class="qty-btn">−</button>
                                                <input id="qty-{{ $item['key'] }}" type="number" min="1" value="{{ (int) ($item['quantity'] ?? 1) }}" data-price="{{ (float) ($item['price'] ?? 0) }}" class="qty-input" onchange="setQty('{{ $item['key'] }}', this.value)" />
                                                <button type="button" onclick="changeQty('{{ $item['key'] }}', 1)" class="qty-btn">+</button>
                                            </div>

                                            {{-- Line total --}}
                                            <div class="text-right">
                                                <p class="text-[10px] text-[#a89880] font-medium uppercase tracking-wider">Subtotal</p>
                                                <p id="line-total-{{ $item['key'] }}" class="text-[15px] font-extrabold text-[#1a120b]">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>

            {{-- ── Summary sidebar ── --}}
            <aside class="lg:col-span-1">
                <div class="summary-card p-5 sm:p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-[#1a120b] border-b border-[#f0ebe4] pb-3 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between text-[#8a7b6a]">
                            <span class="font-medium">Subtotal Belanja</span>
                            <span id="subtotal-belanja" class="font-bold text-[#1a120b]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[#8a7b6a]">
                            <span class="font-medium">Biaya Layanan</span>
                            <span class="font-bold text-emerald-600">Gratis</span>
                        </div>
                        
                        <div class="pt-3 mt-1 border-t border-dashed border-[#ece3d5]">
                            <div class="flex items-center justify-between">
                                <span class="text-[15px] text-[#1a120b] font-bold">Total</span>
                                <span id="total-belanja" class="text-xl font-extrabold text-[#8B0000]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2.5">
                        @if(count($items) > 0)
                            <a href="{{ route('checkout.index') }}" class="w-full inline-flex items-center justify-center gap-2 bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white px-5 py-3.5 rounded-xl text-sm font-bold transition-all duration-300">
                                Lanjut Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        @else
                            <button type="button" disabled class="w-full inline-flex items-center justify-center gap-2 bg-gray-200 text-gray-400 px-5 py-3.5 rounded-xl text-sm font-bold cursor-not-allowed">
                                Lanjut Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        @endif
                        <a href="{{ route('home') }}#paket" class="w-full inline-flex items-center justify-center bg-[#f8f5f0] text-[#1a120b] border border-[#ece3d5] px-5 py-3 rounded-xl text-sm font-bold hover:bg-[#f0ebe4] transition-all">
                            Tambah Paket Lain
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

        function updateCartDOM() {
            let total = 0;
            document.querySelectorAll('.qty-input').forEach(input => {
                const qty = parseInt(input.value || '1', 10);
                const price = parseFloat(input.dataset.price || '0');
                const lineTotal = qty * price;
                total += lineTotal;
                
                const key = input.id.replace('qty-', '');
                const lineTotalEl = document.getElementById(`line-total-${key}`);
                if (lineTotalEl) {
                    lineTotalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(lineTotal);
                }
            });

            const formattedTotal = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            const subtotalEl = document.getElementById('subtotal-belanja');
            if (subtotalEl) subtotalEl.textContent = formattedTotal;
            
            const totalEl = document.getElementById('total-belanja');
            if (totalEl) totalEl.textContent = formattedTotal;
        }

        function setQty(key, qty) {
            const quantity = Math.max(1, parseInt(qty || '1', 10));
            // Update UI instantly
            updateCartDOM();

            // Background sync
            postJson('{{ route('cart.update') }}', { key, quantity })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    updateCartCountBadge();
                })
                .catch(() => {
                    console.error('Cart update failed');
                });
        }

        function removeItem(key) {
            // Optimistically remove from UI
            const input = document.getElementById('qty-' + key);
            if (input) {
                const card = input.closest('.cart-item-card');
                if (card) {
                    card.remove();
                    updateCartDOM();
                }
            }

            postJson('{{ route('cart.remove') }}', { key })
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then((data) => {
                    updateCartCountBadge();
                    if (data && data.count === 0) {
                        showEmptyCart();
                    }
                })
                .catch(() => {
                    console.error('Remove item failed');
                });
        }

        function clearCart() {
            postJson('{{ route('cart.clear') }}')
                .then(res => {
                    if (!res.ok) throw new Error('failed');
                    return res.json();
                })
                .then(() => {
                    showEmptyCart();
                })
                .catch(() => {
                    console.error('Clear cart failed');
                });
        }

        function showEmptyCart() {
            // Replace items section with the empty state UI
            const itemsSection = document.querySelector('section.lg\\:col-span-2');
            if (itemsSection) {
                itemsSection.innerHTML = `
                    <div class="bg-white rounded-2xl border border-[#ece3d5] p-10 sm:p-14 flex flex-col items-center justify-center text-center">
                        <div class="w-20 h-20 bg-[#f8f5f0] rounded-2xl flex items-center justify-center mb-5 border border-[#ece3d5]">
                            <i class="fas fa-shopping-basket text-3xl text-[#c4b5a2]"></i>
                        </div>
                        <h2 class="text-lg font-bold text-[#1a120b] mb-1.5">Keranjang Kamu Masih Kosong</h2>
                        <p class="text-sm text-[#8a7b6a] mb-6 max-w-xs font-poppins">Yuk, jelajahi paket lezat kami dan temukan favoritmu!</p>
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <a href="{{ route('home') }}#paket" class="inline-flex items-center justify-center gap-2 bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300">
                                <i class="fas fa-box-open text-xs"></i> Lihat Paket
                            </a>
                        </div>
                    </div>
                `;
            }

            // Reset totals
            const subtotalEl = document.getElementById('subtotal-belanja');
            if (subtotalEl) subtotalEl.textContent = 'Rp 0';
            const totalEl = document.getElementById('total-belanja');
            if (totalEl) totalEl.textContent = 'Rp 0';

            updateCartCountBadge();
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCountBadge();
        });
    </script>
</body>
</html>

