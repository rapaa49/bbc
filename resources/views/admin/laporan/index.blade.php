<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Laporan Penjualan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .export-btn {
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.18);
        }

        .export-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        .logout-btn {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .logout-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px 24px;
            border: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.25s ease;
        }

        .stat-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-card:nth-child(1) .stat-icon { background: #ecfdf5; color: #059669; }
        .stat-card:nth-child(2) .stat-icon { background: #f3e8ff; color: #7c3aed; }
        .stat-card:nth-child(3) .stat-icon { background: #fff7ed; color: #ea580c; }
        .stat-card:nth-child(4) .stat-icon { background: #eff6ff; color: #2563eb; }

        .stat-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
            white-space: nowrap;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.3px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Tables */
        .content-section {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
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

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
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

        .data-table td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            font-size: 14px;
            color: var(--text-main);
        }

        .data-table tr:hover {
            background-color: #fffaf2;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .chart-box {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 14px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 320px !important;
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
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination li a:hover {
            background: var(--line);
            color: var(--primary);
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
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .dashboard-container {
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .page-header p {
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-icon {
                width: 44px;
                height: 44px;
                font-size: 17px;
            }

            .stat-value {
                font-size: 18px;
            }

            .stat-label {
                font-size: 12px;
            }

            .content-section {
                padding: 16px;
            }

            .data-table th,
            .data-table td {
                padding: 10px;
                font-size: 12px;
            }

            .chart-box canvas {
                height: 250px !important;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 14px;
                gap: 12px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
                border-radius: 12px;
            }

            .stat-value {
                font-size: 16px;
            }

            .data-table {
                font-size: 11px;
            }

            .data-table th,
            .data-table td {
                padding: 8px;
            }

            .chart-box canvas {
                height: 200px !important;
            }
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
                    <p>Laporan penjualan dari tahun ke tahun</p>
                </div>
                <div class="header-actions">
                    <a class="export-btn" href="{{ route('admin.laporan.export', request()->query()) }}">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </a>
                </div>
            </header>

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

            <section class="content-section">
                <h2>Grafik Penjualan 6 Bulan Terakhir</h2>
                <div class="chart-box">
                    <canvas id="salesChart"></canvas>
                </div>
            </section>

            <!-- Yearly Sales Report -->
            <section class="content-section">
                <h2>Laporan Penjualan per Tahun</h2>
                <div class="table-container">
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
                                    <td>{{ $sale->year }}</td>
                                    <td class="text-center">{{ $sale->orders }}</td>
                                    <td class="text-right">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td class="text-right">Rp {{ number_format($yearlyPaketSales[$sale->year] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="content-section">
                <h2>History Penjualan</h2>
                <form method="GET" action="{{ route('admin.laporan.index') }}" style="margin-bottom: 14px; display: flex; gap: 10px; flex-wrap: wrap; align-items: end;">
                    <div style="display:flex;flex-direction:column;gap:6px;min-width:220px;">
                        <label for="q" style="font-size:12px;font-weight:700;color:#2c3e50;">Search</label>
                        <input id="q" name="q" value="{{ request('q') }}" placeholder="Cari ID pesanan / nama pelanggan" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label for="from" style="font-size:12px;font-weight:700;color:#2c3e50;">Dari Tanggal</label>
                        <input id="from" type="date" name="from" value="{{ request('from') }}" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label for="to" style="font-size:12px;font-weight:700;color:#2c3e50;">Sampai Tanggal</label>
                        <input id="to" type="date" name="to" value="{{ request('to') }}" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <button type="submit" class="export-btn" style="background-color:#3498db;">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                        <a href="{{ route('admin.laporan.index') }}" class="export-btn" style="background-color:#64748b;">
                            <i class="fas fa-rotate-left"></i>
                            Reset
                        </a>
                    </div>
                </form>
                <div class="table-container">
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
                                    <td>{{ $o->order_id }}</td>
                                    <td>{{ optional($o->created_at)->format('d M Y') }}</td>
                                    <td>{{ $o->customer_name }}</td>
                                    <td class="text-center">{{ $qty }}</td>
                                    <td class="text-right">Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 16px;">
                    {{ $completedOrders->links('pagination::bootstrap-4') }}
                </div>
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
                        backgroundColor: 'rgba(139, 0, 0, 0.12)',
                        fill: true,
                        borderWidth: 3,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#DAA520'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>