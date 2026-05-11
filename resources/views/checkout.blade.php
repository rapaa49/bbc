<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .checkout-container {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .premium-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(58, 42, 26, 0.05), 0 8px 10px -6px rgba(58, 42, 26, 0.05);
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--brand-brown-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }

        .modern-input {
            width: 100%;
            background: #fff;
            border: 1.5px solid #E2D1C3;
            border-radius: 14px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--brand-brown);
            transition: all 0.25s ease;
            outline: none;
        }

        .modern-input:focus {
            border-color: var(--brand-red);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .modern-input::placeholder {
            color: #A89080;
            opacity: 0.6;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(139, 0, 0, 0.1);
            color: var(--brand-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .section-title {
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--brand-brown);
            letter-spacing: -0.01em;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px dashed #E2D1C3;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .btn-order {
            background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%);
            color: white;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 20px -6px rgba(139, 0, 0, 0.4);
            border: none;
            width: 100%;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -8px rgba(139, 0, 0, 0.5);
            filter: brightness(1.1);
        }

        .btn-order:active {
            transform: translateY(0);
        }

        .location-btn {
            font-size: 0.7rem;
            background: rgba(139, 0, 0, 0.05);
            color: var(--brand-red);
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 700;
            border: 1.5px solid rgba(139, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .location-btn:hover {
            background: var(--brand-red);
            color: white;
            border-color: var(--brand-red);
        }

        /* Responsive spacing */
        @media (max-width: 640px) {
            .checkout-shell { padding-top: 1rem; }
            .premium-card { padding: 1.5rem !important; }
        }
    </style>
</head>
<body class="font-poppins">
    @include('partials.navbar')

    @php
        $items = $items ?? [];
        $subtotal = $subtotal ?? 0;
    @endphp

    <main class="checkout-container max-w-6xl mx-auto px-4 pt-12 pb-16">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <nav class="flex items-center gap-2 mb-3 text-[11px] font-bold uppercase tracking-widest text-red-800/60">
                    <a href="{{ route('home') }}" class="hover:text-red-800 transition">Beranda</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <a href="{{ route('cart.index') }}" class="hover:text-red-800 transition">Keranjang</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-red-800">Checkout</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-extrabold text-brand-brown tracking-tight leading-tight">
                    Selesaikan <span class="text-red-800">Pesanan</span>
                </h1>
                <p class="text-sm text-brand-brown-light mt-2 font-medium">Lengkapi informasi di bawah untuk memproses pesanan Anda.</p>
            </div>
            
            <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-[#E2D1C3] text-brand-brown font-bold text-sm hover:bg-[#F9F4EE] transition shadow-sm self-start md:self-center">
                <i class="fas fa-arrow-left text-xs opacity-60"></i> Kembali
            </a>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- Form Section --}}
                <div class="lg:col-span-8 space-y-6">
                    <div class="premium-card p-6 md:p-8">
                        <div class="section-header">
                            <div class="section-icon"><i class="fas fa-user-check"></i></div>
                            <h2 class="section-title">Detail Pemesan</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                            <div class="input-group">
                                <label class="input-label">Nama Lengkap</label>
                                <input name="customer_name" required placeholder="Nama Anda" class="modern-input" />
                            </div>
                            <div class="input-group">
                                <label class="input-label">Nomor HP / WhatsApp</label>
                                <input name="customer_phone" required inputmode="numeric" pattern="[0-9]*" placeholder="08xxxxxxxxxx" class="modern-input" oninput="this.value=this.value.replace(/\D/g,'')" />
                            </div>
                            <div class="input-group">
                                <label class="input-label">Rekening Pembeli (Opsional)</label>
                                <input name="buyer_bank_account" required inputmode="numeric" pattern="[0-9]*" placeholder="Untuk verifikasi transfer" class="modern-input" oninput="this.value=this.value.replace(/\D/g,'')" />
                            </div>
                            <div class="input-group">
                                <label class="input-label">Alamat Email</label>
                                <input name="customer_email" required type="email" placeholder="nama@email.com" class="modern-input" />
                            </div>
                        </div>

                        <div class="h-px bg-gradient-to-r from-transparent via-[#E2D1C3] to-transparent my-4"></div>

                        <div class="section-header mt-8">
                            <div class="section-icon"><i class="fas fa-calendar-day"></i></div>
                            <h2 class="section-title">Informasi Acara & Pengiriman</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                            <div class="input-group md:col-span-2">
                                <label class="input-label">Nama Acara</label>
                                <input name="event_name" required placeholder="Misal: Ulang Tahun, Rapat Kantor, dll" class="modern-input" />
                            </div>
                            <div class="input-group">
                                <label class="input-label">Tanggal Acara</label>
                                <input name="event_date" required type="date" class="modern-input" />
                            </div>

                            
                            <div class="input-group md:col-span-2">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="input-label !mb-0">Alamat Lengkap</label>
                                    <button type="button" onclick="getLocation()" id="btn-location" class="location-btn">
                                        <i class="fas fa-location-arrow mr-1"></i> Pakai Lokasi GPS
                                    </button>
                                </div>
                                <textarea id="delivery_address" name="delivery_address" required rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, patokan..." class="modern-input resize-none"></textarea>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                {{-- Hidden fields to maintain backend functionality as per user requirement --}}
                                <input type="hidden" name="delivery_time" value="ASAP">
                                <input type="hidden" name="delivery_method" value="antar">
                                <input type="hidden" name="payment_method" value="transfer">
                            </div>

                            <div class="input-group md:col-span-2">
                                <label class="input-label">Catatan Tambahan (Opsional)</label>
                                <textarea name="notes" rows="2" placeholder="Misal: Kurangi pedas, kirim sebelum jam 12, dll..." class="modern-input resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Summary Section --}}
                <div class="lg:col-span-4 lg:sticky lg:top-32 space-y-6">
                    <div class="premium-card overflow-hidden">
                        <div class="bg-brand-brown p-5">
                            <h3 class="text-red-800 font-bold tracking-tight flex items-center gap-2">
                                <i class="fas fa-shopping-basket text-red-800"></i> Ringkasan Pesanan
                            </h3>
                        </div>
                        
                        <div class="p-5">
                            <div class="max-h-[300px] overflow-y-auto pr-2 space-y-4 mb-6">
                                @forelse($items as $item)
                                    @php
                                        $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                                    @endphp
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-50 border border-[#E2D1C3] flex items-center justify-center shrink-0">
                                            <i class="fas fa-box text-xs text-[#A89080]"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-red-800 leading-tight truncate">{{ $item['name'] }}</p>
                                            <p class="text-[10px] text-red-700/70 mt-0.5">Qty: {{ (int) ($item['quantity'] ?? 0) }}</p>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <p class="text-xs font-bold text-red-800">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-10 text-center">
                                        <i class="fas fa-shopping-cart text-3xl text-gray-200 mb-3 block"></i>
                                        <p class="text-xs text-gray-400 font-medium">Belum ada item pilihan.</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="space-y-3 pt-4 border-t border-[#E2D1C3]">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-red-700/80 font-medium">Subtotal</span>
                                    <span class="text-red-800 font-bold">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-red-700/80 font-medium">Biaya Layanan</span>
                                    <span class="text-emerald-600 font-bold">Gratis</span>
                                </div>
                                <div class="flex justify-between items-center pt-3 mt-1 border-t border-brand-brown/5">
                                    <span class="text-base font-extrabold text-red-800">Total Tagihan</span>
                                    <span class="text-xl font-black text-red-800">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="mt-8 space-y-3">
                                <button type="submit" class="btn-order">
                                    Konfirmasi & Pesan <i class="fas fa-check-circle ml-2"></i>
                                </button>
                                <p class="text-[10px] text-center text-brand-brown-light px-4 leading-relaxed">
                                    Dengan menekan tombol di atas, Anda setuju dengan ketentuan pemesanan di Bakso Bunderan Ciomas.
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </main>

    <script>
        function getLocation() {
            const btn = document.getElementById('btn-location');
            const addressInput = document.getElementById('delivery_address');
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            if (!navigator.geolocation) {
                alert("Geolocation tidak didukung oleh browser Anda.");
                return;
            }

            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-1"></i> Mengakses GPS...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    latInput.value = lat;
                    lngInput.value = lng;

                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
                        const data = await response.json();
                        if (data && data.display_name) {
                            addressInput.value = data.display_name;
                        } else {
                            addressInput.value = `📍 (${lat}, ${lng})`;
                        }
                    } catch (error) {
                        addressInput.value = `📍 (${lat}, ${lng})`;
                    }

                    btn.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Lokasi Berhasil';
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-location-arrow mr-1"></i> Pakai Lokasi GPS';
                        btn.disabled = false;
                    }, 3000);
                },
                (error) => {
                    alert("Gagal mendapatkan lokasi. Pastikan izin lokasi diberikan.");
                    btn.innerHTML = '<i class="fas fa-location-arrow mr-1"></i> Pakai Lokasi GPS';
                    btn.disabled = false;
                },
                { enableHighAccuracy: true }
            );
        }

        (function () {
            const form = document.querySelector('form');
            if (!form) return;

            const labels = {
                customer_name: 'Nama Lengkap',
                customer_phone: 'Nomor HP',
                buyer_bank_account: 'Nomor Rekening Pembeli',
                customer_email: 'Email',
                event_name: 'Nama Acara',
                event_date: 'Tanggal Acara',
                delivery_address: 'Alamat Lengkap Pengiriman'
            };

            form.addEventListener('submit', function (event) {
                const formData = new FormData(form);
                for (let [key, value] of formData.entries()) {
                    if (labels[key] && String(value).trim() === '') {
                        event.preventDefault();
                        alert(`Mohon lengkapi ${labels[key]} terlebih dahulu.`);
                        form.elements[key]?.focus();
                        return;
                    }
                }

                const email = form.elements['customer_email'].value;
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    event.preventDefault();
                    alert('Format email tidak valid.');
                    form.elements['customer_email'].focus();
                    return;
                }

                // Show skeleton or loader if exists
                if (document.body.classList.contains('public-skeleton-loading')) {
                    // already loading
                } else {
                    document.body.classList.add('public-skeleton-loading');
                }
            });
        })();
    </script>
</body>
</html>




