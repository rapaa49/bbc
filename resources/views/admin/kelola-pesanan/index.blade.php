<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Kelola Pesanan</title>
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

        .main-content {
            flex: 1;
            margin-left: 272px;
            padding: 32px;
            min-height: 100vh;
        }

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

        .layout {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 20px;
            align-items: start;
        }

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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary);
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
        .alert-success { background-color: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
        .alert-error { background-color: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }

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
        .filter-bar select:focus { border-color: var(--primary); }
        .filter-bar input { flex: 1; min-width: 220px; }
        .filter-bar select { min-width: 140px; }

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-soft); }
        .btn-secondary { background: #f1f5f9; color: #475569; }
        .btn-secondary:hover { background: #e2e8f0; }

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

        .badge-selesai { background: #dcfce7; color: #166534; }
        .badge-proses { background: #fef9c3; color: #854d0e; }
        .badge-dikirim { background: #dbeafe; color: #1e40af; }
        .badge-cancel { background: #fee2e2; color: #991b1b; }

        /* ── Action Buttons ── */
        .action-buttons {
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
        }

        .btn-sm:hover { filter: brightness(0.95); }
        .btn-confirm { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
        .btn-reject { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
        .btn-ship { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
        .btn-paid { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
        .btn-complete { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }

        /* ── Quick Actions ── */
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

        .action-link.red .action-icon { background: #fef2f2; color: var(--primary); }
        .action-link.green .action-icon { background: #ecfdf5; color: #059669; }

        /* ── Explanation Box ── */
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #1e3a8a;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            line-height: 1.5;
        }
        .info-box i { font-size: 16px; margin-top: 2px; }

        /* ── Modals ── */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
        }

        .modal.active { display: flex; align-items: center; justify-content: center; }

        .modal-content {
            background: var(--surface);
            border-radius: 16px;
            width: 90%;
            max-width: 480px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: modalFadeIn 0.2s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-light);
        }

        .modal-header h2 {
            font-size: 16px;
            margin: 0;
            color: var(--text);
            font-weight: 600;
        }

        .modal-body { padding: 20px 24px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        .form-group textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group textarea:focus { border-color: var(--primary); }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: var(--bg);
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

        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
            .layout { 
                display: flex;
                flex-direction: column-reverse;
            }
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
            .data-table td:last-child { border-bottom: none; justify-content: flex-start; flex-direction: column; align-items: flex-end; gap: 8px; padding-top: 12px; text-align: right; }
            .data-table td:last-child::before { text-align: right; width: 100%; }
            .data-table td:last-child .action-buttons { justify-content: flex-end; width: 100%; flex-wrap: wrap; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            .data-table td:nth-child(1)::before { content: "ID Pesanan"; }
            .data-table td:nth-child(2)::before { content: "Pelanggan"; }
            .data-table td:nth-child(3)::before { content: "Total"; }
            .data-table td:nth-child(4)::before { content: "Status"; }
            .data-table td:nth-child(5)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'pesanan', 'pendingCount' => $pendingCount ?? 0])

        <main class="main-content">
            <header class="page-header">
                <h1>Kelola Pesanan</h1>
                <p>Pantau dan kelola seluruh transaksi pesanan pelanggan.</p>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            <!-- INFO BOX MENGATASI KEBINGUNGAN -->
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Panduan Halaman:</strong> Halaman ini memisahkan <b>Pesanan Terbaru</b> (yang baru masuk dan butuh prioritas) di atas, dengan <b>Semua Riwayat Pesanan</b> (seluruh data yang bisa dicari) di bagian bawah. Tombol <b>Halaman Pesanan Lengkap</b> di kanan adalah alternatif jika Anda ingin melihat tabel pesanan dalam layar penuh.
                </div>
            </div>

            <div class="layout">
                <div class="main-column">

                    <!-- CARD 1: RECENT ORDERS -->
                    <section class="card">
                        <div class="card-title">
                            <i class="fas fa-clock"></i> 5 Pesanan Terbaru
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($recentOrders ?? []) as $o)
                                        @php
                                            $status = (string) ($o->status ?? '');
                                            $label = 'Proses';
                                            $badge = 'badge-proses';

                                            if ($status === 'completed') { $label = 'Selesai'; $badge = 'badge-selesai'; }
                                            elseif ($status === 'shipped') { $label = 'Dikirim'; $badge = 'badge-dikirim'; }
                                            elseif ($status === 'rejected') { $label = 'Cancel'; $badge = 'badge-cancel'; }
                                        @endphp
                                        <tr>
                                            <td style="font-weight:500;">{{ $o->order_id }}</td>
                                            <td>{{ $o->customer_name }}</td>
                                            <td style="font-weight:600;">Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                            <td><span class="badge {{ $badge }}">{{ $label }}</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    @if(!empty($o->payment_proof))
                                                        <a href="{{ asset('uploads/payment_proofs/' . $o->payment_proof) }}" target="_blank" class="btn-sm" style="background:#10b981;color:white;border:none;" title="Lihat Bukti"><i class="fas fa-receipt"></i></a>
                                                    @endif

                                                    @if(($o->status ?? '') === 'pending')
                                                        <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $o->id }})"><i class="fas fa-check"></i> Konfirmasi</button>
                                                        <button class="btn-sm btn-reject" onclick="openRejectModal({{ $o->id }})"><i class="fas fa-times"></i> Tolak</button>
                                                    @elseif(($o->status ?? '') === 'confirmed')
                                                        <button class="btn-sm btn-ship" onclick="shipOrder({{ $o->id }})"><i class="fas fa-truck"></i> Kirim</button>
                                                        <button class="btn-sm btn-paid" onclick="paidOrder({{ $o->id }})"><i class="fas fa-money-bill"></i> Lunas</button>
                                                    @elseif(($o->status ?? '') === 'shipped')
                                                        <button class="btn-sm btn-complete" onclick="completeOrder({{ $o->id }})"><i class="fas fa-check-double"></i> Selesai</button>
                                                    @else
                                                        <span style="color:#94a3b8;font-size:12px;">Tidak ada aksi</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#94a3b8;padding:24px;">Belum ada pesanan terbaru.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- CARD 2: ALL ORDERS / HISTORY -->
                    <section class="card">
                        <div class="card-title">
                            <i class="fas fa-list-ul"></i> Pencarian & Semua Riwayat Pesanan
                        </div>
                        
                        <form method="GET" action="{{ route('admin.kelola_pesanan.index') }}" class="filter-bar">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID / nama / email / telepon...">
                            <select name="status">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                            <a href="{{ route('admin.kelola_pesanan.index') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                        </form>

                        <div style="overflow-x:auto;">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($orders ?? []) as $o)
                                        @php
                                            $status = (string) ($o->status ?? '');
                                            $label = 'Proses';
                                            $badge = 'badge-proses';

                                            if ($status === 'completed') { $label = 'Selesai'; $badge = 'badge-selesai'; }
                                            elseif ($status === 'shipped') { $label = 'Dikirim'; $badge = 'badge-dikirim'; }
                                            elseif ($status === 'rejected') { $label = 'Cancel'; $badge = 'badge-cancel'; }
                                        @endphp
                                        <tr>
                                            <td style="font-weight:500;">{{ $o->order_id }}</td>
                                            <td>{{ $o->customer_name }}</td>
                                            <td style="font-weight:600;">Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                            <td><span class="badge {{ $badge }}">{{ $label }}</span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    @if(!empty($o->payment_proof))
                                                        <a href="{{ asset('uploads/payment_proofs/' . $o->payment_proof) }}" target="_blank" class="btn-sm" style="background:#10b981;color:white;border:none;" title="Lihat Bukti"><i class="fas fa-receipt"></i></a>
                                                    @endif

                                                    @if(($o->status ?? '') === 'pending')
                                                        <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $o->id }})"><i class="fas fa-check"></i></button>
                                                        <button class="btn-sm btn-reject" onclick="openRejectModal({{ $o->id }})"><i class="fas fa-times"></i></button>
                                                    @elseif(($o->status ?? '') === 'confirmed')
                                                        <button class="btn-sm btn-ship" onclick="shipOrder({{ $o->id }})" title="Kirim"><i class="fas fa-truck"></i></button>
                                                        <button class="btn-sm btn-paid" onclick="paidOrder({{ $o->id }})" title="Lunas"><i class="fas fa-money-bill"></i></button>
                                                    @elseif(($o->status ?? '') === 'shipped')
                                                        <button class="btn-sm btn-complete" onclick="completeOrder({{ $o->id }})" title="Selesai"><i class="fas fa-check-double"></i></button>
                                                    @else
                                                        <span style="color:#94a3b8;font-size:12px;">Tidak ada aksi</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#94a3b8;padding:24px;">Belum ada data pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $orders->links('pagination::bootstrap-4') }}
                    </section>
                </div>

                <!-- SIDEBAR / QUICK ACTIONS -->
                <aside class="sidebar-column">
                    <div class="card" style="position: sticky; top: 24px;">
                        <div class="card-title">Aksi Cepat</div>
                        <div class="action-list">
                            <a href="{{ route('pesanan.index') }}" class="action-link red">
                                <div class="action-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                <span>Halaman Pesanan Lengkap</span>
                            </a>
                            <a href="{{ route('admin.kelola_pesanan.export') }}" class="action-link green">
                                <div class="action-icon"><i class="fas fa-file-excel"></i></div>
                                <span>Export Laporan Excel</span>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>

    <!-- MODAL REJECT -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tolak Pesanan</h2>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Alasan Penolakan</label>
                        <textarea id="reason" name="reason" placeholder="Berikan alasan mengapa pesanan ini ditolak agar pelanggan mengerti..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background:#dc2626;">Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentRejectOrderId = null;

        function openRejectModal(orderId) {
            currentRejectOrderId = orderId;
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.remove('active');
            currentRejectOrderId = null;
            const textarea = document.getElementById('reason');
            if (textarea) textarea.value = '';
        }

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (currentRejectOrderId) {
                this.action = `/pesanan/${currentRejectOrderId}/reject`;
                this.submit();
            }
        });

        function confirmOrder(orderId) {
            confirmAction(null, 'Konfirmasi pesanan ini?', `/pesanan/${orderId}/confirm`);
        }

        function shipOrder(orderId) {
            confirmAction(null, 'Kirim pesanan ini?', `/pesanan/${orderId}/ship`);
        }

        function paidOrder(orderId) {
            confirmAction(null, 'Tandai pesanan ini sebagai sudah dibayar?', `/pesanan/${orderId}/paid`);
        }

        function completeOrder(orderId) {
            confirmAction(null, 'Tandai pesanan ini sebagai selesai?', `/pesanan/${orderId}/complete`);
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) closeRejectModal();
        });
    </script>
</body>
</html>
