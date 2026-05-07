<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Ganti Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #8B0000;
            --cream: #ffffff;
            --text-main: #2D3748;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text-main);
            overflow-x: hidden;
        }
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            margin-left: 272px;
            padding: 30px;
            background: transparent;
            min-height: 100vh;
        }
        .page-header {
            margin-bottom: 32px;
        }
        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }
    </style>

    <style>
        .auth-tagline, .auth-subtitle, h5, h6 { font-family: "Poppins", sans-serif !important; }
        h1, h2, h3, h4 { font-family: "Inter", sans-serif !important; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'password', 'pendingCount' => $pendingCount ?? 0])

        <main class="main-content">
            <div class="page-header">
                <h1>Ganti Password</h1>
            </div>

            <div class="max-w-md mx-auto bg-white rounded-2xl shadow-sm p-8">
                <p class="text-sm text-gray-500 mb-6">Ubah password akun admin Anda.</p>

                @if(session('success'))
                    <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-3 text-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 text-red-700 border border-red-200 rounded-lg px-4 py-3 text-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.change-password.update') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#8B0000] focus:ring-1 focus:ring-[#8B0000] transition-all">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password" required minlength="6"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#8B0000] focus:ring-1 focus:ring-[#8B0000] transition-all">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required minlength="6"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#8B0000] focus:ring-1 focus:ring-[#8B0000] transition-all">
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-[#8B0000] hover:bg-[#6b0000] text-white font-semibold rounded-xl transition-all text-sm">
                        Simpan Password Baru
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>




