<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'playfair': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }

        /* ── Scrollbar hide ── */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── Tab styles ── */
        /* ── Tabs: 2x2 grid on mobile, inline on desktop ── */
        .order-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        @media (min-width: 640px) {
            .order-tabs {
                display: flex;
                gap: 6px;
            }
        }
        .tab-item {
            position: relative;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 600;
            color: #8a7b6a;
            background: rgba(255,255,255,0.45);
            border: 1.5px solid #e8ddd0;
            transition: all 0.25s ease;
            white-space: nowrap;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-align: center;
        }
        .tab-item:hover {
            color: #5a4a3a;
            background: rgba(255, 255, 255, 0.7);
        }
        .tab-item.active {
            color: #1a120b;
            background: #fff;
            border-color: #d6c9b8;
            box-shadow: 0 2px 8px rgba(26, 18, 11, 0.06);
        }
        .tab-item i {
            font-size: 11px;
            opacity: 0.6;
        }
        .tab-item.active i {
            opacity: 1;
            color: #8B0000;
        }
        @media (min-width: 640px) {
            .tab-item {
                padding: 10px 16px;
                font-size: 13px;
                flex-shrink: 0;
            }
        }

        /* ── Order card ── */
        .order-card-v2 {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #ece3d5;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .order-card-v2:hover {
            border-color: #d6c9b8;
            box-shadow: 0 8px 28px -8px rgba(26, 18, 11, 0.1);
        }

        /* ── Star rating ── */
        .star-rating-btn {
            color: #d6cec4;
            transition: color 0.15s ease, transform 0.15s ease;
            cursor: pointer;
            padding: 2px;
            background: none;
            border: none;
        }
        .star-rating-btn:hover {
            transform: scale(1.15);
        }
        .star-rating-btn.lit {
            color: #8B0000;
        }

        /* ── Fade-in animation ── */
        .fade-in-card {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInCard 0.35s ease forwards;
        }
        @keyframes fadeInCard {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    <main class="max-w-3xl mx-auto px-4 sm:px-5 pt-2 pb-12">

        {{-- ── Header ── --}}
        <div class="flex items-end justify-between mb-4">
            <div>
                <p class="text-[11px] font-bold text-[#8B0000] uppercase tracking-[0.18em] mb-1 font-poppins">Riwayat</p>
                <h1 class="text-2xl sm:text-[1.65rem] font-extrabold text-[#1a120b] tracking-tight leading-tight">Pesanan Saya</h1>
            </div>
            <a href="{{ route('menu.public') }}" onclick="document.body.classList.add('public-skeleton-loading');" class="hidden sm:inline-flex items-center gap-2 text-xs font-bold text-[#8B0000] hover:text-[#6d0000] transition px-3 py-2 rounded-lg hover:bg-[#8B0000]/5">
                <i class="fas fa-plus text-[10px]"></i> Pesan Lagi
            </a>
        </div>

        {{-- ── Tabs ── --}}
        <div class="mb-5">
            <div class="order-tabs">
                <a href="{{ route('my-orders', ['tab' => 'semua']) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="tab-item {{ $tab === 'semua' ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>Semua
                </a>
                <a href="{{ route('my-orders', ['tab' => 'belum-dibayar']) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="tab-item {{ $tab === 'belum-dibayar' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>Belum Dibayar
                </a>
                <a href="{{ route('my-orders', ['tab' => 'diproses']) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="tab-item {{ $tab === 'diproses' ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>Diproses
                </a>
                <a href="{{ route('my-orders', ['tab' => 'selesai']) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="tab-item {{ $tab === 'selesai' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i>Untuk Diulas
                </a>
            </div>
        </div>

        {{-- ── Order list ── --}}
        <div class="space-y-3">
            @forelse($orders as $index => $order)
                @php
                    $isPending = $order->status === 'pending';
                    $statusLabel = 'Menunggu Konfirmasi';
                    $statusBg = 'bg-yellow-50 text-yellow-700 border-yellow-200/60';
                    $statusIcon = 'fas fa-hourglass-half';
                    
                    if ($order->status === 'pending') {
                        $statusLabel = 'Belum Dibayar';
                        $statusBg = 'bg-[#fff5f5] text-[#8B0000] border-[#8B0000]/10';
                        $statusIcon = 'fas fa-clock';
                    } elseif (in_array($order->status, ['confirmed', 'shipped'])) {
                        $statusLabel = 'Sedang Diproses';
                        $statusBg = 'bg-blue-50 text-blue-600 border-blue-200/60';
                        $statusIcon = 'fas fa-fire';
                    } elseif ($order->status === 'completed') {
                        $statusLabel = 'Selesai';
                        $statusBg = 'bg-emerald-50 text-emerald-600 border-emerald-200/60';
                        $statusIcon = 'fas fa-check-circle';
                    } elseif ($order->status === 'rejected') {
                        $statusLabel = 'Dibatalkan';
                        $statusBg = 'bg-gray-50 text-gray-500 border-gray-200/60';
                        $statusIcon = 'fas fa-times-circle';
                    }

                    $items = is_array($order->items) ? $order->items : json_decode($order->items, true);
                    $firstItem = !empty($items) ? $items[0] : null;
                    $itemCount = is_array($items) ? count($items) : 0;
                    $reviewedOrderIds = $reviewedOrderIds ?? [];
                    $isReviewed = in_array($order->order_id, $reviewedOrderIds, true);
                @endphp

                <div class="order-card-v2 fade-in-card" style="animation-delay: {{ $index * 0.05 }}s">
                    {{-- Card header --}}
                    <div class="flex items-center justify-between px-4 sm:px-5 py-3 border-b border-[#f5f0ea]">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border {{ $statusBg }}">
                                <i class="{{ $statusIcon }} text-[9px]"></i>{{ $statusLabel }}
                            </span>
                        </div>
                        <span class="text-[11px] text-[#8a7b6a] font-medium shrink-0 ml-2">{{ optional($order->created_at)->format('d M Y, H:i') }}</span>
                    </div>

                    {{-- Card body --}}
                    <div class="px-4 sm:px-5 py-4">
                        @if($order->status === 'completed')
                            {{-- All items for completed --}}
                            <div class="space-y-3">
                                @foreach($items as $iIt => $it)
                                    <div class="flex gap-3 items-center">
                                        <div class="w-[52px] h-[52px] rounded-xl overflow-hidden bg-[#f8f5f0] shrink-0 border border-[#ece3d5]">
                                            @if(isset($it['image']) && $it['image'])
                                                <img src="{{ asset('images/' . $it['image']) }}" alt="{{ $it['name'] ?? '' }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[#c4b5a2]">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-[13px] font-semibold text-[#1a120b] truncate">{{ $it['name'] ?? 'Pesanan Custom' }}</p>
                                            <p class="text-[11px] text-[#8a7b6a] mt-0.5">{{ (int)($it['quantity'] ?? 1) }}x &middot; Rp {{ number_format((float)($it['price'] ?? 0), 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="h-px bg-[#f5f0ea] ml-[64px]"></div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            {{-- First item only --}}
                            <div class="flex gap-3 items-center">
                                <div class="w-[52px] h-[52px] rounded-xl overflow-hidden bg-[#f8f5f0] shrink-0 border border-[#ece3d5]">
                                    @if($firstItem && isset($firstItem['image']))
                                        <img src="{{ asset('images/' . $firstItem['image']) }}" alt="{{ $firstItem['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[#c4b5a2]">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    @if($firstItem)
                                        <p class="text-[13px] font-semibold text-[#1a120b] truncate">{{ $firstItem['name'] }}</p>
                                        <p class="text-[11px] text-[#8a7b6a] mt-0.5">{{ (int)($firstItem['quantity'] ?? 1) }}x &middot; Rp {{ number_format((float)($firstItem['price'] ?? 0), 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-[13px] font-semibold text-[#1a120b]">Pesanan Custom</p>
                                    @endif
                                    @if($itemCount > 1)
                                        <p class="text-[11px] text-[#a89880] mt-0.5">+ {{ $itemCount - 1 }} produk lainnya</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Card footer --}}
                    <div class="px-4 sm:px-5 py-3 bg-[#fdfbf8] border-t border-[#f5f0ea]">
                        <div class="flex items-center justify-between gap-3">
                            {{-- Left: ID + total --}}
                            <div class="min-w-0">
                                <p class="text-[10px] text-[#a89880] font-medium uppercase tracking-wider truncate">{{ $order->order_id }}</p>
                                <p class="text-[15px] font-extrabold text-[#1a120b] mt-0.5">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</p>
                            </div>

                            {{-- Right: actions --}}
                            <div class="flex items-center gap-2 shrink-0">
                                @if($order->status === 'completed' && !$isReviewed)
                                    <div class="hidden sm:flex items-center gap-0.5 quick-rating" data-order-id="{{ $order->order_id }}" data-rating="0">
                                        @for($i=1; $i<=5; $i++)
                                            <button type="button" data-value="{{ $i }}" onclick="submitQuickRating(this, '{{ $order->order_id }}', '{{ addslashes($order->customer_name) }}', {{ $i }})" class="star-rating-btn quick-star-btn" title="{{ $i }} Bintang"><i class="fas fa-star text-sm"></i></button>
                                        @endfor
                                    </div>
                                    <a href="{{ route('transaksi.show', $order->order_id) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#8B0000] text-white text-[11px] font-bold rounded-lg hover:bg-[#6d0000] transition-all shadow-[0_4px_12px_rgba(139,0,0,0.2)] hover:shadow-[0_6px_16px_rgba(139,0,0,0.3)] hover:-translate-y-0.5">
                                        <i class="fas fa-pen text-[9px]"></i> Ulasan
                                    </a>
                                @elseif($order->status === 'completed' && $isReviewed)
                                    <span class="inline-flex items-center gap-1 text-[11px] text-emerald-600 font-semibold mr-1"><i class="fas fa-check-circle text-[10px]"></i> Diulas</span>
                                    <a href="{{ route('menu.public') }}" onclick="document.body.classList.add('public-skeleton-loading');" class="inline-flex items-center gap-1.5 px-4 py-2 border border-[#8B0000]/20 text-[#8B0000] text-[11px] font-bold rounded-lg hover:bg-[#8B0000]/5 transition-all">
                                        <i class="fas fa-redo text-[9px]"></i> Beli Lagi
                                    </a>
                                @else
                                    <a href="{{ route('transaksi.show', $order->order_id) }}" onclick="document.body.classList.add('public-skeleton-loading');" class="inline-flex items-center gap-1.5 px-4 py-2 border border-[#1a120b]/10 text-[#1a120b] text-[11px] font-bold rounded-lg hover:bg-[#1a120b]/[0.03] transition-all">
                                        Detail <i class="fas fa-arrow-right text-[9px] opacity-40"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Mobile quick rating --}}
                        @if($order->status === 'completed' && !$isReviewed)
                            <div class="sm:hidden mt-3 pt-3 border-t border-[#f0ebe4] flex items-center justify-between">
                                <span class="text-[10px] text-[#a89880] font-semibold uppercase tracking-wider">Beri Rating</span>
                                <div class="flex items-center gap-1 quick-rating" data-order-id="{{ $order->order_id }}" data-rating="0">
                                    @for($i=1; $i<=5; $i++)
                                        <button type="button" data-value="{{ $i }}" onclick="submitQuickRating(this, '{{ $order->order_id }}', '{{ addslashes($order->customer_name) }}', {{ $i }})" class="star-rating-btn quick-star-btn" title="{{ $i }} Bintang"><i class="fas fa-star text-base"></i></button>
                                    @endfor
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                {{-- Empty state --}}
                <div class="bg-white rounded-2xl border border-[#ece3d5] p-10 sm:p-14 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-[#f8f5f0] rounded-2xl flex items-center justify-center mb-5 border border-[#ece3d5]">
                        <i class="fas fa-box-open text-3xl text-[#c4b5a2]"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#1a120b] mb-1.5">Belum ada pesanan</h3>
                    <p class="text-sm text-[#8a7b6a] mb-6 max-w-xs font-poppins">Anda belum pernah melakukan pemesanan untuk status ini. Yuk, mulai pesan sekarang!</p>
                    <a href="{{ route('menu.public') }}" onclick="document.body.classList.add('public-skeleton-loading');" class="inline-flex items-center gap-2 px-6 py-3 bg-[#8B0000] text-white text-sm font-bold rounded-xl hover:bg-[#6d0000] transition-all shadow-[0_8px_20px_rgba(139,0,0,0.18)] hover:shadow-[0_10px_24px_rgba(139,0,0,0.25)] hover:-translate-y-0.5">
                        <i class="fas fa-utensils text-xs"></i> Belanja Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </main>

<script>
    function updateQuickStars(container, value) {
        const stars = container.querySelectorAll('.quick-star-btn');
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-[#8B0000]');
            } else {
                star.classList.remove('text-[#8B0000]');
                star.classList.add('text-gray-300');
            }
        });
    }

    function submitQuickRating(button, orderId, customerName, rating) {
        if (!confirm("Kirim ulasan " + rating + " bintang?")) return;
        
        const btn = button;
        const container = btn.closest('.quick-rating');
        if (!container) return;
        container.style.opacity = "0.5";
        
        fetch("{{ route('testimonial.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                order_id: orderId,
                customer_name: customerName,
                content: "Layanan sangat memuaskan, bintang " + rating,
                rating: rating
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Terima kasih atas ulasan Anda!");
                const buttons = container.querySelectorAll("button");
                buttons.forEach((b, idx) => {
                    b.classList.remove("text-gray-300", "text-[#8B0000]");
                    if(idx < rating) {
                        b.classList.add("text-[#8B0000]");
                    } else {
                        b.classList.add("text-gray-300");
                    }
                    b.disabled = true;
                });
                container.dataset.rating = String(rating);
                updateQuickStars(container, rating);
                container.style.opacity = "1";
                document.body.classList.add('public-skeleton-loading');
                setTimeout(() => {
                    window.location.href = "{{ route('my-orders', ['tab' => 'semua']) }}";
                }, 800);
            } else {
                throw new Error(data.message || "Gagal mengirim ulasan");
            }
        })
        .catch(error => {
            console.error(error);
            alert("Terjadi kesalahan: " + error.message);
            container.style.opacity = "1";
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.quick-rating').forEach((container) => {
            const stars = container.querySelectorAll('.quick-star-btn');
            stars.forEach((star) => {
                star.addEventListener('mouseenter', () => {
                    if (star.disabled) return;
                    const value = parseInt(star.dataset.value || '0', 10);
                    updateQuickStars(container, Number.isNaN(value) ? 0 : value);
                });
            });

            container.addEventListener('mouseleave', () => {
                const selected = parseInt(container.dataset.rating || '0', 10);
                updateQuickStars(container, Number.isNaN(selected) ? 0 : selected);
            });

            const initial = parseInt(container.dataset.rating || '0', 10);
            updateQuickStars(container, Number.isNaN(initial) ? 0 : initial);
        });
    });
</script>
</body>
</html>
