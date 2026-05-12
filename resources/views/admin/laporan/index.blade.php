<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Laporan Penjualan</title>
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

        .btn-success { background: #16a34a; color: #fff; }
        .btn-success:hover { background: #15803d; }

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
        .stat-card:nth-child(2) .stat-icon { background: #fffbeb; color: #d97706; }
        .stat-card:nth-child(3) .stat-icon { background: #eff6ff; color: #2563eb; }
        .stat-card:nth-child(4) .stat-icon { background: #fef2f2; color: var(--primary); }

        .stat-content { min-width: 0; }

        .stat-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 2px;
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
        .chart-box canvas {
            width: 100% !important;
            height: 320px !important;
        }

        /* ── Filter Bar ── */
        .filter-bar {
            display: flex;
            gap: 12px;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-group label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-group input {
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

        .filter-group input:focus { border-color: var(--primary); }
        .filter-group input[type="text"] { min-width: 220px; }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

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

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .price { font-weight: 600; color: #059669; }

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

        /* ── Responsive ── */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; justify-content: flex-start; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 80px 16px 16px; }
            .stats-grid { gap: 10px; }
            .stat-card { padding: 16px; }
            .stat-icon { width: 42px; height: 42px; font-size: 16px; }
            .stat-value { font-size: 17px; }
            .card { padding: 16px; }
            .filter-bar { flex-direction: column; align-items: stretch; gap: 12px; }
            .filter-group input { width: 100%; }
            .filter-actions { justify-content: flex-start; }
            .chart-box canvas { height: 240px !important; }

            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; justify-content: flex-end; padding-top: 12px; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }

            /* Yearly Sales Report */
            .card:nth-of-type(2) .data-table td:nth-child(1)::before { content: "Tahun"; }
            .card:nth-of-type(2) .data-table td:nth-child(2)::before { content: "Jumlah Pesanan"; }
            .card:nth-of-type(2) .data-table td:nth-child(3)::before { content: "Total Penjualan"; }
            .card:nth-of-type(2) .data-table td:nth-child(4)::before { content: "Penjualan Paket"; }

            /* History Penjualan */
            .card:nth-of-type(3) .data-table td:nth-child(1)::before { content: "ID Pesanan"; }
            .card:nth-of-type(3) .data-table td:nth-child(2)::before { content: "Tanggal"; }
            .card:nth-of-type(3) .data-table td:nth-child(3)::before { content: "Pelanggan"; }
            .card:nth-of-type(3) .data-table td:nth-child(4)::before { content: "Qty"; }
            .card:nth-of-type(3) .data-table td:nth-child(5)::before { content: "Total"; }
        }
        
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 8px; }
            .stat-card { padding: 14px; gap: 10px; flex-direction: column; align-items: flex-start; }
            .stat-icon { width: 38px; height: 38px; font-size: 15px; border-radius: 10px; }
            .stat-value { font-size: 15px; }
            .data-table { font-size: 11px; }
            .chart-box canvas { height: 200px !important; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'laporan', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Laporan Penjualan</h1>
                    <p>Ringkasan, grafik, dan riwayat laporan penjualan</p>
                </div>
                <div class="header-actions">
                    <a class="btn btn-success" href="{{ route('admin.laporan.export', request()->query()) }}">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </header>

            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-wallet"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Total Penjualan</div>
                        <div class="stat-value">Rp {{ number_format((float) ($totalSales ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Penjualan Paket</div>
                        <div class="stat-value">Rp {{ number_format((float) ($paketSales ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Bulan Ini</div>
                        <div class="stat-value">Rp {{ number_format((float) ($currentMonthSales ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-calendar-minus"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Bulan Lalu</div>
                        <div class="stat-value">Rp {{ number_format((float) ($lastMonthSales ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
            </section>

            <!-- Grafik Penjualan -->
            <section class="card">
                <div class="card-title">Grafik Penjualan 6 Bulan Terakhir</div>
                <div class="chart-box">
                    <canvas id="salesChart"></canvas>
                </div>
            </section>

            <!-- Yearly Sales Report -->
            <section class="card">
                <div class="card-title">Laporan Penjualan per Tahun</div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th class="text-center">Jumlah Pesanan</th>
                                <th class="text-right">Total Penjualan</th>
                                <th class="text-right">Penjualan Paket Bakso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($yearlySales as $sale)
                                <tr>
                                    <td style="font-weight: 500;">{{ $sale->year }}</td>
                                    <td class="text-center">{{ $sale->orders }}</td>
                                    <td class="text-right price">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td class="text-right" style="font-weight: 600;">Rp {{ number_format($yearlyPaketSales[$sale->year] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center" style="color:var(--text-secondary);">Belum ada data penjualan tahunan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- History Penjualan -->
            <section class="card">
                <div class="card-title">History Penjualan Keseluruhan</div>
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-bar">
                    <div class="filter-group">
                        <label for="q">Search</label>
                        <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID pesanan / pelanggan...">
                    </div>
                    <div class="filter-group">
                        <label for="from">Dari Tanggal</label>
                        <input id="from" type="date" name="from" value="{{ request('from') }}">
                    </div>
                    <div class="filter-group">
                        <label for="to">Sampai Tanggal</label>
                        <input id="to" type="date" name="to" value="{{ request('to') }}">
                    </div>
                    <div class="filter-actions" style="margin-bottom: 2px;">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                    </div>
                </form>

                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($completedOrders ?? []) as $o)
                                @php
                                    $items = is_array($o->items ?? null) ? $o->items : [];
                                    $qty = 0;
                                    foreach ($items as $it) { $qty += (int) ($it['quantity'] ?? 0); }
                                @endphp
                                <tr>
                                    <td style="font-weight: 500;">{{ $o->order_id }}</td>
                                    <td style="color: var(--text-secondary);">{{ optional($o->created_at)->format('d M Y') }}</td>
                                    <td><span style="font-weight: 500;">{{ $o->customer_name }}</span></td>
                                    <td class="text-center">{{ $qty }}</td>
                                    <td class="text-right price">Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center" style="color:var(--text-secondary);padding:24px;">Belum ada riwayat pesanan selesai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{ $completedOrders->links('pagination::bootstrap-4') }}
            </section>
        </main>
    </div>

    <script>
        const salesLabels = @json($monthlySalesLabels ?? []);
        const salesData = @json($monthlySalesData ?? []);

        const salesCtx = document.getElementById('salesChart');
        if (salesCtx) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Penjualan',
                        data: salesData,
                        borderColor: '#8B0000',
                        backgroundColor: 'rgba(139, 0, 0, 0.08)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#8B0000',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 12 },
                                color: '#64748b'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 12 },
                                color: '#64748b',
                                callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        }

        // Auto refresh halaman laporan penjualan setiap 3 detik
        setInterval(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>