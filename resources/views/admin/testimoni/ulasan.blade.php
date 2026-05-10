<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Ulasan Pelanggan</title>
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

        .filter-bar input {
            flex: 1;
            min-width: 220px;
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

        .filter-bar input:focus { border-color: var(--primary); }

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

        .star-rating { color: #f59e0b; font-size: 12px; }
        .review-text { max-width: 280px; line-height: 1.5; color: var(--text-secondary); }

        /* ── Admin Reply Form ── */
        .admin-reply-form { display: flex; gap: 8px; align-items: center; }
        .admin-reply-form input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            outline: none;
            background: var(--bg);
            color: var(--text);
            transition: border-color 0.2s;
        }
        .admin-reply-form input:focus { border-color: var(--primary); }
        .admin-reply-form button {
            padding: 8px 14px;
            border-radius: 8px;
            background: var(--text);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .admin-reply-form button:hover { background: #334155; }

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

        /* ── Action Buttons ── */
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
        .btn-sm.delete { color: #dc2626; }

        /* ── Pagination ── */
        .pagination { display: flex; list-style: none; padding: 0; margin: 16px 0 0; gap: 4px; flex-wrap: wrap; }
        .pagination li { display: inline-flex; }
        .pagination li a,
        .pagination li span {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: var(--text-secondary); text-decoration: none; font-size: 12px; font-weight: 500;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center;
        }
        .pagination li.active span { background: var(--text); color: #fff; border-color: var(--text); }
        .pagination li a:hover { background: #f1f5f9; color: var(--text); }
        .pagination li.disabled span { color: #cbd5e1; background: #f8fafc; cursor: not-allowed; }
        .pagination .page-item { display: inline-flex; }
        .pagination .page-link {
            padding: 6px 10px; border: 1px solid var(--border); border-radius: 6px;
            color: var(--text-secondary); text-decoration: none; font-size: 12px; font-weight: 500;
            background: var(--surface); transition: all 0.15s; min-width: 32px; text-align: center; margin: 0 2px;
        }
        .pagination .page-item.active .page-link { background: var(--text); color: #fff; border-color: var(--text); }
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
            .filter-bar input, .filter-bar button, .filter-bar a { width: 100%; }
            .admin-reply-form { flex-direction: column; align-items: stretch; }
            .review-text { max-width: 100%; }

            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; justify-content: flex-end; padding-top: 12px; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            
            .data-table td:nth-child(1)::before { content: "Nama"; }
            .data-table td:nth-child(2)::before { content: "Rating"; }
            .data-table td:nth-child(3)::before { content: "Ulasan"; }
            .data-table td:nth-child(4)::before { content: "Balasan Admin"; }
            .data-table td:nth-child(5)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'ulasan'])

    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Ulasan Pelanggan</h1>
                <p>Kelola ulasan dan balasan dari pelanggan.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Influencer
                </a>
            </div>
        </header>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <section class="card">
            <form class="filter-bar" method="GET" action="{{ route('admin.testimoni.ulasan') }}">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari ulasan...">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                @if(($q ?? '') !== '')
                    <a href="{{ route('admin.testimoni.ulasan') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                @endif
            </form>

            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Rating</th>
                            <th>Ulasan</th>
                            <th style="min-width: 250px;">Balasan Admin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($customerTestimonials as $item)
                        <tr>
                            <td style="font-weight: 500;">{{ $item->name }}</td>
                            <td>
                                <span class="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i > $item->rating ? '-half-alt' : '' }}"></i>
                                    @endfor
                                </span>
                                <span style="margin-left: 4px; font-size: 12px; color: var(--text-secondary); font-weight: 500;">({{ $item->rating }})</span>
                            </td>
                            <td class="review-text">{{ $item->review }}</td>
                            <td>
                                <form class="admin-reply-form" method="POST" action="{{ route('admin.testimoni.customer.reply', $item->id) }}">
                                    @csrf
                                    <input type="text" name="admin_reply" value="{{ $item->admin_reply ?? '' }}" placeholder="Balas ulasan...">
                                    <button type="submit">Simpan</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.testimoni.customer.destroy', $item->id) }}" onsubmit="return confirm('Hapus ulasan pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:var(--text-secondary);padding:24px;">Belum ada ulasan pelanggan.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $customerTestimonials->links('pagination::bootstrap-4') }}
        </section>

    </main>
</div>
</body>
</html>
