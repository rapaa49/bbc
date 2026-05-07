<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi & Kontak - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@700;800&family=Pinyon+Script&display=swap" rel="stylesheet">
    <style>
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body, h1, h2, h3, h4, h5, h6, p, span, a, li, ul, ol, button, input, textarea, div {
            font-family: 'Poppins', sans-serif !important;
        }
        . { font-family: 'Poppins', sans-serif !important; }

        .fade-up {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .js .fade-up {
            opacity: 0;
            transform: translateY(30px);
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #fff8ef 0%, #f7dfcf 100%);
            border: 1px solid rgba(139, 0, 0, 0.08);
        }

        .hero-panel::before,
        .hero-panel::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            filter: blur(2px);
            opacity: 0.85;
        }

        .hero-panel::before {
            width: 220px;
            height: 220px;
            top: -80px;
            right: -70px;
            background: radial-gradient(circle at 35% 35%, rgba(239, 47, 36, 0.18), rgba(239, 47, 36, 0));
        }

        .hero-panel::after {
            width: 160px;
            height: 160px;
            bottom: -60px;
            left: -40px;
            background: radial-gradient(circle at 35% 35%, rgba(139, 0, 0, 0.12), rgba(139, 0, 0, 0));
        }

        .info-card {
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 26px rgba(58, 32, 24, 0.08);
            backdrop-filter: blur(12px);
        }

        .info-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 999px;
            background: rgba(239, 47, 36, 0.12);
            color: #ef2f24;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }

        .section-title {
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #8b0000;
        }

        .map-frame {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            box-shadow: 0 18px 36px rgba(58, 32, 24, 0.16);
            border: 1px solid rgba(139, 0, 0, 0.08);
        }

        .map-frame::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(0,0,0,0));
            pointer-events: none;
        }

        .contact-form-card {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 16px 34px rgba(58, 32, 24, 0.12);
            backdrop-filter: blur(14px);
        }

        .contact-input {
            width: 100%;
            background: rgba(249, 237, 222, 0.82);
            border: 1px solid rgba(139, 0, 0, 0.12);
            border-radius: 0.95rem;
            padding: 0.9rem 1rem;
            outline: none;
            transition: box-shadow 0.25s ease, border-color 0.25s ease, transform 0.25s ease, background-color 0.25s ease;
        }

        .contact-input:focus {
            border-color: rgba(239, 47, 36, 0.55);
            box-shadow: 0 0 0 4px rgba(239, 47, 36, 0.1);
            background: rgba(255, 247, 242, 0.95);
        }

        .contact-btn {
            background: linear-gradient(135deg, #ef2f24 0%, #c81f17 100%);
            box-shadow: 0 12px 24px rgba(239, 47, 36, 0.24);
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
        }

        .contact-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(239, 47, 36, 0.3);
            filter: brightness(1.02);
        }

        .floating-badge {
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(139, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 24px rgba(58, 32, 24, 0.08);
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="js font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')

    <section class="py-14 md:py-20 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-5 sm:px-6">
            <div class="text-center mb-10 fade-up">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Kunjungi Kami</span>
                <h2 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4 text-center">
                    Lokasi &
                    Kontak
                </h2>
                <p class="text-gray-700 max-w-2xl mx-auto font-medium font-poppins">Kami siap melayani pesanan, pertanyaan, dan memberikan pengalaman kuliner terbaik untuk Anda.</p>
            </div>

            <!-- Bento Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 fade-up">
                
                <!-- Main Map Card -->
                <div class="lg:col-span-8 bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative group">
                    <div class="absolute top-6 left-6 z-10 bg-white/90 backdrop-blur-md rounded-2xl px-5 py-3 shadow-[0_8px_16px_rgba(0,0,0,0.06)] border border-white/20">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-50 text-red-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi Utama</div>
                                <div class="text-sm font-bold text-gray-800">Bakso Bunderan Ciomas</div>
                            </div>
                        </div>
                    </div>
                    <div class="h-[400px] lg:h-[500px] w-full">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.1234567890!2d106.7890123!3d-6.5678901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5f2e5f2e5f2%3A0x1234567890abcdef!2sBakso+Bunderan+Ciomas!5e0!3m2!1sen!2sid!4v1234567890"
                            class="w-full h-full border-0 transition-transform duration-700 group-hover:scale-[1.02]"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Quick Info Cards Stack -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <!-- Info Card 1 -->
                    <div class="bg-gradient-to-br from-red-700 to-red-900 rounded-[2rem] p-8 text-white shadow-[0_8px_20px_rgba(185,28,28,0.25)] relative overflow-hidden flex-1 group">
                        <div class="absolute -right-6 -top-6 text-red-500/20 group-hover:rotate-12 transition-transform duration-500">
                            <i class="fas fa-clock text-9xl"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white mb-6">
                                <i class="fas fa-store-alt text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 font-bold">
                                Jam Operasional
                            </h3>
                            <p class="text-red-100 font-medium mb-4">Nikmati porsi bakso hangat setiap hari tanpa libur.</p>
                            <div class="bg-black/20 rounded-xl p-4 backdrop-blur-sm border border-white/10">
                                <div class="flex justify-between items-center font-bold">
                                    <span>Senin - Minggu</span>
                                    <span>10:00 - 21:00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card 2 -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex-1">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-6">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 font-bold">
                            Hubungi Kami
                        </h3>
                        <p class="text-sm text-gray-500 mb-6">Butuh pesanan partai besar atau ada pertanyaan? Langsung chat admin kami.</p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex w-full items-center justify-center gap-2 bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700 transition">
                            <i class="fab fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 md:py-10 bg-[#EFE1D1]">
        <div class="max-w-4xl mx-auto px-5 sm:px-6">
            <div class="text-center mb-12">
                <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Kontak Kami</span>
                <h3 class="text-3xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4 text-center">
                    Kirim
                    Pesan
                    Langsung
                </h3>
            </div>

            @if(session('contact_success'))
            <div class="info-card border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_success') }}</span>
                </div>
            </div>
            @endif

            @if(session('contact_error'))
            <div class="info-card border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('contact_error') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="bg-white border text-left border-gray-100 shadow-sm rounded-[2rem] p-6 sm:p-8 md:p-10 fade-up hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full z-0 opacity-50"></div>
                
                @csrf
                <div class="grid md:grid-cols-2 gap-6 relative z-10">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold tracking-wide text-xs mb-1 uppercase">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-gray-800 outline-none focus:bg-white focus:border-red-400 focus:ring-4 focus:ring-red-50 transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold tracking-wide text-xs mb-1 uppercase">Alamat Email</label>
                        <input type="email" name="email" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-gray-800 outline-none focus:bg-white focus:border-red-400 focus:ring-4 focus:ring-red-50 transition-all">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-gray-700 font-bold tracking-wide text-xs mb-1 uppercase">Nomor WhatsApp</label>
                        <input type="tel" name="phone" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-gray-800 outline-none focus:bg-white focus:border-red-400 focus:ring-4 focus:ring-red-50 transition-all">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-gray-700 font-bold tracking-wide text-xs mb-1 uppercase">Tulis Pesan Anda</label>
                        <textarea name="message" rows="5" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 text-gray-800 outline-none focus:bg-white focus:border-red-400 focus:ring-4 focus:ring-red-50 transition-all resize-none"></textarea>
                    </div>

                    <div class="md:col-span-2 mt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-red-700 hover:bg-red-800 text-white px-8 py-3.5 rounded-xl font-bold shadow-[0_8px_20px_rgba(185,28,28,0.2)] hover:-translate-y-1 transition-all duration-300">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('partials.footer')
    <script>
        const revealEls = document.querySelectorAll('.fade-up');
        if (revealEls.length > 0) {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

                revealEls.forEach(el => observer.observe(el));
            } else {
                revealEls.forEach(el => el.classList.add('visible'));
            }
        }
    </script>
</body>
</html>





