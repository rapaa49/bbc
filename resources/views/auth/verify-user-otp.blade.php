<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Bakso Bunderan Ciomas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Outfit', 'sans-serif'], attractive: ['Pacifico', 'cursive'] },
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
        .field-input:not(:placeholder-shown) ~ .toggle-password { opacity: 1; pointer-events: auto; }
        .field-input:focus:not(:placeholder-shown) ~ .toggle-password { color: #8B0000; }
        .field-input:focus ~ .input-icon { color: #8B0000; }
        .btn-submit { 
            background: linear-gradient(to right, #700000 50%, #8B0000 50%) !important;
            background-size: 200% 100% !important;
            background-position: right bottom !important;
            transition: all 0.4s ease-out !important;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover { 
            background-position: left bottom !important;
            box-shadow: 0 10px 20px -5px rgba(139, 0, 0, 0.3);
        }
        .btn-submit:active { opacity: 0.9; }

        @media (max-width: 480px) {
            body { padding: 12px; }
            .auth-card { padding: 24px 18px !important; border-radius: 20px !important; }
            .auth-logo { width: 100px !important; margin-bottom: 6px !important; }
            .auth-tagline { font-size: 18px !important; }
            .auth-title { font-size: 20px !important; }
            .auth-subtitle { font-size: 12px !important; }
            .auth-email { font-size: 12px !important; margin-bottom: 16px !important; }
            .auth-divider { margin-bottom: 16px !important; }
            .auth-field { margin-bottom: 16px !important; }
            .auth-label { font-size: 10px !important; }
            .auth-steps { gap: 24px !important; margin-bottom: 16px !important; }
            .auth-step-num { width: 32px !important; height: 32px !important; font-size: 12px !important; }
            .auth-step-label { font-size: 10px !important; }
            .field-input { padding-top: 8px !important; padding-bottom: 8px !important; font-size: 13px !important; }
            .input-icon { font-size: 13px !important; }
            .toggle-password { font-size: 13px !important; }
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
                <div class="auth-logo w-[180px] mx-auto mb-3">
                    <img src="{{ asset('logo.jpeg') }}" alt="BBC Logo" class="w-full h-auto object-contain">
                </div>
                <div class="auth-tagline text-[22px] font-attractive font-normal text-brand tracking-wide">Bakso Bunderan Ciomas</div>
            </div>

            <!-- Steps -->
            <div class="auth-steps flex justify-center gap-8 mb-6 relative">
                <div class="absolute top-[18px] left-1/2 -translate-x-1/2 w-[60px] h-0.5 bg-stone-200 z-0"></div>
                <div class="flex flex-col items-center gap-1.5 relative z-10">
                    <div class="auth-step-num w-9 h-9 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center text-[13px] font-semibold border-[1.5px] border-stone-200">1</div>
                    <span class="auth-step-label text-[11px] text-stone-500 font-medium tracking-wide">Email</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 relative z-10">
                    <div class="auth-step-num w-9 h-9 rounded-full bg-brand text-white flex items-center justify-center text-[13px] font-semibold shadow-md shadow-brand/15">2</div>
                    <span class="auth-step-label text-[11px] text-stone-500 font-medium tracking-wide">Verifikasi</span>
                </div>
            </div>

            <!-- Title -->
            <p class="auth-subtitle text-[13.5px] text-stone-500 text-center mb-1.5">Masukkan kode OTP yang dikirim ke</p>
            <p class="auth-email text-[13px] text-stone-600 text-center mb-6 font-medium break-all">{{ session('user_reset_email') }}</p>

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
            <form action="{{ route('password.verify.post') }}" method="POST">
                @csrf

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Kode OTP</label>
                    <div class="relative">
                        <input type="text" name="otp" class="field-input otp-input w-full py-3 pl-8 border-0 border-b-2 border-stone-200 bg-transparent text-lg font-semibold text-stone-900 text-center tracking-[8px] transition-all duration-300 focus:outline-none focus:border-b-brand placeholder:text-stone-400" required placeholder="------" maxlength="6" autocomplete="off">
                        <i class="fas fa-key input-icon absolute left-1 top-1/2 -translate-y-1/2 text-stone-400 text-[15px] transition-colors duration-300"></i>
                    </div>
                </div>

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="field-input w-full py-3 pr-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand placeholder:text-stone-400" required minlength="6" placeholder="Minimal 6 karakter" autocomplete="new-password">
                        <button type="button" class="toggle-password absolute right-1 top-1/2 -translate-y-1/2 bg-transparent border-none text-stone-400 cursor-pointer p-1 text-sm transition-all duration-300 opacity-0 pointer-events-none hover:text-stone-600" onclick="togglePassword('password', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="field-input w-full py-3 pr-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand placeholder:text-stone-400" required placeholder="Ulangi password" autocomplete="new-password">
                        <button type="button" class="toggle-password absolute right-1 top-1/2 -translate-y-1/2 bg-transparent border-none text-stone-400 cursor-pointer p-1 text-sm transition-all duration-300 opacity-0 pointer-events-none hover:text-stone-600" onclick="togglePassword('password_confirmation', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit w-full py-3.5 bg-brand text-white border-none rounded-xl text-sm font-semibold cursor-pointer tracking-wide relative overflow-hidden">Simpan Password Baru</button>
            </form>

            <a href="{{ route('password.request') }}" class="auth-back flex items-center justify-center gap-2 mt-6 text-[13px] text-stone-500 no-underline font-medium hover:text-brand transition-colors duration-200">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('alertMsg');
            if (alert) { alert.style.opacity = '0'; alert.style.transition = 'opacity 0.5s ease'; setTimeout(() => alert.remove(), 500); }
        }, 3000);
        document.querySelector('.otp-input').addEventListener('input', function(e) { this.value = this.value.toUpperCase(); });
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const icon = button.querySelector('i');
            if (input.type === 'password') { input.type = 'text'; icon.className = 'far fa-eye'; }
            else { input.type = 'password'; icon.className = 'far fa-eye-slash'; }
        }
    </script>
</body>
</html>
