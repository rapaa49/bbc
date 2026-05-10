<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B0000;
            --primary-soft: #a70f0f;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* ── Main ── */
        .main-content {
            flex: 1;
            margin-left: 272px;
            padding: 32px;
            min-height: 100vh;
        }

        /* ── Header ── */
        .page-header {
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.3px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 4px;
        }
        
        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* ── Buttons ── */
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-primary:hover { background: var(--primary-soft); }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover { background: #e2e8f0; }

        /* ── Card / Section ── */
        .card {
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--border-light);
            padding: 24px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 16px;
        }

        /* ── Alert ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
        }

        /* ── Filter Bar ── */
        .filter-bar {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-bar input,
        .filter-bar select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            background: var(--surface);
            color: var(--text);
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-bar input:focus,
        .filter-bar select:focus {
            border-color: var(--primary);
        }

        .filter-bar input { flex: 1; min-width: 220px; }
        .filter-bar select { min-width: 140px; }

        /* ── Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
            background: transparent;
        }

        .data-table td {
            padding: 14px;
            font-size: 13px;
            color: var(--text);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .menu-image {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border-light);
        }

        /* ── Status Badges ── */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-active { background: #dcfce7; color: #166534; }
        .badge-inactive { background: #fee2e2; color: #991b1b; }
        .badge-category { background: #f1f5f9; color: #475569; }

        .price {
            font-weight: 600;
            color: #059669;
        }

        /* ── Action Buttons ── */
        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-sm {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
        }
        .btn-edit:hover { background: #dbeafe; }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }
        .btn-delete:hover { background: #fee2e2; }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 32px;
            margin-bottom: 12px;
            color: #cbd5e1;
        }

        /* ── Pagination ── */
        .pagination { display: flex; list-style: none; padding: 0; margin: 16px 0 0; gap: 4px; flex-wrap: wrap; }
        .pagination li { display: inline-flex; }
        .pagination li a,
        .pagination li span {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: #8B0000; text-decoration: none; font-size: 12px; font-weight: 600;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center;
        }
        .pagination li.active span { background: #8B0000; color: #fff; border-color: #8B0000; }
        .pagination li a:hover { background: #fef2f2; color: #660000; border-color: #fca5a5; }
        .pagination li.disabled span { color: #cbd5e1; background: #f8fafc; cursor: not-allowed; }
        .pagination .page-item { display: inline-flex; }
        .pagination .page-link {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: #8B0000; text-decoration: none; font-size: 12px; font-weight: 600;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center; margin: 0 2px;
        }
        .pagination .page-link:hover { background: #fef2f2; color: #660000; border-color: #fca5a5; }
        .pagination .page-item.active .page-link { background: #8B0000; color: #fff; border-color: #8B0000; }
        .pagination .page-item.disabled .page-link { color: #cbd5e1; background: #f8fafc; cursor: not-allowed; border-color: var(--border); }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; justify-content: flex-start; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 80px 16px 16px; }
            .card { padding: 16px; }
            .menu-image { width: 44px; height: 44px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar input, .filter-bar select { min-width: 100%; width: 100%; }
            .filter-bar .btn { width: 100%; justify-content: center; }
            
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; flex-direction: column; align-items: flex-end; gap: 8px; padding-top: 12px; text-align: right; }
            .data-table td:last-child::before { text-align: right; width: 100%; }
            .data-table td:last-child .action-buttons { justify-content: flex-end; width: 100%; flex-wrap: wrap; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            .data-table td:nth-child(1)::before { content: "Gambar"; }
            .data-table td:nth-child(2)::before { content: "Nama Menu"; }
            .data-table td:nth-child(3)::before { content: "Deskripsi"; }
            .data-table td:nth-child(4)::before { content: "Kategori"; }
            .data-table td:nth-child(5)::before { content: "Harga"; }
            .data-table td:nth-child(6)::before { content: "Rekomendasi"; }
            .data-table td:nth-child(7)::before { content: "Status"; }
            .data-table td:nth-child(8)::before { content: "Aksi"; }
        }
        
        @media (max-width: 576px) {
            .data-table { font-size: 11px; }
            .data-table th, .data-table td { padding: 8px; }
            .action-buttons { flex-direction: row; flex-wrap: wrap; justify-content: flex-end; gap: 4px; }
            .btn-sm { width: 28px; height: 28px; font-size: 12px; }
            .badge { font-size: 10px; padding: 3px 6px; }
            .menu-image { width: 36px; height: 36px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'menu', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Menu Management</h1>
                    <p>Kelola menu produk BBC</p>
                </div>
                <div class="header-actions">
                    <a href="/admin/menu-management/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Menu
                    </a>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-title">Daftar Menu</div>
                
                <form method="GET" action="{{ route('admin.menu.index') }}" class="filter-bar">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / deskripsi...">
                    <select name="category">
                        <option value="">Semua Kategori</option>
                        <option value="bakso" {{ request('category') === 'bakso' ? 'selected' : '' }}>Bakso</option>
                        <option value="mie" {{ request('category') === 'mie' ? 'selected' : '' }}>Mie</option>
                        <option value="paket" {{ request('category') === 'paket' ? 'selected' : '' }}>Paket</option>
                        <option value="minuman" {{ request('category') === 'minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                    <select name="recommended">
                        <option value="">Semua Rekomendasi</option>
                        <option value="1" {{ request('recommended') === '1' ? 'selected' : '' }}>Rekomendasi</option>
                        <option value="0" {{ request('recommended') === '0' ? 'selected' : '' }}>Bukan Rekomendasi</option>
                    </select>
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                </form>

                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width: 70px;">Gambar</th>
                                <th>Nama Menu</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Rekomendasi</th>
                                <th>Status</th>
                                <th style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>
                                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="menu-image">
                                    </td>
                                    <td>
                                        <strong style="color: var(--text);">{{ $menu->name }}</strong>
                                    </td>
                                    <td style="color: var(--text-secondary);">
                                        {{ Str::limit($menu->description, 30) }}
                                    </td>
                                    <td>
                                        <span class="badge badge-category">{{ $menu->category }}</span>
                                    </td>
                                    <td>
                                        <span class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $menu->is_recommended ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $menu->is_recommended ? 'Ya' : 'Tidak' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $menu->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $menu->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/admin/menu-management/{{ $menu->id }}/edit" class="btn-sm btn-edit" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="POST" action="/admin/menu-management/{{ $menu->id }}" id="delete-menu-{{ $menu->id }}" style="display:inline;" onsubmit="confirmFormSubmit(event, 'delete-menu-{{ $menu->id }}', 'Hapus menu ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm btn-delete" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada menu yang ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $menus->links('pagination::bootstrap-4') }}
            </div>
        </main>
    </div>
</body>
</html>
