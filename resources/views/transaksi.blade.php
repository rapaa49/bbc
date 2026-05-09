<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    </style>
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

    @php
        $items = is_array($pesanan->items ?? null) ? $pesanan->items : [];
        $subtotal = (float) ($pesanan->total_price ?? 0);

        $totalQty = 0;
        foreach ($items as $it) {
            $totalQty += (int) ($it['quantity'] ?? 0);
        }

        $status = (string) ($pesanan->status ?? 'pending');

        $stepPending = true;
        $stepConfirmed = in_array($status, ['pending', 'confirmed', 'shipped', 'completed'], true);
        $stepShipped = in_array($status, ['shipped', 'completed'], true);
        $stepCompleted = $status === 'completed';

        $statusTitle = 'Menunggu Pembayaran';
        if ($status === 'confirmed') $statusTitle = 'Pesanan Diproses';
        if ($status === 'shipped') $statusTitle = 'Pesanan Dikirim / Siap Diambil';
        if ($status === 'completed') $statusTitle = 'Transaksi Selesai';
        if ($status === 'rejected') $statusTitle = 'Pesanan Ditolak';

        $statusDescription = 'Pesanan sudah diterima. Silakan lakukan pembayaran via QRIS untuk melanjutkan proses pesanan.';
        if ($status === 'confirmed') {
            $statusDescription = 'Pembayaran Anda telah berhasil kami terima. Saat ini pesanan Anda sedang kami siapkan dan proses.';
        }
        if ($status === 'shipped') {
            $statusDescription = 'Pesanan Anda sedang dalam pengiriman ke alamat tujuan atau sudah dapat diambil di lokasi.';
        }
        if ($status === 'completed') {
            $statusDescription = 'Hore! Transaksi pesanan telah selesai. Terima kasih banyak telah mempercayai BBC untuk melengkapi acara Anda!';
        }
        if ($status === 'rejected') {
            $statusDescription = 'Mohon maaf, pesanan kamu ditolak oleh admin. Silakan hubungi admin/penjual untuk informasi lebih lanjut.';
        }

        $special = [];
        if (!empty($pesanan->special_request)) {
            if (is_array($pesanan->special_request)) {
                $special = $pesanan->special_request;
            } elseif (is_string($pesanan->special_request)) {
                $decoded = json_decode($pesanan->special_request, true);
                if (is_array($decoded)) $special = $decoded;
            }
        }
    @endphp

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10 mt-16 md:mt-20">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="text-left">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Status Pesanan</span>
                <h1 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4">
                    Detail Transaksi
                </h1>

            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}" class="px-5 py-2.5 rounded-xl border border-[#3a2a1a] text-[#3a2a1a] font-bold hover:bg-[#3a2a1a] hover:text-[#EFE1D1] transition flex items-center gap-2 text-sm shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                @auth
                <a href="{{ route('my-orders') }}" class="px-5 py-2.5 rounded-xl bg-red-700 text-white font-bold hover:bg-red-800 transition flex items-center gap-2 text-sm shadow-sm">
                    <i class="fa-solid fa-list-ul"></i> Lihat Pesanan
                </a>
                @endauth
            </div>
        </div>

        <section class="bg-[#F9EDDE] rounded-xl shadow overflow-hidden">
            <div class="px-6 py-7 {{ $status === 'confirmed' ? 'bg-[#58A9D6]' : 'bg-white' }}">
                <div class="flex flex-col items-center justify-center">
                    @if($status === 'completed')
                        <img src="/selesai.jpeg" class="w-full max-w-md h-auto" />
                    @elseif($status === 'confirmed' || $status === 'pending')
                        <img src="/pembayaran.jpeg" class="w-full max-w-md h-auto" />
                    @else
                        <img src="/konfirmasi.jpeg" class="w-full max-w-md h-auto" />
                    @endif
                    <div class="mt-4 text-sm font-bold {{ $status === 'confirmed' ? 'text-[#3a2a1a]' : 'text-[#3a2a1a]' }}">{{ strtoupper($statusTitle) }}</div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="text-xs font-bold text-[#3a2a1a] mb-3">PROGRES TRANSAKSI</div>

                <div class="relative">
                    <div class="absolute left-0 right-0 top-[10px] h-[2px] bg-black/20"></div>
                    <div class="grid grid-cols-4 gap-0 relative">
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepPending ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-bold text-[#3a2a1a]">TRANSAKSI DIBUAT</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepConfirmed ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-bold text-[#3a2a1a]">PEMBAYARAN</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepShipped ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-bold text-[#3a2a1a]">SEDANG DIPROSES</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-5 h-5 rounded-full {{ $stepCompleted ? 'bg-green-500' : 'bg-black' }}"></div>
                            <div class="mt-2 text-[10px] font-bold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                        </div>
                    </div>
                </div>

                @if($status === 'completed')
                    <div class="mt-8">
                        <div class="text-center">
                            <div class="text-xl font-bold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                        </div>

                        <div class="mt-5 bg-white rounded-xl shadow-sm p-6">
                            <div class="font-bold text-[#3a2a1a]">TRANSAKSI SELESAI</div>
                            <p class="mt-3 text-xs text-gray-700 leading-relaxed">Terima kasih sudah order di Bakso Bunderan Ciomas! Pesanan Anda sudah kami terima dan selesai. Yuk, bantu kami berkembang dengan memberikan rating & ulasan. Pendapat Anda sangat berarti buat kami!</p>
                        </div>

                        <div class="mt-6 bg-white rounded-xl shadow-sm p-6">
                            <div class="text-xs font-bold text-[#3a2a1a] mb-3">BERI RATING & REVIEW</div>

                            <form method="POST" action="{{ route('testimonial.store') }}" class="space-y-3">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $pesanan->order_id }}" />
                                <input type="hidden" name="customer_name" value="{{ $pesanan->customer_name }}" />

                                <input type="hidden" name="rating" id="ratingValue" value="" />

                                <div>
                                    <div id="ratingStars" class="flex items-center gap-1 text-2xl">
                                        <button type="button" class="rating-star leading-none text-gray-300" onclick="setRating(1)" aria-label="1 star">★</button>
                                        <button type="button" class="rating-star leading-none text-gray-300" onclick="setRating(2)" aria-label="2 stars">★</button>
                                        <button type="button" class="rating-star leading-none text-gray-300" onclick="setRating(3)" aria-label="3 stars">★</button>
                                        <button type="button" class="rating-star leading-none text-gray-300" onclick="setRating(4)" aria-label="4 stars">★</button>
                                        <button type="button" class="rating-star leading-none text-gray-300" onclick="setRating(5)" aria-label="5 stars">★</button>
                                    </div>
                                    <div class="text-[11px] text-gray-500 mt-1">Klik bintang untuk memberi rating</div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-[#3a2a1a] mb-1">Ulasan</label>
                                    <textarea name="content" rows="4" class="w-full bg-[#F9EDDE] px-4 py-2 rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-red-500 transition resize-none" placeholder="Deskripsikan pengalaman Anda"></textarea>
                                </div>

                                <button type="submit" class="inline-flex items-center justify-center bg-red-600 text-white w-full py-2.5 rounded-lg font-bold hover:bg-red-700 transition">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="mt-8">
                        <div class="text-xs font-bold text-[#3a2a1a] mb-3">RINCIAN PEMBAYARAN</div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-white rounded-xl shadow-sm p-5">
                                <div class="space-y-3 text-sm text-[#3a2a1a]">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">Jumlah</span>
                                        <span class="font-bold">{{ $totalQty }}x</span>
                                    </div>
                                    <div class="flex items-start justify-between gap-4">
                                        <span class="font-semibold">Harga</span>
                                        <div class="text-right font-bold">
                                            @foreach($items as $it)
                                                <div>Rp {{ number_format((float) ($it['price'] ?? 0), 0, ',', '.') }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-[#EFE1D1]">
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Subtotal</span>
                                            <span class="font-bold">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="font-semibold">Total Pembayaran</span>
                                            <span class="font-bold">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl shadow-sm p-5">
                                @if($status === 'pending' || $status === 'confirmed')
                                    <div class="space-y-3 text-sm text-[#3a2a1a]">
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Metode Pembayaran</span>
                                            <span class="font-bold">QRIS (ALL Payment)</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Status Pembayaran</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-pink-100 text-pink-700">Unpaid</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">Status Transaksi</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-yellow-100 text-yellow-800">{{ ucfirst($status) }}</span>
                                        </div>

                                        <div class="pt-2">
                                            <button type="button" onclick="openQrisModal()" class="inline-flex items-center justify-center bg-red-600 text-white w-full py-2.5 rounded-lg font-bold hover:bg-red-700 transition"><i class="fas fa-qrcode mr-2"></i> Bayar Sekarang dengan QRIS</button>
                                        </div>

                                        <div class="pt-2">
                                            <form method="POST" action="{{ route('transaksi.transfer.notify', ['orderId' => $pesanan->order_id]) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center justify-center bg-[#3a2a1a] text-[#EFE1D1] w-full py-2.5 rounded-lg font-bold hover:opacity-95 transition">
                                                    Saya sudah transfer
                                                </button>
                                            </form>
                                            <div class="mt-2 text-[11px] text-gray-600">Setelah transfer, klik tombol ini agar admin mendapat notifikasi WhatsApp otomatis.</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="font-bold text-[#3a2a1a]">{{ $statusTitle }}</div>
                                    <p class="mt-3 text-xs text-gray-700 leading-relaxed">{{ $statusDescription }}</p>

                                    <!-- Customer Details Info for Paid/Processed Orders -->
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <b class="text-sm text-gray-800">Detail Pembeli & Tujuan:</b>
                                        <div class="mt-2 space-y-1 text-xs text-gray-600">
                                            <div class="flex justify-between">
                                                <span>Nama:</span>
                                                <span class="font-semibold text-[#3a2a1a]">{{ $pesanan->customer_name }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Telepon:</span>
                                                <span class="font-semibold text-[#3a2a1a]">{{ $pesanan->customer_phone }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Alamat:</span>
                                                <span class="font-semibold text-[#3a2a1a] max-w-[65%] text-right">{{ $special['delivery_address'] ?? 'Tidak ada data/Diambil di tempat' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($status === 'completed')
                                        <div class="mt-5">
                                            <button type="button" onclick="openReviewModal()" class="inline-flex items-center justify-center bg-green-600 text-white w-full py-2.5 rounded-lg font-bold hover:bg-green-700 transition shadow-md">
                                                <i class="fas fa-star mr-2"></i> Berikan Ulasan
                                            </button>
                                        </div>
                                    @endif

                                    <div class="{{ $status === 'completed' ? 'mt-3' : 'mt-5' }}">
                                        @php
                                            $waPhone = '6281947260782';
                                            $waItems = collect($items ?? [])->map(function ($it) {
                                                $name = $it['name'] ?? '-';
                                                $qty = $it['qty'] ?? 1;
                                                $price = (float) ($it['price'] ?? 0);
                                                return $name.' x'.$qty.' (Rp '.number_format($price, 0, ',', '.').')';
                                            })->implode("\n");

                                            $waTextLines = [
                                                'Halo BBC Project, saya ingin konfirmasi pesanan.',
                                                '',
                                                'Order ID: '.($pesanan->order_id ?? '-'),
                                                'Nama: '.($pesanan->customer_name ?? '-'),
                                                '',
                                                'Pesanan:',
                                                ($waItems !== '' ? $waItems : '-'),
                                                '',
                                                'Total: Rp '.number_format((float) ($subtotal ?? 0), 0, ',', '.'),
                                            ];

                                            $waText = implode("\n", $waTextLines);
                                            $waUrl = 'https://wa.me/'.$waPhone.'?text='.rawurlencode($waText);
                                        @endphp
                                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-red-600 text-white w-full py-2.5 rounded-lg font-bold hover:bg-red-700 transition">Hubungi Penjual</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <div id="qrisModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100 bg-gradient-to-r from-red-600 to-red-800 text-white">
                    <div class="font-bold flex items-center"><i class="fas fa-qrcode mr-2"></i> QRIS Pembayaran</div>
                    <button type="button" onclick="closeQrisModal()" class="text-white/70 hover:text-white text-xl leading-none">&times;</button>
                </div>
                <div class="p-5 flex flex-col items-center">
                    <div class="text-2xl font-bold text-red-700 mb-4">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</div>
                    <img src="/qriss.jpeg" alt="QRIS" class="w-48 h-auto rounded-xl border mb-4" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg'" />
                    <div class="mt-2 text-xs text-center text-gray-600">Scan QRIS di atas untuk menyelesaikan pesanan Anda.</div>
                </div>
                <div class="px-5 pb-5 grid grid-cols-2 gap-3">
                    <button type="button" onclick="closeQrisModal()" class="w-full bg-[#F9EDDE] text-[#3a2a1a] py-2.5 rounded-lg border border-[#EFE1D1] font-bold hover:bg-gray-100 transition">Batal</button>
                    <button id="btnConfirmQris" onclick="openUploadProofModal()" class="w-full bg-green-600 text-white py-2.5 rounded-lg font-bold shadow-lg hover:bg-green-700 transition flex items-center justify-center"><i class="fas fa-check-circle mr-2"></i> Sudah Bayar</button>
                </div>
            </div>
        </div>

        <!-- Modal Upload Bukti Pembayaran -->
        <div id="uploadProofModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100 bg-gradient-to-r from-green-600 to-green-800 text-white">
                    <div class="font-bold flex items-center"><i class="fas fa-upload mr-2"></i> Upload Bukti Pembayaran</div>
                    <button type="button" onclick="closeUploadProofModal()" class="text-white/70 hover:text-white text-xl leading-none">&times;</button>
                </div>
                <form id="uploadProofForm" onsubmit="submitPaymentProof(event)" class="p-5 flex flex-col items-center">
                    <div class="mb-4 w-full">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Upload Screenshot Bukti Transfer</label>
                        <input type="file" id="paymentProof" name="payment_proof" accept="image/*" required class="w-full border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-green-600 bg-gray-50">
                        <div class="mt-2 text-xs text-gray-500">Format: JPG, PNG, JPEG (Max 5MB)</div>
                    </div>
                    <div id="previewContainer" class="mb-4 w-full hidden">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Preview:</label>
                        <img id="previewImage" src="" alt="Preview" class="w-full h-auto rounded-lg border">
                    </div>
                    <div class="w-full grid grid-cols-2 gap-3 mt-2">
                        <button type="button" onclick="closeUploadProofModal()" class="w-full bg-[#F9EDDE] text-[#3a2a1a] py-2.5 rounded-lg border border-[#EFE1D1] font-bold hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" id="btnSubmitProof" class="w-full bg-green-600 text-white py-2.5 rounded-lg font-bold shadow-md hover:bg-green-700 transition flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <audio id="successSound" src="data:audio/mp3;base64,//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq" preload="auto"></audio>
        <!-- Modals for completed order Review -->
        @if($status === 'completed')
        <div id="reviewModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-gray-100 bg-gradient-to-r from-green-600 to-green-800 text-white">
                    <div class="font-bold flex items-center"><i class="fas fa-star mr-2"></i> Berikan Ulasan Anda</div>
                    <button type="button" onclick="closeReviewModal()" class="text-white/70 hover:text-white text-xl leading-none">&times;</button>
                </div>
                <form onsubmit="submitReview(event)" class="p-5 flex flex-col items-center">
                    <input type="hidden" id="revOrderId" value="{{ $pesanan->order_id }}">
                    <input type="hidden" id="revCustomerName" value="{{ $pesanan->customer_name }}">
                    
                    <div class="mb-4 w-full">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Berapa bintang untuk pesanan ini?</label>
                        <select id="revRating" required class="w-full border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-green-600 bg-gray-50">
                            <option value="5" selected>⭐⭐⭐⭐⭐ - Sangat Baik</option>
                            <option value="4">⭐⭐⭐⭐ - Baik</option>
                            <option value="3">⭐⭐⭐ - Cukup</option>
                            <option value="2">⭐⭐ - Kurang</option>
                            <option value="1">⭐ - Buruk</option>
                        </select>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ulasan / Kritik & Saran</label>
                        <textarea id="revContent" required rows="3" class="w-full border-gray-300 rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-green-600 bg-gray-50 border whitespace-pre-wrap leading-relaxed" placeholder="Ceritakan pengalaman atau bagikan kesan Anda..."></textarea>
                    </div>

                    <div class="w-full grid grid-cols-2 gap-3 mt-2">
                        <button type="button" onclick="closeReviewModal()" class="w-full bg-[#F9EDDE] text-[#3a2a1a] py-2.5 rounded-lg border border-[#EFE1D1] font-bold hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" id="btnSubmitReview" class="w-full bg-green-600 text-white py-2.5 rounded-lg font-bold shadow-md hover:bg-green-700 transition flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <script>
            function openReviewModal() {
                const modal = document.getElementById('reviewModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            }

            function closeReviewModal() {
                const modal = document.getElementById('reviewModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }

            async function submitReview(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitReview');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

                const orderId = document.getElementById('revOrderId')?.value || '';
                const customerName = document.getElementById('revCustomerName')?.value || 'Guest';
                const rating = document.getElementById('revRating')?.value || 5;
                const content = document.getElementById('revContent')?.value || '';

                try {
                    const response = await fetch('{{ route('testimonial.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            customer_name: customerName,
                            rating: rating,
                            content: content
                        })
                    });

                    const data = await response.json();
                    if (data.success) {
                        btn.innerHTML = '<i class="fas fa-check mr-2"></i> Berhasil!';
                        btn.classList.replace('bg-green-600', 'bg-blue-600');
                        btn.classList.replace('hover:bg-green-700', 'hover:bg-blue-700');
                        setTimeout(() => {
                            closeReviewModal();
                            alert(data.message || 'Testimoni Anda berhasil dikirim, terima kasih!');
                        }, 1000);
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim';
                    }
                } catch(error) {
                    alert('Gagal mengirim: ' + error.message);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim';
                }
            }

            function openQrisModal() {
                const modal = document.getElementById('qrisModal');
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeQrisModal() {
                const modal = document.getElementById('qrisModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            function openUploadProofModal() {
                closeQrisModal();
                const modal = document.getElementById('uploadProofModal');
                if (!modal) return;
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                // Setup file input listener
                const fileInput = document.getElementById('paymentProof');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        const previewContainer = document.getElementById('previewContainer');
                        const previewImage = document.getElementById('previewImage');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                previewContainer.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    });
                }
            }

            function closeUploadProofModal() {
                const modal = document.getElementById('uploadProofModal');
                if (!modal) return;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.getElementById('uploadProofForm').reset();
                document.getElementById('previewContainer').classList.add('hidden');
            }

            async function submitPaymentProof(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitProof');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

                const formData = new FormData();
                const fileInput = document.getElementById('paymentProof');
                if (fileInput.files[0]) {
                    formData.append('payment_proof', fileInput.files[0]);
                }

                try {
                    const response = await fetch('{{ route('transaksi.upload-proof', $pesanan->order_id) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        btn.innerHTML = '<i class="fas fa-check mr-2"></i> Berhasil!';
                        btn.classList.replace('bg-green-600', 'bg-blue-600');
                        btn.classList.replace('hover:bg-green-700', 'hover:bg-blue-700');

                        try {
                            const audio = document.getElementById('successSound');
                            audio.src = 'https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3';
                            await audio.play();
                        } catch(e) {}

                        setTimeout(() => {
                            closeUploadProofModal();
                            alert('Bukti pembayaran berhasil dikirim. Admin akan memverifikasi pembayaran Anda.');
                            window.location.href = "{{ route('my-orders', ['tab' => 'diproses']) }}";
                        }, 1000);
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim';
                    }
                } catch (error) {
                    console.error(error);
                    alert('Gagal menghubungi server.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim';
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('qrisModal');
                if (modal) {
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) closeQrisModal();
                    });
                }

                const input = document.getElementById('ratingValue');
                if (input) {
                    const initialRating = parseInt(input.value || '0', 10);
                    if (!Number.isNaN(initialRating) && initialRating > 0) {
                        setRating(initialRating);
                    } else {
                        updateRatingStars(0);
                    }
                }
            });

            function updateRatingStars(value) {
                const stars = document.querySelectorAll('#ratingStars .rating-star');
                if (!stars.length) return;
                stars.forEach((star, index) => {
                    if (index < value) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-amber-500');
                        star.setAttribute('aria-pressed', 'true');
                    } else {
                        star.classList.remove('text-amber-500');
                        star.classList.add('text-gray-300');
                        star.setAttribute('aria-pressed', 'false');
                    }
                });
            }

            function setRating(value) {
                const input = document.getElementById('ratingValue');
                if (!input) return;
                input.value = String(value);
                updateRatingStars(value);
            }

            async function confirmPayment() {
                const btn = document.getElementById('btnConfirmQris');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';

                try {
                    const response = await fetch('{{ route('transaksi.pay', $pesanan->order_id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({})
                    });

                    const data = await response.json();
                    
                    if (data.success) {
                        btn.innerHTML = '<i class="fas fa-check mr-2"></i> Berhasil!';
                        btn.classList.replace('bg-green-600', 'bg-blue-600');
                        btn.classList.replace('hover:bg-green-700', 'hover:bg-blue-700');
                        
                        try {
                            const audio = document.getElementById('successSound');
                            audio.src = 'https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3';
                            await audio.play();
                        } catch(e) {}

                        setTimeout(() => {
                              alert('Pembayaran berhasil diproses. Notifikasi telah terkirim otomatis ke Admin.');
                            window.location.href = "{{ route('my-orders', ['tab' => 'diproses']) }}";
                        }, 1000);
                    } else {
                        alert('Terjadi kesalahan, silakan coba lagi.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Sudah Bayar';
                    }
                } catch (error) {
                    console.error(error);
                    alert('Gagal menghubungi server.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Sudah Bayar';
                }
            }
            @if($status === 'completed')
                // Tampilkan popup ulasan secara otomatis ketika status Selesai untuk pertama kalinya
                setTimeout(() => {
                    if (!localStorage.getItem('review_prompted_' + '{{ $pesanan->order_id }}')) {
                        openReviewModal();
                        localStorage.setItem('review_prompted_' + '{{ $pesanan->order_id }}', 'true');
                    }
                }, 1500);
            @endif
        </script>
    </main>
</body>
</html>




