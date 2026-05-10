<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* ── Stats Grid ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .stat-card:nth-child(1) .stat-icon { background: #ecfdf5; color: #059669; }
        .stat-card:nth-child(2) .stat-icon { background: #f3e8ff; color: #7c3aed; }
        .stat-card:nth-child(3) .stat-icon { background: #fef2f2; color: var(--primary); }
        .stat-card:nth-child(4) .stat-icon { background: #fffbeb; color: #d97706; }

        .stat-content { min-width: 0; }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.3px;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

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

        /* ── Chart ── */
        .chart-wrap {
            position: relative;
            width: 100%;
            height: 300px;
        }

        .chart-wrap canvas {
            width: 100% !important;
            height: 100% !important;
        }

        /* ── Orders + Quick Actions ── */
        .content-row {
            display: grid;
            grid-template-columns: 1fr 260px;
            gap: 20px;
            align-items: start;
        }

        /* ── Filter Bar ── */
        .filter-bar {
            display: flex;
            gap: 8px;
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
        .filter-bar select:focus {
            border-color: var(--primary);
        }

        .filter-bar input { min-width: 180px; }

        .btn-filter {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-filter.primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-filter.primary:hover { background: var(--primary-soft); }

        .btn-filter.secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-filter.secondary:hover { background: #e2e8f0; }

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
            padding: 12px 14px;
            font-size: 13px;
            color: var(--text);
            border-bottom: 1px solid var(--border-light);
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
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

        .badge.completed { background: #dcfce7; color: #166534; }
        .badge.processing { background: #fef9c3; color: #854d0e; }
        .badge.shipped { background: #dbeafe; color: #1e40af; }
        .badge.pending { background: #fef9c3; color: #854d0e; }
        .badge.confirmed { background: #dbeafe; color: #1e40af; }
        .badge.rejected { background: #fee2e2; color: #991b1b; }

        .btn-detail {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            color: var(--primary);
            background: #fef2f2;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-detail:hover {
            background: #fde8e8;
        }

        /* ── Quick Actions ── */
        .quick-actions .card-title {
            margin-bottom: 14px;
        }

        .action-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .action-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            background: var(--bg);
            border: 1px solid var(--border-light);
            transition: all 0.2s;
        }

        .action-link:hover {
            border-color: var(--border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .action-link .action-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .action-link:nth-child(1) .action-icon { background: #fef2f2; color: var(--primary); }
        .action-link:nth-child(2) .action-icon { background: #ecfdf5; color: #059669; }
        .action-link:nth-child(3) .action-icon { background: #eff6ff; color: #2563eb; }

        /* ── Pagination ── */
        .pagination { display: flex; list-style: none; padding: 0; margin: 16px 0 0; gap: 4px; flex-wrap: wrap; }
        .pagination li { display: inline-flex; }
        .pagination li a,
        .pagination li span {
            padding: 6px 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            background: var(--surface);
            transition: all 0.15s;
            min-width: 32px;
            text-align: center;
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

        /* ── Responsive ── */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .content-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 80px 16px 16px; }
            .stats-grid { gap: 10px; }
            .stat-card { padding: 16px; }
            .stat-icon { width: 42px; height: 42px; font-size: 16px; }
            .stat-value { font-size: 17px; }
            .stat-label { font-size: 11px; }
            .card { padding: 16px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar input { min-width: 100%; }
            .chart-wrap { height: 240px; }
            
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; justify-content: flex-end; padding-top: 12px; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            .data-table td:nth-child(1)::before { content: "ID Pesanan"; }
            .data-table td:nth-child(2)::before { content: "Pelanggan"; }
            .data-table td:nth-child(3)::before { content: "Total"; }
            .data-table td:nth-child(4)::before { content: "Status"; }
            .data-table td:nth-child(5)::before { content: "Aksi"; }
        }

        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .stat-card { padding: 14px; gap: 10px; }
            .stat-icon { width: 38px; height: 38px; font-size: 15px; border-radius: 10px; }
            .stat-value { font-size: 15px; }
            .chart-wrap { height: 200px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'dashboard', 'pendingCount' => $pendingCount ?? 0])

        <main class="main-content">
            <!-- Header -->
            <header class="page-header">
                <h1>Dashboard</h1>
                <p>Selamat datang di Admin Panel BBC</p>
            </header>

            <!-- Stats -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-wallet"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Total Pendapatan</div>
                        <div class="stat-value">Rp {{ number_format((float) ($totalRevenue ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-value">{{ isset($totalOrders) ? number_format((int) $totalOrders) : '0' }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Total Pelanggan</div>
                        <div class="stat-value">{{ isset($totalCustomers) ? number_format((int) $totalCustomers) : '0' }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-utensils"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Total Menu</div>
                        <div class="stat-value">{{ isset($totalMenus) ? number_format((int) $totalMenus) : '0' }}</div>
                    </div>
                </div>
            </section>

            <!-- Chart -->
            <div class="card">
                <div class="card-title">Grafik Penjualan 6 Bulan Terakhir</div>
                <div class="chart-wrap">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Orders + Quick Actions -->
            <div class="content-row">
                <!-- Orders -->
                <div class="card">
                    <div class="card-title">Info Pesanan</div>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-bar">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari order / pelanggan...">
                        <select name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit" class="btn-filter primary"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-filter secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                    </form>

                    <div style="overflow-x:auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($latestOrders) && $latestOrders->count() > 0)
                                    @foreach($latestOrders as $order)
                                        <tr>
                                            <td style="font-weight:500;">{{ $order->order_id }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td style="font-weight:600;">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = 'processing';
                                                    if ($order->status === 'completed') $badgeClass = 'completed';
                                                    elseif ($order->status === 'shipped') $badgeClass = 'shipped';
                                                    elseif ($order->status === 'pending') $badgeClass = 'pending';
                                                    elseif ($order->status === 'confirmed') $badgeClass = 'confirmed';
                                                    elseif ($order->status === 'rejected') $badgeClass = 'rejected';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td><a href="{{ route('pesanan.show', $order->id) }}" class="btn-detail">Detail</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align:center;color:#94a3b8;padding:32px;">Belum ada pesanan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $latestOrders->links('pagination::bootstrap-4') }}
                </div>

                <!-- Quick Actions -->
                <div class="card quick-actions">
                    <div class="card-title">Aksi Cepat</div>
                    <div class="action-list">
                        <a href="{{ route('admin.menu.create') }}" class="action-link">
                            <div class="action-icon"><i class="fas fa-plus"></i></div>
                            <span>Tambah Menu Baru</span>
                        </a>
                        <a href="{{ route('admin.laporan.index') }}" class="action-link">
                            <div class="action-icon"><i class="fas fa-chart-line"></i></div>
                            <span>Lihat Laporan</span>
                        </a>
                        <a href="{{ route('paket.index') }}" class="action-link">
                            <div class="action-icon"><i class="fas fa-box-open"></i></div>
                            <span>Kelola Paket</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const salesLabels = @json($monthlySalesLabels ?? []);
        const salesData = @json($monthlySalesData ?? []);

        const salesCtx = document.getElementById('salesChart');
        if (salesCtx && salesLabels.length > 0 && salesData.length > 0) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Penjualan',
                        data: salesData,
                        borderColor: '#8B0000',
                        backgroundColor: 'rgba(139, 0, 0, 0.06)',
                        fill: true,
                        borderWidth: 2.5,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#8B0000',
                        pointBorderWidth: 2,
                        pointHoverBackgroundColor: '#8B0000',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: { size: 12, weight: '600' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: (ctx) => 'Rp ' + Number(ctx.parsed.y).toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 12, weight: '500' }, color: '#94a3b8' }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: {
                                font: { size: 11 },
                                color: '#94a3b8',
                                callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID')
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }
    </script>
</body>
</html>
