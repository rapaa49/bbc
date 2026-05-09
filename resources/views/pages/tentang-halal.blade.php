<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang BBC - Bakso Bunderan Ciomas</title>
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

        .halal-intro {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .js .halal-intro {
            opacity: 0;
            transform: translateY(80px) scale(0.965);
        }
        .halal-intro.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .halal-logo,
        .halal-desc {
            opacity: 0;
            transform: translateY(34px) scale(0.985);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }
        .halal-intro.visible .halal-logo,
        .halal-intro.visible .halal-desc {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .halal-intro.visible .halal-logo {
            transition-delay: 0.12s;
        }
        .halal-intro.visible .halal-desc {
            transition-delay: 0.34s;
        }

        .influencer-stat {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(180, 35, 24, 0.06);
            border-radius: 999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #5a1f18;
        }

        .about-panel {
            position: relative;
        }

        .about-image-shell,
        .about-copy {
            opacity: 0;
            will-change: transform, opacity;
            transition: opacity 0.95s cubic-bezier(0.16, 1, 0.3, 1), transform 0.95s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .about-image-shell {
            transform: translateX(-28px) scale(0.97);
        }

        .about-copy {
            transform: translateX(22px) translateY(10px);
        }

        .about-panel.reverse .about-image-shell {
            transform: translateX(28px) scale(0.97);
        }

        .about-panel.reverse .about-copy {
            transform: translateX(-22px) translateY(10px);
        }

        .fade-up.visible .about-image-shell,
        .fade-up.visible .about-copy {
            opacity: 1;
            transform: translateX(0) translateY(0) scale(1);
        }

        .fade-up.visible .about-copy {
            transition-delay: 0.14s;
        }

        .about-image-frame {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transform: translateZ(0);
            transform-origin: 50% 0%;
            will-change: transform;
            transition: transform 0.45s ease, box-shadow 0.45s ease;
        }

        .about-image-frame::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.16), rgba(0,0,0,0));
            pointer-events: none;
        }

        .about-image-frame:hover {
            animation: cardSwing 2.8s ease-in-out infinite;
            box-shadow: 0 24px 50px rgba(58, 42, 26, 0.16);
        }

        .about-image {
            transition: transform 0.35s ease;
        }

        .about-image-frame:hover .about-image {
            transform: scale(1.02);
        }

        @keyframes cardSwing {
            0% { transform: rotate(0deg) translateY(-2px); }
            20% { transform: rotate(-1.8deg) translateY(-1px); }
            50% { transform: rotate(1.8deg) translateY(0); }
            80% { transform: rotate(-1.2deg) translateY(-1px); }
            100% { transform: rotate(0deg) translateY(-2px); }
        }

        .about-copy p {
            transition: color 0.25s ease;
        }

        .about-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(239, 47, 36, 0.08);
            color: #8b0000;
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .about-title {
            font-family: 'Poppins', sans-serif !important;
            font-size: clamp(1.45rem, 2.2vw, 2.3rem);
            line-height: 1.15;
            letter-spacing: -0.03em;
        }

        .about-lead {
            color: #5c4637;
            font-size: 0.9rem;
            line-height: 1.72;
        }

        .about-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.6rem;
        }

        .about-metric {
            padding: 0.78rem 0.82rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 24px rgba(58, 42, 26, 0.07);
        }

        .about-metric-value {
            font-size: 1rem;
            font-weight: 800;
            color: #8b0000;
            line-height: 1.1;
        }

        .about-metric-label {
            margin-top: 0.25rem;
            color: #6a5244;
            font-size: 0.72rem;
            line-height: 1.35;
        }

        .about-points {
            display: grid;
            gap: 0.55rem;
        }

        .about-point {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.72rem 0.82rem;
            border-radius: 1rem;
            background: rgba(249, 237, 222, 0.7);
            border: 1px solid rgba(139, 0, 0, 0.06);
        }

        .about-point-icon {
            width: 1.8rem;
            height: 1.8rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 47, 36, 0.12);
            color: #ef2f24;
            flex: 0 0 auto;
            font-size: 0.78rem;
        }

        .about-point-title {
            font-size: 0.85rem;
            font-weight: 800;
            color: #3a2a1a;
            line-height: 1.2;
        }

        .about-point-text {
            margin-top: 0.2rem;
            color: #6a5244;
            font-size: 0.76rem;
            line-height: 1.45;
        }

        .about-quote {
            margin-top: 0.85rem;
            padding: 0.85rem 0.95rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(255, 250, 244, 0.95), rgba(247, 224, 209, 0.95));
            border: 1px solid rgba(139, 0, 0, 0.08);
            color: #5d4638;
            font-size: 0.82rem;
            line-height: 1.6;
        }

        .about-hero-note {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 12px 24px rgba(58, 42, 26, 0.08);
            backdrop-filter: blur(10px);
        }

        .about-hero-note strong {
            display: block;
            color: #8b0000;
            font-size: 0.82rem;
        }

        .about-hero-note span {
            display: block;
            color: #5d4638;
            font-size: 0.75rem;
            margin-top: 0.15rem;
        }

        @media (max-width: 767px) {
            .about-metrics {
                grid-template-columns: 1fr;
            }
        }



        .influencer-media::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 45%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0));
            pointer-events: none;
        }

        .influencer-play {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 46px;
            height: 46px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
            color: #b42318;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.18);
            transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }

        .influencer-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #b42318;
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            max-width: 82%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .influencer-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            background: #b42318;
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 0.58rem 1.1rem;
            border-radius: 999px;
            transition: transform 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 8px 16px rgba(180, 35, 24, 0.28);
        }

        .influencer-cta .external-icon {
            font-size: 0.68rem;
            opacity: 0.9;
            transform: translateY(0);
            transition: transform 0.25s ease, opacity 0.25s ease;
        }







        @media (prefers-reduced-motion: reduce) {
            .influencer-media,
            .influencer-media img,
            .influencer-play,
            .influencer-cta,
            .influencer-cta .external-icon {
                transition: none !important;
            }
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body class="js font-poppins bg-[#EFE1D1] text-[#3a2a1a] overflow-x-hidden">
    @include('partials.navbar')
    @include('partials.review-readmore')

    <section class="py-10 md:py-16 bg-[#EFE1D1]">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Section 1: Bakso Bunderan Ciomas -->
            <div class="fade-up mb-14 md:mb-20">
                <!-- Title & Text Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-8 items-start mb-10">
                    <div class="md:col-span-5 lg:col-span-4">
                        <div class="mb-4">
                            <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins"><i class="fas fa-store mr-1"></i> Tentang Kami</span>
                            <h3 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4 flex flex-wrap justify-center md:justify-start gap-x-4">
                                Bakso
                                Bunderan
                                Ciomas
                            </h3>
                        </div>
                    </div>
                    <div class="md:col-span-7 lg:col-span-8 flex flex-col justify-center">
                        <p class="text-[0.95rem] md:text-[1.05rem] text-[#5c4637] leading-relaxed text-justify md:text-left mb-6">
                            Berdiri sejak 12 Februari 2025, kami melayani pelanggan setia dengan sajian bakso tulang dan sumsum yang diracik dari bahan pilihan. Cita rasa dibuat konsisten, tampil lebih bersih, dan tetap mempertahankan karakter rumahan yang hangat.
                        </p>
                        <!-- Metrics Grid - Clean -->
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 border-t border-[#d8c3ae] pt-5">
                            <div>
                                <div class="text-xl md:text-2xl font-bold text-red-800 leading-none mb-1">2025</div>
                                <div class="text-xs md:text-sm text-[#6a5244] font-medium leading-relaxed">Berdiri melayani pelanggan.</div>
                            </div>
                            <div>
                                <div class="text-xl md:text-2xl font-bold text-red-800 leading-none mb-1">100%</div>
                                <div class="text-xs md:text-sm text-[#6a5244] font-medium leading-relaxed">Dimasak fresh dan bersih.</div>
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <div class="text-xl md:text-2xl font-bold text-red-800 leading-none mb-1">Rasa</div>
                                <div class="text-xs md:text-sm text-[#6a5244] font-medium leading-relaxed">Gurih & tekstur konsisten.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visuals & Points -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-5 relative w-full h-[280px] md:h-[340px]">
                        <img src="about.jpeg" alt="Bakso Bunderan Ciomas" class="w-full h-full object-cover rounded-2xl">
                    </div>
                    <div class="lg:col-span-7 flex flex-col gap-6 md:gap-8 justify-center">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 text-red-700 text-2xl mt-1"><i class="fas fa-bowl-food"></i></div>
                            <div>
                                <div class="font-bold text-[#3a2a1a] text-base md:text-lg">Menu Andalan Yang Jelas</div>
                                <div class="text-[#5c4637] text-[0.9rem] md:text-[0.95rem] mt-1.5 leading-relaxed">Bakso tulang, sumsum, dan varian favorit lain disiapkan untuk pengalaman makan yang lebih fokus dan mudah diingat.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 text-red-700 text-2xl mt-1"><i class="fas fa-shield-heart"></i></div>
                            <div>
                                <div class="font-bold text-[#3a2a1a] text-base md:text-lg">Proses Yang Terjaga</div>
                                <div class="text-[#5c4637] text-[0.9rem] md:text-[0.95rem] mt-1.5 leading-relaxed">Mulai dari pemilihan bahan, pengolahan, sampai penyajian, semuanya dibuat rapi agar kualitas tetap stabil.</div>
                            </div>
                        </div>
                        <div class="pl-5 border-l-2 border-red-700 text-[#5d4638] text-[0.9rem] md:text-[0.95rem] font-medium leading-relaxed italic mt-2">
                            "Kami ingin setiap porsi terasa familiar, hangat, dan layak direkomendasikan, baik untuk pelanggan baru maupun pelanggan yang sudah kembali berulang kali."
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-[#d8c3ae] border-t mb-14 md:mb-20">

            <!-- Section 2: Kenapa BBC -->
            <div class="fade-up">
                <!-- Title & Text Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-8 items-start mb-10">
                    <div class="md:col-span-5 lg:col-span-4 lg:order-2">
                        <div class="mb-4">
                            <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins"><i class="fas fa-award mr-1"></i> Kenapa BBC</span>
                            <h3 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4 flex flex-wrap justify-center md:justify-start gap-x-4">
                                Layak
                                Direkomendasikan
                            </h3>
                        </div>
                    </div>
                    <div class="md:col-span-7 lg:col-span-8 lg:order-1 flex flex-col justify-center">
                        <p class="text-[0.95rem] md:text-[1.05rem] text-[#5c4637] leading-relaxed text-justify md:text-left lg:pr-8">
                            Setiap porsi dibuat dengan dedikasi penuh menggunakan bahan berkualitas tinggi. Kami menjaga kebersihan, tekstur, dan rasa agar pengalaman makan tetap terasa premium tanpa kehilangan identitas bakso khas rumahan.
                        </p>
                    </div>
                </div>

                <!-- Visuals & Points -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 flex flex-col gap-6 md:gap-8 justify-center order-2 lg:order-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 text-red-700 text-xl md:text-2xl mt-1"><i class="fas fa-seedling"></i></div>
                                <div>
                                    <div class="font-bold text-[#3a2a1a] text-base md:text-lg mb-1.5">Bahan Pilihan</div>
                                    <div class="text-[#5c4637] text-[0.9rem] md:text-[0.95rem] leading-relaxed">Fokus pada bahan segar agar kuah & isian tetap kuat.</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 text-[#3a2a1a] text-xl md:text-2xl mt-1"><i class="fas fa-clipboard-check"></i></div>
                                <div>
                                    <div class="font-bold text-[#3a2a1a] text-base md:text-lg mb-1.5">Sajian Rapi</div>
                                    <div class="text-[#5c4637] text-[0.9rem] md:text-[0.95rem] leading-relaxed">Penyajian terstruktur, meyakinkan pelanggan di tempat.</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 mt-2 md:mt-0">
                            <div class="flex-shrink-0 text-red-700 text-xl md:text-2xl mt-1"><i class="fas fa-star"></i></div>
                            <div>
                                <div class="font-bold text-[#3a2a1a] text-base md:text-lg">Cita Rasa Konsisten</div>
                                <div class="text-[#5c4637] text-[0.9rem] md:text-[0.95rem] mt-1.5 leading-relaxed">Setiap mangkuk dijaga agar rasanya stabil dari hari ke hari, bukan hanya enak sesaat, tapi kualitas jangka panjang.</div>
                            </div>
                        </div>
                        <div class="pl-5 border-l-2 border-red-700 text-[#5d4638] text-[0.9rem] md:text-[0.95rem] font-medium leading-relaxed italic mt-2">
                            "Itulah mengapa BBC mulai dikenal luas, dari pelanggan terdekat hingga food vlogger terkemuka."
                        </div>
                    </div>
                    <div class="lg:col-span-5 relative w-full h-[280px] md:h-[340px] order-1 lg:order-2">
                        <img src="https://placehold.co/720x560/efe1d1/3a2a1a?text=About+Image" alt="Kenapa BBC" class="w-full h-full object-cover rounded-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-[#EFE1D1] overflow-hidden relative">
        <div class="hidden md:block absolute left-0 top-[22%] -translate-x-1/2 translate-y-6 select-none pointer-events-none" style="z-index: 1;">
            <img src="{{ asset('hiasan.png') }}" alt="Hiasan" class="w-56 lg:w-64 xl:w-72 h-auto opacity-80" loading="lazy" />
        </div>
        <div class="hidden md:block absolute right-0 top-[22%] translate-x-1/2 select-none pointer-events-none" style="z-index: 1;">
            <img src="{{ asset('hiasan.png') }}" alt="Hiasan" class="w-56 lg:w-64 xl:w-72 h-auto opacity-80" loading="lazy" />
        </div>

        <div class="max-w-5xl mx-auto px-6">
            <div class="relative bg-[#EFE1D1]">
                <div class="relative text-center halal-intro fade-up" style="z-index: 2;">
                    <div class="flex justify-center mb-4 halal-logo">
                        <img src="{{ asset('halal.jpeg') }}" onerror="this.onerror=null;this.src='https://placehold.co/160x80/efe1d1/3a2a1a?text=Halal';" alt="Halal" class="w-24 sm:w-28 h-auto" />
                    </div>
                    <p class="text-sm md:text-base text-gray-700 max-w-3xl mx-auto leading-relaxed halal-desc">
                        Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen boo
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 md:py-32 bg-[#EFE1D1]">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-center md:text-left text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Ulasan Video</h3>
            <h3 class="text-4xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-10 text-center md:text-left">
                Review Sosial Media
            </h3>

            <div class="mt-10">
                <div class="text-center mb-8">
                    <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Video Review</span>
                    <h3 class="text-3xl md:text-5xl font-bold text-[#26180f] tracking-tight font-bold mb-4">
                        Testimoni Influencer
                    </h3>
                    <div class="flex flex-wrap items-center justify-center gap-3 mt-4">
                        <span class="influencer-stat"><i class="fas fa-circle-check text-[#b42318]"></i>Konten Terverifikasi</span>
                        <span class="influencer-stat"><i class="fab fa-youtube text-[#b42318]"></i>Official Channel Highlights</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8">
                    @forelse(($influencerTestimonials ?? collect()) as $idx => $influencer)
                        <a href="{{ $influencer->youtube_url }}" target="_blank" rel="noopener" class="group block fade-up" style="transition-delay: {{ number_format($idx * 0.08, 2) }}s;">
                            <article class="relative bg-white rounded-[1.25rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-black/5 hover:border-red-900/20 hover:-translate-y-1.5 h-full flex flex-col isolation-isolate">
                                <div class="relative overflow-hidden aspect-video rounded-t-[1.25rem]">
                                    <img src="{{ $influencer->thumbnail_url }}" alt="Influencer" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 no-photo-hover" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 transition-opacity duration-300 group-hover:opacity-100"></div>
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-red-600/90 backdrop-blur-sm text-white text-[0.65rem] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full shadow-md">
                                            YouTube
                                        </span>
                                    </div>

                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-12 h-12 md:w-14 md:h-14 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white text-lg md:text-xl shadow-lg border border-white/30 transform transition-all duration-300 group-hover:scale-110 group-hover:bg-red-600 group-hover:border-red-600 group-hover:text-white">
                                            <i class="fas fa-play ml-1"></i>
                                        </div>
                                    </div>

                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <h5 class="text-white font-bold text-sm md:text-base leading-snug line-clamp-2 drop-shadow-md">
                                            {{ $influencer->title ?: 'Tonton keseruan review BBC di YouTube!' }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="p-4 flex items-center justify-between mt-auto bg-white">
                                    <div class="text-[#5c4637] text-xs font-semibold flex items-center gap-2">
                                        <i class="fab fa-youtube text-red-600 text-sm"></i>
                                        Tonton Video
                                    </div>
                                    <div class="text-red-600 transform transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @empty
                        <div class="col-span-full text-center text-sm text-[#5c4637] bg-white border border-black/5 shadow-sm rounded-[1.25rem] py-12">
                            <i class="fab fa-youtube text-4xl text-gray-300 mb-3 block"></i>
                            Video ulasan belum tersedia.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-14">
                <div class="text-center mb-12">
                    <span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block font-poppins">Ulasan Pelanggan</span>
                    <h3 class="text-3xl md:text-5xl font-bold text-[#26180f] tracking-tight mb-4 text-center">
                        Apa Kata Mereka?
                    </h3>
                </div>

                @include('partials.testimonial-carousel', ['testimonials' => $testimonials ?? collect()])
            </div>
        </div>
    </section>

    @include('partials.footer')
    <script>
        const revealEls = document.querySelectorAll('.fade-up, .fade-left, .fade-right');
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





