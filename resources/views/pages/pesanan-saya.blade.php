<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Saya - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden" style="font-family: 'Poppins', sans-serif;">
    @include('partials.navbar')

    <section class="pt-12 pb-24 bg-[#EFE1D1]">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-10">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Riwayat</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight mb-4 text-center">
                    Pesanan Saya
                </h2>
            </div>

            @php
                $activeTabClass = 'text-[#3a2a1a] border-b-2 border-red-600';
                $inactiveTabClass = 'text-[#3a2a1a]/70 border-b-2 border-transparent hover:text-[#3a2a1a]';
            @endphp

            <div class="bg-white/50 rounded-2xl px-4 pt-4">
                <div class="grid grid-cols-3 gap-2">
                    <a href="{{ route('pesanan.saya', ['tab' => 'belum-bayar']) }}" class="text-center pb-3 text-xs sm:text-sm font-bold {{ ($tab ?? 'belum-bayar') === 'belum-bayar' ? $activeTabClass : $inactiveTabClass }}">
                        Belum Bayar
                    </a>
                    <a href="{{ route('pesanan.saya', ['tab' => 'diproses']) }}" class="text-center pb-3 text-xs sm:text-sm font-bold {{ ($tab ?? '') === 'diproses' ? $activeTabClass : $inactiveTabClass }}">
                        Diproses
                    </a>
                    <a href="{{ route('pesanan.saya', ['tab' => 'beri-penilaian']) }}" class="text-center pb-3 text-xs sm:text-sm font-bold {{ ($tab ?? '') === 'beri-penilaian' ? $activeTabClass : $inactiveTabClass }}">
                        Beri Penilaian
                    </a>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                @forelse(($orders ?? collect()) as $order)
                    <div class="bg-[#F9EDDE] rounded-2xl shadow-md p-5 sm:p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-white shadow shrink-0">
                                <img src="https://placehold.co/200x200/f9edde/3a2a1a?text=Menu" alt="Menu" class="w-full h-full object-cover" />
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="text-sm sm:text-base font-bold uppercase truncate">{{ $order->order_id }}</div>
                                        <div class="text-xs text-[#3a2a1a]/70 mt-1">{{ optional($order->created_at)->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <div class="text-sm sm:text-base font-bold text-red-700">Rp {{ number_format((float) ($order->total_price ?? 0), 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    @php
                                         $status = (string) ($order->status ?? '');
                                         $statusLabel = 'Sedang Di Proses';
                                         if ($status === 'pending') $statusLabel = 'Belum Bayar';
                                         elseif ($status === 'paid') $statusLabel = 'Menunggu Konfirmasi';
                                         elseif ($status === 'confirmed') $statusLabel = 'Sedang Di Proses';
                                         elseif ($status === 'shipped') $statusLabel = 'Sedang Dikirim';
                                         elseif ($status === 'completed') $statusLabel = 'Selesai';
                                         elseif ($status === 'rejected') $statusLabel = 'Dibatalkan';
                                     @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/70">{{ $statusLabel }}</span>
                                </div>

                                <div class="mt-4 flex items-center justify-end gap-2">
                                    @if(($tab ?? 'belum-bayar') === 'belum-bayar')
                                        <a href="{{ route('transaksi.show', ['orderId' => $order->order_id]) }}" class="bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                            Bayar
                                        </a>
                                    @elseif(($tab ?? '') === 'beri-penilaian')
                                        <div class="mt-4 pt-4 border-t border-[#3a2a1a]/5 flex items-center justify-between gap-4">
                                            <div>
                                                <p class="text-[10px] font-bold text-[#3a2a1a]/50 uppercase tracking-widest mb-2">Ulasan Cepat</p>
                                                <div class="flex gap-1" id="stars-{{ $order->id }}">
                                                    @for($i=1; $i<=5; $i++)
                                                        <button type="button" class="text-xl text-stone-300 hover:text-amber-400 hover:scale-110 transition-all" onclick="window.location.href='{{ route('transaksi.show', ['orderId' => $order->order_id]) }}?action=review&rating={{ $i }}'">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    @endfor
                                                </div>
                                            </div>
                                            <a href="{{ route('transaksi.show', ['orderId' => $order->order_id]) }}?action=review" class="bg-[#8B0000] text-white text-[13px] font-bold px-6 py-3 rounded-2xl hover:bg-[#a52a2a] transition shadow-lg shadow-red-900/20 flex items-center gap-2">
                                                <i class="fas fa-pencil-alt text-xs"></i> Tulis Ulasan
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('transaksi.show', ['orderId' => $order->order_id]) }}" class="bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                            Detail
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-[#F9EDDE] rounded-2xl p-10 text-center shadow">
                        <div class="text-lg font-bold">Belum ada pesanan.</div>
                        <div class="text-sm text-[#3a2a1a]/70 mt-2">Silakan pesan menu terlebih dahulu.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>





