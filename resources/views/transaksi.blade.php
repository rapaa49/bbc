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
        :root {
            --brand-red: #8B0000;
            --brand-red-light: #A52A2A;
            --brand-cream: #EFE1D1;
            --brand-brown: #3A2A1A;
            --brand-brown-light: #644B3C;
        }

        body {
            background-color: var(--brand-cream);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238b0000' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .premium-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(58, 42, 26, 0.05), 0 8px 10px -6px rgba(58, 42, 26, 0.05);
        }

        .stepper-node {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            z-index: 10;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stepper-line {
            height: 3px;
            background: #E2D1C3;
            flex: 1;
            margin: 0 -2px;
            transition: background 0.4s ease;
        }

        .stepper-line.active {
            background: var(--brand-red);
        }

        .stepper-node.active {
            background: var(--brand-red);
            color: white;
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.15);
        }

        .stepper-node.inactive {
            background: #E2D1C3;
            color: #A89080;
        }

        .btn-premium {
            background: linear-gradient(to right, #8B0000 50%, #a50000 50%);
            background-size: 200% 100%;
            background-position: right bottom;
            color: white;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1.5rem;
            border-radius: 14px;
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            background-position: left bottom;

        }

        .btn-secondary {
            background: white;
            color: var(--brand-brown);
            border: 1.5px solid #E2D1C3;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 14px;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #F9F4EE;
            border-color: #D4C1B1;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .transaction-image {
            width: 100%;
            max-width: 480px;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="font-poppins">
    @include('partials.navbar')

    @php
        $items = is_array($pesanan->items ?? null) ? $pesanan->items : [];
        $subtotal = (float) ($pesanan->total_price ?? 0);
        $totalQty = 0;
        foreach ($items as $it) {
            $totalQty += (int) ($it['quantity'] ?? 0);
        }

        $status = (string) ($pesanan->status ?? 'pending');
        
        // Stepper logic
        $step1 = true; // Transaksi Dibuat
        $step2 = in_array($status, ['paid', 'confirmed', 'shipped', 'completed'], true); // Pembayaran
        $step3 = in_array($status, ['confirmed', 'shipped', 'completed'], true); // Diproses/Dikonfirmasi
        $step4 = $status === 'completed'; // Selesai

        $statusTitle = 'Menunggu Pembayaran';
        if ($status === 'paid') $statusTitle = 'Menunggu Konfirmasi';
        if ($status === 'confirmed') $statusTitle = 'Sedang Di Proses';
        if ($status === 'shipped') $statusTitle = 'Pesanan Sedang Dikirim';
        if ($status === 'completed') $statusTitle = 'Transaksi Selesai';
        if ($status === 'rejected') $statusTitle = 'Pesanan Ditolak';

        $statusDescription = 'Pesanan sudah diterima. Silakan selesaikan pembayaran untuk melanjutkan proses.';
        if ($status === 'paid') $statusDescription = 'Bukti pembayaran telah terkirim. Silakan tunggu konfirmasi dari admin.';
        if ($status === 'confirmed') $statusDescription = 'Pesanan Anda telah dikonfirmasi dan saat ini sedang diproses.';
        if ($status === 'shipped') $statusDescription = 'Pesanan Anda dalam proses pengiriman atau siap diambil.';
        if ($status === 'completed') $statusDescription = 'Hore! Transaksi telah selesai. Terima kasih atas pesanan Anda!';
        if ($status === 'rejected') $statusDescription = 'Mohon maaf, pesanan kamu ditolak oleh admin.';

        $special = [];
        if (!empty($pesanan->special_request)) {
            $decoded = is_array($pesanan->special_request) ? $pesanan->special_request : json_decode($pesanan->special_request, true);
            if (is_array($decoded)) $special = $decoded;
        }
    @endphp

    <main class="max-w-5xl mx-auto px-4 pt-12 pb-16">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6">
            <div>
                <nav class="flex items-center gap-2 mb-3 text-[10px] font-bold uppercase tracking-widest text-red-800/60">
                    <a href="{{ route('home') }}" class="hover:text-red-800 transition">Beranda</a>
                    <i class="fas fa-chevron-right text-[7px]"></i>
                    <a href="{{ route('my-orders') }}" class="hover:text-red-800 transition">Pesanan Saya</a>
                    <i class="fas fa-chevron-right text-[7px]"></i>
                    <span class="text-red-800">Detail Transaksi</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-extrabold text-brand-brown tracking-tight">
                    Detail <span class="text-red-800">Transaksi</span>
                </h1>
                <p class="text-xs text-brand-brown-light mt-1 font-medium italic">Order ID: {{ $pesanan->order_id }}</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('my-orders') }}" class="btn-secondary text-sm">
                    <i class="fas fa-list-ul mr-2"></i> Riwayat
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Status Card --}}
                <div class="premium-card p-6 md:p-10 flex flex-col items-center text-center">
                    @if($status === 'completed')
                        <div class="transaction-image-wrapper overflow-hidden rounded-[24px] mb-6 shadow-lg max-w-[400px]">
                            <img src="{{ asset('ulasan.jpg') }}" class="w-full h-[240px] object-cover object-top" />
                        </div>
                        <h2 class="text-xl font-extrabold text-brand-brown mb-2">Terima kasih sudah belanja!</h2>
                        <p class="text-sm text-brand-brown-light font-medium mb-8">Pesanan Anda telah selesai. Berikan ulasan terbaik Anda untuk membantu kami berkembang!</p>
                    @elseif($status === 'rejected')
                        <div class="transaction-image-wrapper overflow-hidden rounded-[24px] mb-6 shadow-lg max-w-[400px]">
                            <img src="{{ asset('konfirmasi.jpeg') }}" class="w-full h-full object-cover" />
                        </div>
                        <h2 class="text-xl font-extrabold text-red-800 mb-2">Pesanan Ditolak</h2>
                        <div class="bg-red-50 border border-red-100 p-5 rounded-[24px] max-w-sm mb-6 w-full">
                            <p class="text-[10px] font-black text-red-800 uppercase tracking-widest mb-2 opacity-60">Alasan Penolakan</p>
                            <p class="text-[13px] text-red-700 font-bold leading-relaxed italic">"{{ $pesanan->rejection_reason ?? 'Mohon maaf, pesanan Anda belum dapat kami proses saat ini.' }}"</p>
                        </div>
                    @elseif($status === 'pending' || $status === 'confirmed' || $status === 'paid')
                        <img src="{{ asset('transaksi.jpg') }}" class="transaction-image" />
                    @else
                        <img src="{{ asset('konfirmasi.jpeg') }}" class="transaction-image" />
                    @endif

                    @if($status !== 'pending' && $status !== 'completed' && $status !== 'rejected')
                        <h2 class="text-xl font-extrabold text-brand-brown mb-2">{{ $statusTitle }}</h2>
                    @endif
                    @if($status !== 'completed' && $status !== 'rejected')
                        <p class="text-sm text-brand-brown-light max-w-sm leading-relaxed">{{ $statusDescription }}</p>
                    @endif

                    {{-- Stepper UI --}}
                    @if($status !== 'rejected')
                    <div class="w-full mt-10 max-w-lg mx-auto">
                        <div class="flex items-center justify-between relative px-2">
                            <div class="stepper-node {{ $step1 ? 'active' : 'inactive' }}">1</div>
                            <div class="stepper-line {{ $step2 ? 'active' : '' }}"></div>
                            <div class="stepper-node {{ $step2 ? 'active' : 'inactive' }}">2</div>
                            <div class="stepper-line {{ $step3 ? 'active' : '' }}"></div>
                            <div class="stepper-node {{ $step3 ? 'active' : 'inactive' }}">3</div>
                            <div class="stepper-line {{ $step4 ? 'active' : '' }}"></div>
                            <div class="stepper-node {{ $step4 ? 'active' : 'inactive' }}">4</div>
                        </div>
                        <div class="flex justify-between mt-3 text-[9px] font-extrabold text-brand-brown-light uppercase tracking-tighter">
                            <span class="w-16 text-center">Dibuat</span>
                            <span class="w-16 text-center">Dibayar</span>
                            <span class="w-16 text-center">Diproses</span>
                            <span class="w-16 text-center">Selesai</span>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Order Items --}}
                <div class="premium-card p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-800">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3 class="text-lg font-extrabold text-brand-brown">Rincian Produk</h3>
                    </div>

                    <div class="space-y-4">
                        @foreach($items as $item)
                            @php $lineTotal = ((float)($item['price']??0)) * ((int)($item['quantity']??0)); @endphp
                            <div class="flex items-center justify-between py-4 border-b border-brand-brown/5 last:border-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-brand-cream/30 border border-[#E2D1C3] flex items-center justify-center shrink-0">
                                        <i class="fas fa-hamburger text-red-800/40 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-brand-brown leading-tight">{{ $item['name'] }}</p>
                                        <p class="text-xs text-brand-brown-light mt-1">{{ (int)($item['quantity']??0) }} x Rp {{ number_format((float)($item['price']??0), 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-red-800">Rp {{ number_format((float)$lineTotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Delivery Info --}}
                <div class="premium-card p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-800">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="text-lg font-extrabold text-brand-brown">Informasi Pengiriman</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <p class="text-[10px] font-bold text-brand-brown-light uppercase tracking-widest mb-1">Penerima</p>
                            <p class="font-bold text-brand-brown">{{ $pesanan->customer_name }}</p>
                            <p class="text-brand-brown-light">{{ $pesanan->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-brand-brown-light uppercase tracking-widest mb-1">Alamat Tujuan</p>
                            <p class="font-medium text-brand-brown leading-relaxed">{{ $special['delivery_address'] ?? 'Ambil di Tempat / Data tidak lengkap' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Payment Card --}}
                <div class="premium-card overflow-hidden">
                    <div class="bg-brand-brown p-5">
                        <h3 class="text-red-800 font-bold tracking-tight flex items-center gap-2">
                            <i class="fas fa-credit-card text-red-800"></i> Pembayaran
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-brand-brown-light font-medium">Metode</span>
                            <span class="font-bold text-brand-brown">QRIS / Transfer</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-brand-brown-light font-medium">Status</span>
                            @if($status === 'pending')
                                <span class="status-badge bg-amber-100 text-amber-700">Belum Bayar</span>
                            @elseif($status === 'paid')
                                <span class="status-badge bg-blue-100 text-blue-700">Menunggu Konfirmasi</span>
                            @elseif($status === 'confirmed')
                                <span class="status-badge bg-emerald-100 text-emerald-700">Telah Diterima</span>
                            @elseif($status === 'shipped')
                                <span class="status-badge bg-indigo-100 text-indigo-700">Sedang Dikirim</span>
                            @elseif($status === 'completed')
                                <span class="status-badge bg-emerald-100 text-emerald-700">Selesai</span>
                            @elseif($status === 'rejected')
                                <span class="status-badge bg-red-100 text-red-700 font-bold uppercase tracking-widest px-3 py-1 rounded-full text-[10px]">Ditolak</span>
                            @else
                                <span class="status-badge bg-gray-100 text-gray-700">{{ ucfirst($status) }}</span>
                            @endif
                        </div>
                        <div class="pt-4 border-t border-brand-brown/5 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-brand-brown">Total Tagihan</span>
                                <span class="text-xl font-black text-red-800">Rp {{ number_format((float)$subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($status === 'pending')
                            <div class="mt-6">
                                <button type="button" onclick="openQrisModal()" class="btn-premium w-full flex items-center justify-center gap-2">
                                    <i class="fas fa-qrcode"></i> Bayar Sekarang
                                </button>
                            </div>
                        @elseif($status === 'completed')
                            <div class="mt-6">
                                <button type="button" onclick="openReviewModal()" class="w-full py-4 rounded-2xl bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white text-sm font-extrabold transition-all duration-300 flex items-center justify-center gap-2 animate-pulse-subtle">
                                    <i class="fas fa-star"></i> Berikan Ulasan
                                </button>
                            </div>
                        @endif

                        @php
                            $waPhone = '6281947260782';
                            $waText = "Halo BBC, saya ingin konfirmasi pesanan #{$pesanan->order_id}.\nNama: {$pesanan->customer_name}\nTotal: Rp " . number_format($subtotal, 0, ',', '.');
                            $waUrl = 'https://wa.me/'.$waPhone.'?text='.rawurlencode($waText);
                        @endphp
                        <a href="{{ $waUrl }}" target="_blank" class="btn-secondary w-full flex items-center justify-center gap-2 text-sm mt-3">
                            <i class="fab fa-whatsapp text-emerald-600"></i> Hubungi Admin
                        </a>
                    </div>
                </div>

                {{-- Order Note --}}
                @if(!empty($special['notes']))
                <div class="premium-card p-6">
                    <p class="text-[10px] font-bold text-brand-brown-light uppercase tracking-widest mb-2">Catatan Pesanan</p>
                    <p class="text-sm text-brand-brown italic font-medium leading-relaxed">"{{ $special['notes'] }}"</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Modals --}}
        {{-- QRIS Modal --}}
        <div id="qrisModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-[100] px-4 backdrop-blur-sm">
            <div class="bg-white w-full max-w-sm rounded-[32px] shadow-2xl overflow-hidden animate-slide-up border border-white/20">
                <div class="px-8 py-6 flex flex-col items-center text-center bg-white border-b border-gray-50">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center text-red-700 mb-4 shadow-sm">
                        <i class="fas fa-qrcode text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-extrabold text-brand-brown tracking-tight">QRIS Pembayaran</h2>
                    <p class="text-[10px] font-bold text-brand-brown-light mt-1 uppercase tracking-widest">Scan & Selesaikan Pembayaran</p>
                    <button type="button" onclick="closeQrisModal()" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-all">&times;</button>
                </div>
                
                <div class="p-8 flex flex-col items-center">
                    <div class="mb-6 text-center">
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-1">Total Bayar</p>
                        <div class="text-2xl font-black text-red-800">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</div>
                    </div>
                    
                    <div class="relative p-5 bg-white border-2 border-dashed border-red-100 rounded-[24px] shadow-inner mb-6 group">
                        <img src="{{ asset('qriss.jpeg') }}" alt="QRIS" class="w-48 h-48 object-contain" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg'" />
                        <div class="absolute inset-0 bg-red-800/0 group-hover:bg-red-800/5 transition-all duration-300 rounded-[24px]"></div>
                    </div>
                    
                    <p class="text-[10px] text-center text-stone-400 px-4 leading-relaxed font-medium">Silakan scan QRIS di atas menggunakan m-Banking atau E-Wallet pilihan Anda.</p>
                </div>
                
                <div class="px-8 pb-8 flex gap-3">
                    <button type="button" onclick="closeQrisModal()" class="flex-1 py-4 rounded-2xl border-2 border-gray-100 text-stone-400 text-sm font-bold hover:bg-gray-50 transition-all">Nanti</button>
                    <button onclick="openUploadProofModal()" class="flex-[1.5] py-4 rounded-2xl bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white text-sm font-bold transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-upload text-xs"></i> Upload Bukti
                    </button>
                </div>
            </div>
        </div>

        {{-- Upload Proof Modal --}}
        <div id="uploadProofModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-[110] px-4 backdrop-blur-sm">
            <div class="bg-white w-full max-w-sm rounded-[32px] shadow-2xl overflow-hidden animate-slide-up border border-white/20">
                <div class="px-8 py-6 flex flex-col items-center text-center bg-white border-b border-gray-50">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center text-red-700 mb-4 shadow-sm">
                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-extrabold text-brand-brown tracking-tight">Kirim Bukti</h2>
                    <p class="text-[10px] font-bold text-brand-brown-light mt-1 uppercase tracking-widest">Konfirmasi Pembayaran Anda</p>
                    <button type="button" onclick="closeUploadProofModal()" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-all">&times;</button>
                </div>

                <form id="uploadProofForm" onsubmit="submitPaymentProof(event)" class="p-8 pt-6">
                    <div class="mb-6">
                        <label class="block text-[10px] font-bold text-brand-brown-light uppercase tracking-widest mb-3 px-1">Bukti Transfer (Screenshot)</label>
                        <div class="relative group">
                            <input type="file" id="paymentProof" name="payment_proof" accept="image/*" required class="hidden" onchange="previewSelectedImage(this)">
                            <label for="paymentProof" class="w-full h-44 border-2 border-dashed border-gray-100 rounded-3xl flex flex-col items-center justify-center cursor-pointer hover:bg-red-50/30 hover:border-red-200 transition-all duration-300 group" id="dropzone">
                                <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center text-stone-300 mb-3 group-hover:bg-white group-hover:text-red-700 transition-all shadow-sm">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                                <span class="text-[10px] font-bold text-stone-400 uppercase tracking-widest group-hover:text-red-800 transition-all" id="uploadLabel">Pilih File Gambar</span>
                            </label>
                            <img id="previewImage" src="" alt="Preview" class="w-full h-auto rounded-[24px] hidden shadow-lg border border-gray-100 animate-fade-in">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" onclick="closeUploadProofModal()" class="w-full py-4 rounded-2xl border-2 border-gray-100 text-stone-400 text-sm font-bold hover:bg-gray-50 transition-all">Batal</button>
                        <button type="submit" id="btnSubmitProof" class="w-full py-4 rounded-2xl bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white text-sm font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane text-xs"></i> Kirim Bukti
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Review Modal --}}
        @if($status === 'completed')
        <div id="reviewModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-[120] px-4 backdrop-blur-sm">
            <div class="bg-white w-full max-w-md rounded-[32px] shadow-2xl overflow-hidden animate-slide-up border border-white/20">
                <div class="px-8 py-6 flex flex-col items-center text-center bg-white border-b border-gray-50">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center text-red-700 mb-4 shadow-sm">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-extrabold text-brand-brown tracking-tight">Berikan Ulasan</h2>
                    <p class="text-xs font-medium text-brand-brown-light mt-1 uppercase tracking-widest">Bagaimana pengalaman Anda?</p>
                    <button type="button" onclick="closeReviewModal()" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-gray-100 transition-all">&times;</button>
                </div>

                <form onsubmit="submitReview(event)" class="p-8 pt-6">
                    <input type="hidden" id="revOrderId" value="{{ $pesanan->order_id }}">
                    <input type="hidden" id="revCustomerName" value="{{ $pesanan->customer_name }}">
                    
                    <div class="mb-8 text-center">
                        <div id="ratingStars" class="flex justify-center gap-3 text-4xl mb-2">
                            @for($i=1; $i<=5; $i++)
                                <button type="button" class="rating-star text-gray-100 hover:scale-125 hover:-rotate-12 active:scale-95 transition-all duration-300 transform" onclick="setRating({{ $i }})">
                                    <i class="fas fa-star"></i>
                                </button>
                            @endfor
                        </div>
                        <p id="ratingLabel" class="text-[10px] font-bold text-red-700 uppercase tracking-widest h-4">Sangat Puas</p>
                        <input type="hidden" id="revRating" value="5" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[10px] font-bold text-brand-brown-light uppercase tracking-widest mb-2 px-1">Ulasan Anda</label>
                        <textarea id="revContent" required rows="4" class="w-full bg-gray-50/80 border-2 border-gray-100 rounded-2xl p-4 text-sm font-medium text-brand-brown focus:outline-none focus:border-red-700 focus:bg-white transition-all duration-300 resize-none shadow-inner" placeholder="Ceritakan rasa masakan dan pelayanan kami..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" onclick="closeReviewModal()" class="w-full py-4 rounded-2xl border-2 border-gray-100 text-stone-400 text-sm font-bold hover:bg-gray-50 transition-all">Nanti</button>
                        <button type="submit" id="btnSubmitReview" class="w-full py-4 rounded-2xl bg-[linear-gradient(to_right,#8B0000_50%,#a50000_50%)] bg-[length:200%_100%] bg-right-bottom hover:bg-left-bottom text-white text-sm font-bold transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane text-xs"></i> Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <audio id="successSound" src="https://assets.mixkit.co/active_storage/sfx/2013/2013-preview.mp3" preload="auto"></audio>

        <script>
            // Modal Logic
            function openQrisModal() {
                const m = document.getElementById('qrisModal');
                m.classList.remove('hidden'); m.classList.add('flex');
            }
            function closeQrisModal() {
                const m = document.getElementById('qrisModal');
                m.classList.add('hidden'); m.classList.remove('flex');
            }
            function openUploadProofModal() {
                closeQrisModal();
                const m = document.getElementById('uploadProofModal');
                m.classList.remove('hidden'); m.classList.add('flex');
            }
            function closeUploadProofModal() {
                const m = document.getElementById('uploadProofModal');
                m.classList.add('hidden'); m.classList.remove('flex');
            }
            function openReviewModal() {
                const m = document.getElementById('reviewModal');
                if(m) { m.classList.remove('hidden'); m.classList.add('flex'); }
            }
            function closeReviewModal() {
                const m = document.getElementById('reviewModal');
                if(m) { m.classList.add('hidden'); m.classList.remove('flex'); }
            }

            // Image Preview
            function previewSelectedImage(input) {
                const preview = document.getElementById('previewImage');
                const dropzone = document.getElementById('dropzone');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        dropzone.classList.add('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Rating Logic
            function setRating(v) {
                document.getElementById('revRating').value = v;
                const stars = document.querySelectorAll('#ratingStars .rating-star');
                const label = document.getElementById('ratingLabel');
                const labels = ['', 'Kecewa', 'Kurang', 'Cukup Baik', 'Puas', 'Sangat Puas'];
                
                label.textContent = labels[v];
                
                stars.forEach((s, i) => {
                    const icon = s.querySelector('i');
                    if(i < v) {
                        s.classList.replace('text-gray-100', 'text-amber-400');
                        s.classList.add('scale-110');
                    } else {
                        s.classList.replace('text-amber-400', 'text-gray-100');
                        s.classList.remove('scale-110');
                    }
                });
            }

            // Submissions
            async function submitPaymentProof(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitProof');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

                const formData = new FormData();
                formData.append('payment_proof', document.getElementById('paymentProof').files[0]);

                try {
                    const res = await fetch('{{ route('transaksi.upload-proof', $pesanan->order_id) }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                        body: formData
                    });
                    const data = await res.json();
                    if(data.success) {
                        btn.innerHTML = '<i class="fas fa-check"></i> Berhasil!';
                        document.getElementById('successSound').play();
                        // Reload page to show updated status
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        alert(data.message || 'Gagal mengirim bukti.');
                        btn.disabled = false; btn.innerHTML = 'Kirim';
                    }
                } catch(err) {
                    alert('Terjadi kesalahan server.');
                    btn.disabled = false;
                }
            }

            async function submitReview(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitReview');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

                const body = {
                    order_id: document.getElementById('revOrderId').value,
                    customer_name: document.getElementById('revCustomerName').value,
                    rating: document.getElementById('revRating').value,
                    content: document.getElementById('revContent').value
                };

                try {
                    const res = await fetch('{{ route('testimonial.store') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                        body: JSON.stringify(body)
                    });
                    const data = await res.json();
                    if(data.success) {
                        btn.innerHTML = '<i class="fas fa-check"></i> Berhasil!';
                        setTimeout(() => { closeReviewModal(); alert('Terima kasih atas ulasan Anda!'); }, 1000);
                    } else {
                        alert('Gagal mengirim ulasan.');
                        btn.disabled = false;
                    }
                } catch(err) {
                    alert('Kesalahan server.');
                    btn.disabled = false;
                }
            }

            // Auto-popup removed as requested
            window.onload = function() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('action') === 'review') {
                    openReviewModal();
                    const rating = urlParams.get('rating');
                    if (rating) {
                        setRating(parseInt(rating));
                        // Focus textarea
                        setTimeout(() => {
                            const txt = document.getElementById('revContent');
                            if(txt) txt.focus();
                        }, 500);
                    }
                }
            };

           
        </script>
    </main>
</body>
</html>




