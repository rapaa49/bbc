<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Kelola Admin</title>
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
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-soft); }
        .btn-secondary { background: #f1f5f9; color: #475569; }
        .btn-secondary:hover { background: #e2e8f0; }
        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #fecaca; }

        /* ── Card ── */
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

        /* ── Filter Bar ── */
        .filter-bar {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 16px;
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
        .filter-bar select:focus { border-color: var(--primary); }
        
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

        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr:last-child td { border-bottom: none; }

        .admin-name { font-weight: 600; color: var(--text); }

        /* ── Badges ── */
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
        
        .badge-owner { background: #fef9c3; color: #854d0e; }
        .badge-admin { background: #e0f2fe; color: #0369a1; }

        /* ── Action Buttons ── */
        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
            text-decoration: none;
            background: #fff;
            border: 1px solid var(--border);
            color: var(--text);
        }

        .btn-sm:hover { background: #f8fafc; }
        .btn-sm.edit { color: #0284c7; }
        .btn-sm.delete { color: #dc2626; }

        /* ── Alert ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── Pagination ── */
        .pagination { display: flex; list-style: none; padding: 0; margin: 16px 0 0; gap: 4px; flex-wrap: wrap; }
        .pagination li { display: inline-flex; }
        .pagination li a,
        .pagination li span {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: var(--text-secondary); text-decoration: none; font-size: 12px; font-weight: 500;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center;
        }
        .pagination li.active span { background: var(--primary); color: #fff; border-color: var(--primary); }
        .pagination li a:hover { background: #f1f5f9; color: var(--text); }
        .pagination li.disabled span { color: #cbd5e1; background: #f8fafc; cursor: not-allowed; }
        .pagination .page-item { display: inline-flex; }
        .pagination .page-link {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: var(--text-secondary); text-decoration: none; font-size: 12px; font-weight: 500;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center; margin: 0 2px;
        }
        .pagination .page-item.active .page-link { background: var(--primary); color: #fff; border-color: var(--primary); }
        .pagination .page-item.disabled .page-link { color: #cbd5e1; background: #f8fafc; cursor: not-allowed; }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; justify-content: flex-start; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 80px 16px 16px; }
            .card { padding: 16px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar input, .filter-bar select, .filter-bar button, .filter-bar a { width: 100%; }
            
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; justify-content: flex-end; padding-top: 12px; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            .data-table td:nth-child(1)::before { content: "#"; }
            .data-table td:nth-child(2)::before { content: "Nama"; }
            .data-table td:nth-child(3)::before { content: "Username"; }
            .data-table td:nth-child(4)::before { content: "Email"; }
            .data-table td:nth-child(5)::before { content: "Role"; }
            .data-table td:nth-child(6)::before { content: "Status"; }
            .data-table td:nth-child(7)::before { content: "Tanggal Dibuat"; }
            .data-table td:nth-child(8)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'admin', 'pendingCount' => $pendingCount ?? 0])

    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Kelola Admin</h1>
                <p>Manajemen akun admin dan akses sistem.</p>
            </div>
            <div class="header-actions">
                <a href="/kelola-admin/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Admin
                </a>
            </div>
        </header>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <section class="card">
            <div class="card-title">Daftar Admin</div>
            
            <form method="GET" action="{{ route('admin.management.index') }}" class="filter-bar">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / username / email...">
                <select name="role">
                    <option value="">Semua Role</option>
                    <option value="owner" {{ request('role') === 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                <a href="{{ route('admin.management.index') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
            </form>

            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $key => $admin)
                            <tr>
                                <td>{{ ($admins->firstItem() ?? 0) + $key }}</td>
                                <td><span class="admin-name">{{ $admin->name }}</span></td>
                                <td>{{ $admin->username }}</td>
                                <td style="color:var(--text-secondary);">{{ $admin->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $admin->role }}">
                                        {{ ucfirst($admin->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $admin->status }}">
                                        {{ $admin->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td style="color:var(--text-secondary);">{{ $admin->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="/kelola-admin/{{ $admin->id }}/edit" class="btn-sm edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn-sm delete" title="Hapus" onclick="if(confirm('Hapus admin ini?')) window.location.href='/kelola-admin/{{ $admin->id }}/delete'">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;color:var(--text-secondary);padding:30px;">
                                    <i class="fas fa-users" style="font-size:32px;margin-bottom:12px;color:#cbd5e1;display:block;"></i>
                                    Tidak ada admin.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 16px;">
                {{ $admins->links('pagination::bootstrap-4') }}
            </div>
        </section>

    </main>
</div>
</body>
</html>
