<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi & Kontak - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --brand-red: #8b0000;
            --brand-red-dark: #6b0000;
            --brand-cream: #EFE1D1;
            --brand-brown: #3a2a1a;
            --brand-brown-light: #6a4a34;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--brand-cream);
            color: var(--brand-brown);
        }

        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page-bg-image {
            position: relative;
            background-image: url('{{ asset('bg_body.png') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .page-bg-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(239, 225, 209, 0.6) 0%, rgba(239, 225, 209, 0.85) 100%);
            pointer-events: none;
        }

        .content-shell {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Form Controls */
        /* Contact Cards */
        .contact-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid transparent;
            padding: 1.5rem;
            transition: all 0.4s ease-out;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .contact-card:hover {
            background: rgba(139, 0, 0, 0.06);
            border-color: rgba(139, 0, 0, 0.15);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -8px rgba(139, 0, 0, 0.15);
        }

        .contact-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .contact-icon.whatsapp {
            background: rgba(37, 211, 102, 0.1);
            color: #25D366;
        }

        .contact-icon.instagram {
            background: rgba(228, 64, 95, 0.1);
            color: #E4405F;
        }

        .contact-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f3f3f3;
            color: #4a4a4a;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.4s ease-out;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .contact-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, #8B0000 0%, #a50000 100%);
            transform: translateX(-100%);
            opacity: 0;
            transition: transform 0.4s ease-out, opacity 0.4s ease-out;
            z-index: 0;
        }

        .contact-card:hover .contact-btn::before {
            transform: translateX(0);
            opacity: 1;
        }

        .contact-btn span,
        .contact-btn i {
            position: relative;
            z-index: 1;
            transition: color 0.4s ease-out;
        }

        .contact-card:hover .contact-btn span,
        .contact-card:hover .contact-btn i {
            color: white;
        }

        .contact-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(139, 0, 0, 0.1);
            border-radius: 1.25rem;
            padding: 1rem 1.25rem;
            outline: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .contact-input:focus {
            background: white;
            border-color: var(--brand-red);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .bento-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid rgba(139, 0, 0, 0.05);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.08);
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .bento-card:hover {
            box-shadow: 0 20px 40px -10px rgba(139, 0, 0, 0.12);
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    @include('partials.navbar')

    <main class="page-bg-image min-h-screen pt-12 pb-24 relative overflow-hidden">

        <div class="content-shell px-6">
            <!-- Header Section -->
            <header class="text-center mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 mb-4 px-[18px] py-2 rounded-full bg-[rgba(139,0,0,0.08)] border border-[rgba(139,0,0,0.15)] text-xs font-bold uppercase tracking-[0.5px] text-[#8B0000]">
                    <span class="w-2 h-2 rounded-full bg-[#8B0000]"></span>
                    Hubungi Kami
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-[#1a1a1a] tracking-tight mb-6 leading-tight">
                    Temukan <span class="text-red-700">Kehangatan</span> Kami
                </h1>
                <p class="text-base md:text-xl text-[#4a4a4a] max-w-2xl mx-auto font-medium leading-relaxed">
                    Kunjungi outlet kami atau kirimkan pesan untuk pertanyaan seputar menu, kerjasama, atau kritik dan saran.
                </p>
            </header>

            <!-- Bento Grid -->
            <!-- Enhanced Bento Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-16 fade-in-up" style="transition-delay: 0.1s">
                
                <!-- Map & Directions (Main Bento) -->
                <div class="lg:col-span-7 bento-card min-h-[500px] relative group">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.292158864704!2d106.7635293!3d-6.6105315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e40632a9a5%3A0xe543e1104e11246c!2sBakso%20Bunderan%20Ciomas!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                        class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-700"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                    
                    <!-- Floating Location Info -->
                    <div class="absolute bottom-6 left-6 right-6 p-6 bg-white/90 backdrop-blur-md rounded-lg border border-white shadow-2xl z-20">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-black text-[#1a1a1a] mb-1">Bunderan Ciomas</h3>
                                <p class="text-xs text-[#6a4a34] font-medium">Jl. Raya Ciomas No.1, Bogor, Jawa Barat</p>
                            </div>
                            <a href="https://goo.gl/maps/..." target="_blank" class="bg-[#8b0000] text-white px-6 py-3 rounded-md font-bold text-xs flex items-center gap-2 hover:bg-[#6b0000] transition-colors">
                                <i class="fas fa-diamond-turn-right"></i>
                                Petunjuk Jalan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Time & Social -->
                <div class="lg:col-span-5 grid grid-cols-1 gap-6">
                    
                    <!-- Hours Card -->
                    <div class="bento-card p-8 bg-gradient-to-br from-[#8b0000] to-[#6b0000] text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-md flex items-center justify-center">
                                    <i class="fas fa-door-open text-sm"></i>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-red-200">Operasional</span>
                            </div>
                            <h3 class="text-2xl font-black mb-6">Waktu Pelayanan</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-4 border-b border-white/10">
                                    <span class="text-red-100 font-medium">Senin - Minggu</span>
                                    <span class="font-bold text-white">10:00 - 21:00</span>
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-red-200 font-bold uppercase tracking-wide">
                                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                    Buka Hari Libur
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Small Bento: Quick Connect -->
                    <div class="grid grid-cols-2 gap-6">
                        <a href="https://wa.me/..." target="_blank" class="contact-card group flex flex-col h-full">
                            <div class="contact-icon whatsapp">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-[#8B0000] transition-colors">WhatsApp</h4>
                            <p class="text-sm text-gray-500 mb-4">Chat langsung dengan admin kami</p>
                            <div class="contact-btn mt-auto">
                                <span>Chat Now</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </div>
                        </a>
                        <a href="https://instagram.com/..." target="_blank" class="contact-card group flex flex-col h-full">
                            <div class="contact-icon instagram">
                                <i class="fab fa-instagram text-xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-[#E4405F] transition-colors">Instagram</h4>
                            <p class="text-sm text-gray-500 mb-4">@bunderanciomas</p>
                            <div class="contact-btn mt-auto">
                                <span>Follow</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </div>
                        </a>
                    </div>

                    </div>
                </div>
            </div>

            <!-- Contact Form Section -->
            <section class="max-w-4xl mx-auto fade-in-up" style="transition-delay: 0.2s">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4">Kotak Pesan</h2>
                    <p class="text-gray-500 font-medium">Kirimkan kritik, saran, atau pertanyaan Anda melalui formulir di bawah ini.</p>
                </div>

                <div class="bento-card p-8 md:p-12">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Nama Lengkap</label>
                                <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="contact-input">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Email Aktif</label>
                                <input type="email" name="email" required placeholder="budi@email.com" class="contact-input">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Nomor WhatsApp</label>
                                <input type="tel" name="phone" required placeholder="0812xxxx" class="contact-input">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2">Isi Pesan</label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..." class="contact-input resize-none"></textarea>
                            </div>
                            <div class="md:col-span-2 pt-4">
                                <button type="submit" class="w-full bg-red-700 text-white py-4 rounded-2xl font-black text-lg hover:bg-red-800 transition-all shadow-xl shadow-red-100 flex items-center justify-center gap-3">
                                    <i class="fas fa-paper-plane text-sm"></i>
                                    Kirim Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>

    @include('partials.footer')

    <script>
        // Intersection Observer for scroll animations
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    </script>
</body>
</html>
