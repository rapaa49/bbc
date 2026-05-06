<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { brand: { DEFAULT: '#8B0000', dark: '#6B0000', light: '#fef2f2' } },
                    keyframes: {
                        cardEntry: { from: { opacity: '0', transform: 'translateY(16px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                        alertSlide: { from: { opacity: '0', transform: 'translateY(-8px) scale(0.98)' }, to: { opacity: '1', transform: 'translateY(0) scale(1)' } },
                    },
                    animation: {
                        cardEntry: 'cardEntry 0.6s cubic-bezier(0.16,1,0.3,1) forwards',
                        alertSlide: 'alertSlide 0.4s cubic-bezier(0.16,1,0.3,1)',
                    },
                },
            },
        }
    </script>
    <style>
        .field-input:focus { outline: none !important; box-shadow: none !important; }
        input::-webkit-credentials-auto-fill-button,
        input::-webkit-contacts-auto-fill-button { visibility: hidden; display: none !important; pointer-events: none; }
        input::-ms-reveal, input::-ms-clear { display: none !important; }
        .field-input:focus ~ .input-icon { color: #8B0000; }
        .btn-submit::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,.1),transparent); transition:left .5s ease; }
        .btn-submit:hover::before { left:100%; }

        @media (max-width: 480px) {
            body { padding: 12px; }
            .auth-card { padding: 24px 18px !important; border-radius: 20px !important; }
            .auth-logo { width: 100px !important; margin-bottom: 6px !important; }
            .auth-tagline { font-size: 11px !important; }
            .auth-title { font-size: 20px !important; }
            .auth-subtitle { font-size: 12px !important; margin-bottom: 16px !important; }
            .auth-divider { margin-bottom: 16px !important; }
            .auth-field { margin-bottom: 16px !important; }
            .auth-label { font-size: 10px !important; }
            .field-input { padding-top: 8px !important; padding-bottom: 8px !important; font-size: 13px !important; }
            .input-icon { font-size: 13px !important; }
            .btn-submit { padding: 10px !important; font-size: 13px !important; border-radius: 12px !important; }
            .auth-back { font-size: 12px !important; margin-top: 16px !important; }
            .auth-alert { font-size: 12px !important; padding: 10px 12px !important; margin-bottom: 14px !important; }
        }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center bg-stone-50 p-5 overflow-x-hidden">
    <div class="w-full max-w-[440px] relative z-10">
        <div class="auth-card bg-white/[0.92] rounded-[28px] p-11 px-9 shadow-lg backdrop-blur-xl border border-white/70 animate-cardEntry opacity-0">

            <!-- Logo -->
            <div class="text-center mb-6">
                <div class="auth-logo w-[180px] mx-auto mb-3 hover:scale-[1.03] transition-transform duration-300">
                    <img src="{{ asset('logo.jpeg') }}" alt="BBC Logo" class="w-full h-auto object-contain">
                </div>
                <div class="auth-tagline text-[13px] font-medium text-stone-500 tracking-wide">Bakso Bunderan Ciomas</div>
            </div>

            <!-- Title -->
            <h1 class="auth-title text-[26px] font-bold text-stone-900 text-center mb-1.5 -tracking-wide">Lupa Password?</h1>
            <p class="auth-subtitle text-[13.5px] text-stone-500 text-center mb-6">Masukkan email untuk menerima kode OTP</p>

            <div class="auth-divider h-px bg-gradient-to-r from-transparent via-stone-200 to-transparent mb-6"></div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-green-50 to-green-100/20 text-green-800 border border-green-600/10" id="alertMsg">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-red-50 to-red-100/20 text-brand border border-brand/10" id="alertMsg">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-red-50 to-red-100/20 text-brand border border-brand/10" id="alertMsg">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="user">

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Email</label>
                    <div class="relative">
                        <input type="email" name="email" class="field-input w-full py-3 pl-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand placeholder:text-stone-400" required placeholder="nama@email.com" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')">
                        <i class="fas fa-envelope input-icon absolute left-1 top-1/2 -translate-y-1/2 text-stone-400 text-[15px] transition-colors duration-300"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit w-full py-3.5 bg-brand text-white border-none rounded-xl text-sm font-semibold cursor-pointer transition-all duration-300 tracking-wide relative overflow-hidden hover:bg-brand-dark hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0">Kirim Kode OTP</button>
            </form>

            <a href="{{ route('login') }}" class="auth-back flex items-center justify-center gap-2 mt-6 text-[13px] text-stone-500 no-underline font-medium hover:text-brand transition-colors duration-200">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Login
            </a>

        </div>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('alertMsg');
            if (alert) { alert.style.opacity = '0'; alert.style.transition = 'opacity 0.5s ease'; setTimeout(() => alert.remove(), 500); }
        }, 3000);
    </script>
</body>
</html>
