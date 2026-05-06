<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bakso Bunderan Ciomas</title>
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
                    colors: {
                        brand: { DEFAULT: '#8B0000', dark: '#6B0000', light: '#fef2f2' },
                        gold: '#DAA520',
                    },
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
        /* Custom styles that Tailwind CDN can't easily handle */
        .field-input:focus { outline: none !important; box-shadow: none !important; ring: 0; }
        input::-webkit-creden`  1tials-auto-fill-button,
        input::-webkit-contacts-auto-fill-button { visibility: hidden; display: none !important; pointer-events: none; }
        input::-ms-reveal, input::-ms-clear { display: none !important; }
        .field-input:not(:placeholder-shown) ~ .toggle-password { opacity: 1; pointer-events: auto; }
        .field-input:focus:not(:placeholder-shown) ~ .toggle-password { color: #8B0000; }
        .field-input:focus ~ .input-icon { color: #8B0000; }
        .btn-submit::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,.1),transparent); transition:left .5s ease; }
        .btn-submit:hover::before { left:100%; }

        @media (max-width: 480px) {
            body { padding: 12px; }
            .auth-card { padding: 24px 18px !important; border-radius: 20px !important; }
            .auth-logo { width: 100px !important; margin-bottom: 6px !important; }
            .auth-tagline { font-size: 11px !important; }
            .auth-tabs button { padding: 8px 0 !important; font-size: 12px !important; }
            .auth-subtitle { font-size: 12px !important; margin-bottom: 16px !important; }
            .auth-divider { margin-bottom: 16px !important; }
            .auth-field { margin-bottom: 16px !important; }
            .auth-label { font-size: 10px !important; }
            .field-input { padding-top: 8px !important; padding-bottom: 8px !important; font-size: 13px !important; }
            .field-input.with-icon { padding-left: 26px !important; }
            .input-icon { font-size: 13px !important; }
            .toggle-password { font-size: 13px !important; }
            .btn-submit { padding: 10px !important; font-size: 13px !important; border-radius: 12px !important; }
            .auth-switch { font-size: 12px !important; margin-top: 16px !important; }
            .auth-options { font-size: 12px !important; margin-bottom: 16px !important; }
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

            <!-- Tabs -->
            <div id="tabsContainer" class="auth-tabs flex bg-stone-100 rounded-2xl p-1 mb-6 relative">
                <button type="button" id="userTab" class="tab flex-1 py-2.5 text-[13px] font-semibold rounded-xl transition-all duration-300 z-10 text-brand bg-white shadow-sm" onclick="switchRole('user')">Pelanggan</button>
                <button type="button" id="adminTab" class="tab flex-1 py-2.5 text-[13px] font-semibold rounded-xl transition-all duration-300 z-10 text-stone-400" onclick="switchRole('admin')">Admin</button>
            </div>

            <!-- Title -->
            <p id="authSubtitle" class="auth-subtitle text-[13.5px] text-stone-500 text-center mb-6">Masuk untuk melanjutkan</p>

            <div class="auth-divider h-px bg-gradient-to-r from-transparent via-stone-200 to-transparent mb-6"></div>

            <!-- Alerts -->
            @if(session('error'))
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-red-50 to-red-100/20 text-brand border border-brand/10">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="auth-alert flex items-center gap-2.5 p-3 px-4 rounded-xl text-[13px] font-medium mb-5 animate-alertSlide bg-gradient-to-br from-green-50 to-green-100/20 text-green-800 border border-green-600/10">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- User Form -->
            <form id="userForm" action="{{ route('universal.login.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="user" id="roleInput">

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Email</label>
                    <div class="relative">
                        <input type="email" name="email" class="field-input w-full py-3 pl-8 pr-0 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400 max-sm:py-2.5 max-sm:text-[13.5px] max-sm:pl-7" required placeholder="nama@email.com" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')">
                        <i class="fas fa-envelope input-icon absolute left-1 top-1/2 -translate-y-1/2 text-stone-400 text-[15px] transition-colors duration-300 max-sm:left-0.5 max-sm:text-sm"></i>
                    </div>
                </div>

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Password</label>
                    <div class="relative">
                        <input id="userPassword" type="password" name="password" class="field-input w-full py-3 pr-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400 max-sm:py-2.5 max-sm:text-[13.5px]" autocomplete="new-password" required placeholder="Masukkan password">
                        <button type="button" class="toggle-password absolute right-1 top-1/2 -translate-y-1/2 bg-transparent border-none text-stone-400 cursor-pointer p-1 text-sm transition-all duration-300 opacity-0 pointer-events-none hover:text-stone-600" onclick="togglePassword('userPassword', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="auth-options flex items-center justify-between mb-6 text-[13px]">
                    <label class="flex items-center gap-2 cursor-pointer text-stone-600">
                        <input type="checkbox" name="remember" class="w-4 h-4 accent-brand cursor-pointer rounded">
                        <span class="font-medium">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-brand font-medium hover:text-brand-dark hover:underline underline-offset-2 transition-colors duration-200">Lupa password?</a>
                </div>

                <button type="submit" class="btn-submit w-full py-3.5 bg-brand text-white border-none rounded-xl text-sm font-semibold cursor-pointer transition-all duration-300 tracking-wide relative overflow-hidden hover:bg-brand-dark hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 max-sm:py-3 max-sm:text-[13.5px]">Masuk</button>

                <p class="text-center text-[13px] text-stone-500 mt-6 font-medium">Belum punya akun? <a href="{{ route('user.register') }}" class="text-brand font-semibold hover:text-brand-dark hover:underline underline-offset-2 transition-colors duration-200">Daftar sekarang</a></p>
            </form>

            <!-- Admin Form -->
            <form id="adminForm" class="hidden" action="{{ route('universal.login.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="admin" id="adminRoleInput">

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Username</label>
                    <div class="relative">
                        <input type="text" name="username" class="field-input w-full py-3 pl-8 pr-0 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400 max-sm:py-2.5 max-sm:text-[13.5px] max-sm:pl-7" autocomplete="off" required placeholder="Masukkan username">
                        <i class="fas fa-user input-icon absolute left-1 top-1/2 -translate-y-1/2 text-stone-400 text-[15px] transition-colors duration-300 max-sm:left-0.5 max-sm:text-sm"></i>
                    </div>
                </div>

                <div class="auth-field mb-6">
                    <label class="auth-label block text-xs font-semibold text-stone-700 mb-1 tracking-wide uppercase">Password</label>
                    <div class="relative">
                        <input id="adminPassword" type="password" name="password" class="field-input w-full py-3 pr-8 border-0 border-b-2 border-stone-200 bg-transparent text-sm font-normal text-stone-900 transition-all duration-300 focus:outline-none focus:border-b-brand focus:shadow-none placeholder:text-stone-400 max-sm:py-2.5 max-sm:text-[13.5px]" autocomplete="new-password" required placeholder="Masukkan password">
                        <button type="button" class="toggle-password absolute right-1 top-1/2 -translate-y-1/2 bg-transparent border-none text-stone-400 cursor-pointer p-1 text-sm transition-all duration-300 opacity-0 pointer-events-none hover:text-stone-600" onclick="togglePassword('adminPassword', this)">
                            <i class="far fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6 text-[13px]">
                    <label class="flex items-center gap-2 cursor-pointer text-stone-600">
                        <input type="checkbox" name="remember" class="w-4 h-4 accent-brand cursor-pointer rounded">
                        <span class="font-medium">Ingat saya</span>
                    </label>
                    <a href="{{ route('admin.password.request') }}" class="text-brand font-medium hover:text-brand-dark hover:underline underline-offset-2 transition-colors duration-200">Lupa password?</a>
                </div>

                <button type="submit" class="btn-submit w-full py-3.5 bg-brand text-white border-none rounded-xl text-sm font-semibold cursor-pointer transition-all duration-300 tracking-wide relative overflow-hidden hover:bg-brand-dark hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 max-sm:py-3 max-sm:text-[13.5px]">Masuk sebagai Admin</button>
            </form>

        </div>
    </div>

    <script>
        function switchRole(role) {
            const userTab = document.getElementById('userTab');
            const adminTab = document.getElementById('adminTab');
            const userForm = document.getElementById('userForm');
            const adminForm = document.getElementById('adminForm');
            const subtitle = document.getElementById('authSubtitle');

            if (role === 'user') {
                userTab.classList.add('text-brand', 'bg-white', 'shadow-sm');
                userTab.classList.remove('text-stone-400');
                adminTab.classList.remove('text-brand', 'bg-white', 'shadow-sm');
                adminTab.classList.add('text-stone-400');
                userForm.classList.remove('hidden');
                adminForm.classList.add('hidden');
                subtitle.textContent = 'Masuk untuk melanjutkan';
            } else {
                adminTab.classList.add('text-brand', 'bg-white', 'shadow-sm');
                adminTab.classList.remove('text-stone-400');
                userTab.classList.remove('text-brand', 'bg-white', 'shadow-sm');
                userTab.classList.add('text-stone-400');
                adminForm.classList.remove('hidden');
                userForm.classList.add('hidden');
                subtitle.textContent = 'Akses dashboard admin';
            }
        }

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'far fa-eye';
            } else {
                input.type = 'password';
                icon.className = 'far fa-eye-slash';
            }
        }
    </script>
</body>
</html>
