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
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .order-card {
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .order-card:hover {
            box-shadow: 0 18px 40px -28px rgba(15, 23, 42, 0.28);
            border-color: rgba(180, 35, 24, 0.2);
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="mb-8">
            <span class="text-red-700 font-bold tracking-widest text-xs sm:text-sm uppercase mb-1 block font-poppins text-center sm:text-left">Riwayat</span>
            <h1 class="text-3xl sm:text-4xl font-bold text-[#26180f] tracking-tight font-bold text-center sm:text-left flex flex-wrap justify-center sm:justify-start gap-x-4">
                Pesanan
                Saya
            </h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 overflow-x-auto hide-scrollbar">
            <div class="flex border-b border-gray-100 min-w-max">
                <a href="{{ route('my-orders', ['tab' => 'semua']) }}" class="flex-1 text-center py-4 px-6 text-sm font-semibold transition {{ $tab === 'semua' ? 'text-red-700 border-b-2 border-red-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                    Semua
                </a>
                <a href="{{ route('my-orders', ['tab' => 'belum-dibayar']) }}" class="flex-1 text-center py-4 px-6 text-sm font-semibold transition {{ $tab === 'belum-dibayar' ? 'text-red-700 border-b-2 border-red-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                    Belum Dibayar
                </a>
                <a href="{{ route('my-orders', ['tab' => 'diproses']) }}" class="flex-1 text-center py-4 px-6 text-sm font-semibold transition {{ $tab === 'diproses' ? 'text-red-700 border-b-2 border-red-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                    Diproses
                </a>
                <a href="{{ route('my-orders', ['tab' => 'selesai']) }}" class="flex-1 text-center py-4 px-6 text-sm font-semibold transition {{ $tab === 'selesai' ? 'text-red-700 border-b-2 border-red-700' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">Untuk Diulas</a>
            </div>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($orders as $order)
                @php
                    $isPending = $order->status === 'pending';
                    $statusLabel = 'Menunggu Konfirmasi';
                    $statusColor = 'bg-yellow-100 text-yellow-700';
                    
                    if ($order->status === 'pending') {
                        $statusLabel = 'Belum Dibayar';
                        $statusColor = 'bg-red-100 text-red-700';
                    } elseif (in_array($order->status, ['confirmed', 'shipped'])) {
                        $statusLabel = 'Sedang Diproses';
                        $statusColor = 'bg-blue-100 text-blue-700';
                    } elseif ($order->status === 'completed') {
                        $statusLabel = 'Diterima / Untuk Diulas';
                        $statusColor = 'bg-green-100 text-green-700';
                    } elseif ($order->status === 'rejected') {
                        $statusLabel = 'Dibatalkan';
                        $statusColor = 'bg-gray-200 text-gray-700';
                    }

                    $items = is_array($order->items) ? $order->items : json_decode($order->items, true);
                    $firstItem = !empty($items) ? $items[0] : null;
                    $itemCount = is_array($items) ? count($items) : 0;
                    $reviewedOrderIds = $reviewedOrderIds ?? [];
                    $isReviewed = in_array($order->order_id, $reviewedOrderIds, true);
                @endphp
                <div class="order-card bg-white rounded-xl shadow-sm overflow-hidden border border-[#f1e7db]">
                    <div class="p-5 sm:p-6">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-white shadow shrink-0 border border-[#f1e7db]">
                                @if($firstItem && isset($firstItem['image']))
                                    <img src="{{ asset('images/' . $firstItem['image']) }}" alt="{{ $firstItem['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="text-sm sm:text-base font-bold uppercase truncate">{{ $order->order_id }}</div>
                                        <div class="text-xs text-[#3a2a1a]/70 mt-1">{{ optional($order->created_at)->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <div class="text-sm sm:text-base font-bold text-[#b42318]">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</div>
                                        <span class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider {{ $statusColor }}">{{ $statusLabel }}</span>
                                    </div>
                                </div>

                                <div class="mt-3 space-y-3">
                                    @if($order->status === 'completed')
                                        @foreach($items as $iIt => $it)
                                            @if($iIt > 0)
                                                <div class="h-px bg-[#f1e7db]"></div>
                                            @endif
                                            <div class="flex gap-3 items-center">
                                                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-lg flex items-center justify-center text-gray-400 overflow-hidden shrink-0 border border-gray-200">
                                                    @if(isset($it['image']) && $it['image'])
                                                        <img src="{{ asset('images/' . $it['image']) }}" alt="{{ $it['name'] ?? '' }}" class="w-full h-full object-cover">
                                                    @else
                                                        <i class="fas fa-image text-xl"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-sm text-[#3a2a1a]">{{ $it['name'] ?? 'Pesanan Custom' }}</div>
                                                    <div class="text-xs text-gray-500">{{ (int)($it['quantity'] ?? 1) }} barang x Rp {{ number_format((float)($it['price'] ?? 0), 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex gap-3 items-center">
                                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-lg flex items-center justify-center text-gray-400 overflow-hidden shrink-0 border border-gray-200">
                                                @if($firstItem && isset($firstItem['image']))
                                                    <img src="{{ asset('images/' . $firstItem['image']) }}" alt="{{ $firstItem['name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    <i class="fas fa-image text-xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                @if($firstItem)
                                                    <div class="font-semibold text-sm text-[#3a2a1a]">{{ $firstItem['name'] }}</div>
                                                    <div class="text-xs text-gray-500">{{ (int)($firstItem['quantity'] ?? 1) }} barang x Rp {{ number_format((float)($firstItem['price'] ?? 0), 0, ',', '.') }}</div>
                                                @else
                                                    <div class="font-semibold text-sm text-[#3a2a1a]">Pesanan Custom</div>
                                                @endif
                                                @if($itemCount > 1)
                                                    <p class="text-xs text-gray-400 mt-1 italic">+ {{ $itemCount - 1 }} produk lainnya</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                                    @if($order->status === 'completed' && !$isReviewed)
                                        <div class="flex flex-col items-start gap-1">
                                            <span class="text-[10px] text-[#3a2a1a]/60 font-semibold uppercase tracking-[0.2em]">Ulasan Cepat</span>
                                            <div class="flex gap-1 quick-rating" data-order-id="{{ $order->order_id }}" data-rating="0">
                                                @for($i=1; $i<=5; $i++)
                                                    <button type="button" data-value="{{ $i }}" onclick="submitQuickRating(this, '{{ $order->order_id }}', '{{ addslashes($order->customer_name) }}', {{ $i }})" class="quick-star-btn text-[#e1d4c8] hover:text-[#b42318] transition" title="{{ $i }} Bintang"><i class="fas fa-star text-base"></i></button>
                                                @endfor
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex flex-col sm:items-end gap-2">
                                        @if($order->status === 'completed' && !$isReviewed)
                                            <a href="{{ route('transaksi.show', $order->order_id) }}" class="w-full sm:w-auto text-center px-4 py-2 bg-[#b42318] text-white text-xs font-bold rounded-lg hover:bg-[#8b1a12] transition shadow-[0_12px_24px_-18px_rgba(180,35,24,0.8)]">Tulis Ulasan</a>
                                        @elseif($order->status === 'completed' && $isReviewed)
                                            <a href="{{ route('menu.public') }}" class="w-full sm:w-auto text-center px-4 py-2 border border-[#b42318]/30 text-[#b42318] text-xs font-bold rounded-lg hover:bg-[#b42318]/10 transition">Beli Lagi</a>
                                        @elseif($order->status === 'completed')
                                            <a href="{{ route('transaksi.show', $order->order_id) }}" class="w-full sm:w-auto text-center px-4 py-2 bg-[#b42318] text-white text-xs font-bold rounded-lg hover:bg-[#8b1a12] transition shadow-[0_12px_24px_-18px_rgba(180,35,24,0.8)]">Tulis Ulasan</a>
                                        @else
                                            <a href="{{ route('transaksi.show', $order->order_id) }}" class="w-full sm:w-auto text-center px-4 py-2 border border-[#b42318]/30 text-[#b42318] text-xs font-bold rounded-lg hover:bg-[#b42318]/10 transition">Lihat Detail</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-12 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-box-open text-4xl text-red-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#3a2a1a] mb-2">Belum ada pesanan</h3>
                    <p class="text-sm text-gray-500 mb-6">Anda belum pernah melakukan pemesanan untuk status ini.</p>
                    <a href="{{ route('menu.public') }}" class="px-6 py-2.5 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 transition">Belanja Sekarang</a>
                </div>
            @endforelse
    </main>

<script>
    function updateQuickStars(container, value) {
        const stars = container.querySelectorAll('.quick-star-btn');
        stars.forEach((star, index) => {
            if (index < value) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-[#b42318]');
            } else {
                star.classList.remove('text-[#b42318]');
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
                    b.classList.remove("text-gray-300", "text-[#b42318]");
                    if(idx < rating) {
                        b.classList.add("text-[#b42318]");
                    } else {
                        b.classList.add("text-gray-300");
                    }
                    b.disabled = true;
                });
                container.dataset.rating = String(rating);
                updateQuickStars(container, rating);
                container.style.opacity = "1";
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











