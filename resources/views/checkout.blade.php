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
        .checkout-shell {
            position: relative;
        }

        .checkout-shell::before,
        .checkout-shell::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            filter: blur(2px);
            opacity: 0.75;
        }

        .checkout-shell::before {
            width: 210px;
            height: 210px;
            top: -60px;
            left: -40px;
            background: radial-gradient(circle at 35% 35%, rgba(239, 47, 36, 0.2), rgba(239, 47, 36, 0));
        }

        .checkout-shell::after {
            width: 180px;
            height: 180px;
            right: -35px;
            bottom: -40px;
            background: radial-gradient(circle at 35% 35%, rgba(139, 0, 0, 0.15), rgba(139, 0, 0, 0));
        }

        .checkout-card {
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 16px 34px rgba(58, 32, 24, 0.1);
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: 999px;
            background: rgba(239, 47, 36, 0.1);
            color: #8b0000;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.35rem 0.7rem;
        }

        .field-label {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4a2d21;
            margin-bottom: 0.35rem;
            display: block;
        }

        .checkout-input {
            width: 100%;
            border-radius: 0.8rem;
            border: 1px solid rgba(139, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.88);
            padding: 0.72rem 0.9rem;
            font-size: 0.92rem;
            color: #3a2a1a;
            outline: none;
            transition: border-color 0.22s ease, box-shadow 0.22s ease, background-color 0.22s ease;
        }

        .checkout-input:focus {
            border-color: rgba(239, 47, 36, 0.55);
            box-shadow: 0 0 0 4px rgba(239, 47, 36, 0.1);
            background: #fff;
        }

        .order-summary-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(139, 0, 0, 0.1);
            box-shadow: 0 14px 26px rgba(58, 32, 24, 0.1);
        }

        .checkout-cta {
            background: linear-gradient(135deg, #ef2f24 0%, #c91f17 100%);
            box-shadow: 0 14px 24px rgba(239, 47, 36, 0.28);
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
        }

        .checkout-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(239, 47, 36, 0.34);
            filter: brightness(1.02);
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="bg-[#EFE1D1] text-[#2D3748] font-poppins">
    @include('partials.navbar')

    @php
        $items = $items ?? [];
        $subtotal = $subtotal ?? 0;
    @endphp

<main class="checkout-shell max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-12 mt-16 md:mt-20"> 
        <div class="mb-12 mt-4 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="text-left">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Penyelesaian</span>
                <h1 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4">
                    Penyelesaian Pesanan
                </h1>
                <p class="text-sm sm:text-base text-[#644b3c] mt-2 font-poppins font-medium">Lengkapi detail pemesanan agar proses konfirmasi lebih cepat.</p>      
            </div>
            <div class="flex items-center">
                <a href="{{ route('cart.index') }}" class="px-5 py-2.5 rounded-xl border border-[#3a2a1a] text-[#3a2a1a] font-bold hover:bg-[#3a2a1a] hover:text-[#EFE1D1] transition flex items-center gap-2 text-sm shadow-sm mt-3 md:mt-0">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Keranjang
                </a>
            </div>
        </div>

        <div class="checkout-card bg-[#F9EDDE] rounded-[1.8rem] p-4 sm:p-6 md:p-8 lg:p-10 relative z-10">
            <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8 items-start">
                @csrf

                <section class="lg:col-span-3">
                    <div class="section-tag mb-4">
                        <i class="fas fa-user-pen"></i>
                        Informasi Pemesan
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="field-label">Nama Lengkap</label>
                            <input name="customer_name" required placeholder="Masukkan Nama Lengkap" class="checkout-input" />
                        </div>
                        <div>
                            <label class="field-label">Nomor HP</label>
                            <input name="customer_phone" required inputmode="numeric" pattern="[0-9]*" placeholder="Contoh: 08xxxxxxxxxx" class="checkout-input" oninput="this.value=this.value.replace(/\D/g,'')" />
                        </div>
                        <div>
                            <label class="field-label">Nomor Rekening Pembeli</label>
                            <input name="buyer_bank_account" required inputmode="numeric" pattern="[0-9]*" placeholder="Contoh: 1234567890" class="checkout-input" oninput="this.value=this.value.replace(/\D/g,'')" />
                        </div>
                        <div>
                            <label class="field-label">Email</label>
                            <input name="customer_email" required type="email" placeholder="nama@email.com" class="checkout-input" />
                        </div>
                        <div>
                            <label class="field-label">Nama Acara</label>
                            <input name="event_name" required placeholder="Contoh: Arisan Keluarga" class="checkout-input" />
                        </div>
                        <div>
                            <label class="field-label">Tanggal Acara</label>
                            <input name="event_date" required type="date" class="checkout-input" />
                        </div>
                        <div>
                            <label class="field-label">Jam Pengiriman</label>
                            <input name="delivery_time" required type="time" class="checkout-input" />
                        </div>
                        <div class="sm:col-span-2">
                            <div class="flex items-center justify-between mb-0.35rem">
                                <label class="field-label mb-0">Alamat Lengkap Pengiriman</label>
                                <button type="button" onclick="getLocation()" class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200 transition font-bold" id="btn-location">
                                    <i class="fas fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini
                                </button>
                            </div>
                            <textarea id="delivery_address" name="delivery_address" required rows="3" placeholder="Isi alamat lengkap agar pesanan mudah ditemukan" class="checkout-input resize-none mt-1"></textarea>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                        </div>
                        <div>
                            <label class="field-label">Metode Pengiriman</label>
                            <select name="delivery_method" required class="checkout-input">
                                <option value="">Pilih Metode Pengiriman</option>
                                <option value="antar">Antar</option>
                                <option value="pickup">Ambil di Tempat</option>
                            </select>
                        </div>
                        <div>
                            <label class="field-label">Metode Pembayaran</label>
                            <select name="payment_method" required class="checkout-input">
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="field-label">Catatan Tambahan</label>
                            <textarea name="notes" rows="3" placeholder="Contoh: Tolong dikirim sebelum pukul 11.00" class="checkout-input resize-none"></textarea>
                        </div>
                    </div>
                </section>

                <section class="lg:col-span-2 lg:sticky lg:top-28">
                    <div class="section-tag mb-4">
                        <i class="fas fa-receipt"></i>
                        Ringkasan Pesanan
                    </div>

                    <div class="order-summary-card rounded-2xl overflow-hidden">
                        <div class="px-4 sm:px-5 py-3 border-b border-[#f0dfcb]">
                            <div class="grid grid-cols-3 text-[11px] sm:text-xs font-bold text-[#3a2a1a] uppercase tracking-wide">
                                <div class="col-span-2">Produk</div>
                                <div class="text-right">Subtotal</div>
                            </div>
                        </div>

                        <div class="divide-y divide-[#EFE1D1]">
                            @forelse($items as $item)
                                @php
                                    $lineTotal = ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
                                @endphp
                                <div class="px-4 sm:px-5 py-3.5">
                                    <div class="grid grid-cols-3 gap-3 items-start">
                                        <div class="col-span-2">
                                            <div class="text-sm font-bold text-[#3a2a1a] leading-tight">{{ $item['name'] }}</div>
                                            <div class="text-xs text-gray-600 mt-1">Jumlah: x{{ (int) ($item['quantity'] ?? 0) }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-bold text-red-700">Rp {{ number_format((float) $lineTotal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-6 text-center text-sm text-gray-600">
                                    Keranjang kosong.
                                </div>
                            @endforelse
                        </div>

                        <div class="px-4 sm:px-5 py-4 border-t border-[#EFE1D1] bg-[#fff9f2]">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-bold text-[#3a2a1a]">Subtotal</span>
                                <span class="font-bold text-[#3a2a1a]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-[#efd7c2]">
                                <span class="font-bold text-[#3a2a1a]">Total Pembayaran</span>
                                <span class="text-base font-bold text-[#b42318]">Rp {{ number_format((float) $subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-1 gap-3">
                        <button type="submit" class="checkout-cta text-white px-10 py-3 rounded-xl font-bold tracking-wide">Order Now</button>
                        <a href="{{ route('cart.index') }}" class="text-center text-sm font-semibold text-red-700 hover:underline">Kembali ke Keranjang</a>
                    </div>
                </section>
            </form>
        </div>
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

            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mencari...';
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
                            addressInput.value = `Latitude: ${lat}, Longitude: ${lng}`;
                        }
                    } catch (error) {
                        addressInput.value = `Latitude: ${lat}, Longitude: ${lng}`;
                    }

                    btn.innerHTML = '<i class="fas fa-check mr-1"></i> Lokasi Ditemukan';
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini';
                        btn.disabled = false;
                    }, 2000);
                },
                (error) => {
                    alert("Gagal mendapatkan lokasi. Pastikan izin lokasi diberikan.");
                    btn.innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Gunakan Lokasi Saat Ini';
                    btn.disabled = false;
                },
                { enableHighAccuracy: true }
            );
        }

        (function () {
            const form = document.querySelector('form[action="{{ route('checkout.store') }}"]');
            if (!form) return;

            const labels = {
                customer_name: 'Nama Lengkap',
                customer_phone: 'Nomor HP',
                buyer_bank_account: 'Nomor Rekening Pembeli',
                customer_email: 'Email',
                event_name: 'Nama Acara',
                event_date: 'Tanggal Acara',
                delivery_time: 'Jam Pengiriman',
                delivery_address: 'Alamat Lengkap Pengiriman',
                delivery_method: 'Metode Pengiriman',
                payment_method: 'Metode Pembayaran'
            };

            const requiredFieldNames = Object.keys(labels);

            form.addEventListener('submit', function (event) {
                for (const fieldName of requiredFieldNames) {
                    const field = form.elements[fieldName];
                    if (!field) continue;

                    const value = String(field.value || '').trim();
                    if (value === '') {
                        event.preventDefault();
                        alert(`Mohon Isi ${labels[fieldName]} Terlebih Dahulu.`);
                        field.focus();
                        return;
                    }
                }

                const emailField = form.elements['customer_email'];
                if (emailField && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(emailField.value || '').trim())) {
                    event.preventDefault();
                    alert('Format Email Belum Valid. Mohon Periksa Kembali.');
                    emailField.focus();
                    return;
                }

                const phoneField = form.elements['customer_phone'];
                if (phoneField && !/^\d+$/.test(String(phoneField.value || '').trim())) {
                    event.preventDefault();
                    alert('Nomor HP Hanya Boleh Diisi Angka.');
                    phoneField.focus();
                }
            });
        })();
    </script>
</body>
</html>




