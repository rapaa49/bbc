<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Paket</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B0000;
            --primary-soft: #a70f0f;
            --secondary: #DAA520;
            --cream: #ffffff;
            --surface: #fffaf4;
            --surface-2: #ffffff;
            --text-main: #2D3748;
            --text-soft: #6b7280;
            --line: #e2e8f0;
            --shadow-soft: 0 10px 24px rgba(139, 0, 0, 0.08);
            --shadow-card: 0 12px 30px rgba(45, 55, 72, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 272px;
            padding: 30px;
            background: transparent;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0;
        }

        .page-header p {
            color: var(--text-soft);
            font-size: 16px;
            margin-bottom: 0;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .logout-btn, .add-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .logout-btn {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .logout-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        .add-btn {
            background: linear-gradient(90deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.18);
        }

        .add-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        /* Table Section */
        .content-section {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
            margin-bottom: 24px;
        }

        .content-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .pakets-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pakets-table th {
            background-color: #fff3e4;
            padding: 14px;
            text-align: left;
            font-weight: 600;
            color: var(--text-main);
            border-bottom: 2px solid var(--line);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .pakets-table td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            font-size: 14px;
            vertical-align: middle;
            color: var(--text-main);
        }

        .pakets-table tr:hover {
            background-color: #fffaf2;
        }

        .pakets-table tr:last-child td {
            border-bottom: none;
        }

        .paket-image {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--line);
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-badge.active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-sm {
            padding: 5px 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-sm:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .price {
            font-weight: 600;
            color: #27ae60;
        }

        /* Pagination Styling - Compact */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 3px;
            flex-wrap: wrap;
        }
        .pagination li {
            display: inline-flex;
        }
        .pagination li a,
        .pagination li span {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            background: #fff;
            transition: all 0.15s ease;
            min-width: 32px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        .pagination li.active span {
            background: #2c3e50;
            color: #fff;
            border-color: #2c3e50;
        }
        .pagination li a:hover {
            background: #e9ecef;
            color: #2c3e50;
            border-color: #adb5bd;
        }
        .pagination li.disabled span {
            color: #adb5bd;
            background: #f8f9fa;
            cursor: not-allowed;
        }
        .pagination li:first-child a,
        .pagination li:first-child span,
        .pagination li:last-child a,
        .pagination li:last-child span {
            padding: 5px 8px;
        }
        /* Bootstrap 4 pagination compatibility */
        .pagination .page-item {
            display: inline-flex;
        }
        .pagination .page-link {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            background: #fff;
            transition: all 0.15s ease;
            min-width: 32px;
            text-align: center;
            justify-content: center;
            align-items: center;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background: #2c3e50;
            color: #fff;
            border-color: #2c3e50;
        }
        .pagination .page-item.disabled .page-link {

            .portion-badge {
                display: inline-block;
                background-color: #e3f2fd;
                color: #1976d2;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 12px;
                font-weight: 600;
            }
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'paket', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Manajemen Paket</h1>
                    <p>Kelola paket bundle produk BBC</p>
                </div>
                <div class="header-actions">
                    <a href="/paket/create" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Paket
                    </a>
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <section class="content-section">
                <h2>Daftar Paket</h2>
                <form method="GET" action="{{ route('paket.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 16px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / deskripsi..." style="flex:1; min-width: 220px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                    <select name="status" style="min-width: 180px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    <button type="submit" style="padding:10px 14px; border:none; border-radius:8px; background:#2c3e50; color:#fff; font-weight:700; cursor:pointer;">Terapkan</button>
                    <a href="{{ route('paket.index') }}" style="padding:10px 14px; border:1px solid #e9ecef; border-radius:8px; background:#fff; color:#334155; font-weight:700; text-decoration:none;">Reset</a>
                </form>
                <div class="table-container">
                    <table class="pakets-table">
                        <thead>
                            <tr>
                                <th style="width: 84px;">Gambar</th>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Porsi</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pakets as $paket)
                                <tr>
                                    <td>
                                        <img src="{{ $paket->image }}" alt="{{ $paket->name }}" class="paket-image">
                                    </td>
                                    <td>
                                        <strong>{{ $paket->name }}</strong>
                                    </td>
                                    <td>
                                        {{ Str::limit($paket->description, 30) }}
                                    </td>
                                    <td>
                                        <span class="portion-badge">{{ $paket->portion }} Orang</span>
                                    </td>
                                    <td>
                                        @if(!empty($paket->original_price))
                                            <div style="font-size: 12px; color: #6c757d; text-decoration: line-through; font-weight: 600;">Rp {{ number_format((float) $paket->original_price, 0, ',', '.') }}</div>
                                        @endif
                                        <span class="price">Rp {{ number_format((float) $paket->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $paket->status }}">
                                            {{ $paket->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/paket/{{ $paket->id }}/edit" class="btn-sm btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn-sm btn-delete" onclick="if(confirm('Hapus paket ini?')) window.location.href='/paket/{{ $paket->id }}/delete'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada paket</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 16px;">
                    {{ $pakets->links('pagination::bootstrap-4') }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
