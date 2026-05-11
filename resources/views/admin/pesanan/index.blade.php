<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Pesanan</title>
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

        .btn-back {
            padding: 8px 16px;
            background: #fff;
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
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

        /* ── Stats Grid ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
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

        /* Colors matching the badge colors but softer */
        .stat-card.pending .stat-icon { background: #fef9c3; color: #ca8a04; }
        .stat-card.paid .stat-icon { background: #e0f2fe; color: #0284c7; }
        .stat-card.confirmed .stat-icon { background: #dcfce7; color: #166534; }
        .stat-card.shipped .stat-icon { background: #f3e8ff; color: #9333ea; }
        .stat-card.completed .stat-icon { background: #eff6ff; color: #2563eb; }
        .stat-card.rejected .stat-icon { background: #fee2e2; color: #dc2626; }

        .stat-content { min-width: 0; }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.3px;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--border-light);
            padding: 24px;
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

        .badge-pending { background: #fef9c3; color: #854d0e; }
        .badge-paid { background: #e0f2fe; color: #0369a1; }
        .badge-confirmed { background: #dcfce7; color: #166534; }
        .badge-shipped { background: #f3e8ff; color: #6b21a8; }
        .badge-completed { background: #eff6ff; color: #2563eb; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }

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

        .price { font-weight: 700; color: #dc2626; }
        .btn-view-proof { background: #f0fdf4; color: #166534; border: 1px solid #dcfce7; text-decoration: none; font-size: 11px; }

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

        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 80px 20px 20px; }
            .dashboard-container { flex-direction: column; }
            .stats-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 80px 16px 16px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar input, .filter-bar select, .filter-bar button, .filter-bar a { width: 100%; }
            
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; width: 100%; }
            .data-table tr { margin-bottom: 16px; background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
            .data-table td { text-align: right; padding: 8px 0; border-bottom: 1px dashed var(--border-light); display: flex; justify-content: space-between; align-items: center; }
            .data-table td:last-child { border-bottom: none; justify-content: flex-start; flex-direction: column; align-items: flex-end; gap: 8px; padding-top: 12px; text-align: right; }
            .data-table td:last-child::before { text-align: right; width: 100%; }
            .data-table td:last-child .action-buttons { justify-content: flex-end; width: 100%; flex-wrap: wrap; }
            .data-table td::before { font-weight: 600; font-size: 11px; color: var(--text-secondary); text-transform: uppercase; }
            .data-table td:nth-child(1)::before { content: "ID Pesanan"; }
            .data-table td:nth-child(2)::before { content: "Pelanggan"; }
            .data-table td:nth-child(3)::before { content: "Total"; }
            .data-table td:nth-child(4)::before { content: "Status"; }
            .data-table td:nth-child(5)::before { content: "Bukti Pembayaran"; }
            .data-table td:nth-child(6)::before { content: "Tanggal"; }
            .data-table td:nth-child(7)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'pesanan', 'pendingCount' => $stats['pending'] ?? 0])

        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Manajemen Pesanan</h1>
                    <p>Halaman lengkap untuk melihat seluruh data pesanan.</p>
                </div>
                <div class="header-actions">
                    <!-- TOMBOL BACK -->
                    <a href="{{ route('admin.kelola_pesanan.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali ke Kelola
                    </a>
                </div>
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

            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-card pending">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Menunggu</div>
                        <div class="stat-value">{{ $stats['pending'] }}</div>
                    </div>
                </div>
                <div class="stat-card paid">
                    <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Dibayar</div>
                        <div class="stat-value">{{ $stats['paid'] ?? 0 }}</div>
                    </div>
                </div>
                <div class="stat-card confirmed">
                    <div class="stat-icon"><i class="fas fa-cog"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Proses</div>
                        <div class="stat-value">{{ $stats['confirmed'] }}</div>
                    </div>
                </div>
                <div class="stat-card shipped">
                    <div class="stat-icon"><i class="fas fa-truck"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Dikirim</div>
                        <div class="stat-value">{{ $stats['shipped'] }}</div>
                    </div>
                </div>
                <div class="stat-card completed">
                    <div class="stat-icon"><i class="fas fa-check-double"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Selesai</div>
                        <div class="stat-value">{{ $stats['completed'] }}</div>
                    </div>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-content">
                        <div class="stat-label">Ditolak</div>
                        <div class="stat-value">{{ $stats['rejected'] }}</div>
                    </div>
                </div>
            </section>

            <!-- Orders Table -->
            <section class="card">
                <div class="card-title">Daftar Semua Pesanan</div>
                
                <form method="GET" action="{{ route('pesanan.index') }}" class="filter-bar">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari order id / nama / email / telepon...">
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Dibayar</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Proses</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary"><i class="fas fa-rotate-left"></i> Reset</a>
                </form>

                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                                <th>Tanggal</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $pesanan)
                                <tr>
                                    <td style="font-weight:500;">{{ $pesanan->order_id }}</td>
                                    <td><span style="color:var(--text);font-weight:500;">{{ $pesanan->customer_name }}</span></td>
                                    <td><span class="price">Rp {{ number_format($pesanan->total_price, 0, ',', '.') }}</span></td>
                                    <td>
                                        <span class="badge badge-{{ $pesanan->status }}">
                                            @switch($pesanan->status)
                                                @case('pending') Menunggu @break
                                                @case('paid') Dibayar @break
                                                @case('confirmed') Proses @break
                                                @case('shipped') Dikirim @break
                                                @case('completed') Selesai @break
                                                @case('rejected') Ditolak @break
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        @if($pesanan->payment_proof)
                                            <button type="button" class="btn-sm btn-view-proof" onclick="viewPaymentProof('{{ asset('uploads/payment_proofs/' . $pesanan->payment_proof) }}')">
                                                Lihat Bukti
                                            </button>
                                        @else
                                            <span style="color:#94a3b8;font-size:12px;">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            @if($pesanan->status === 'paid')
                                                <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $pesanan->id }})" title="Konfirmasi"><i class="fas fa-check"></i></button>
                                                <button class="btn-sm btn-reject" onclick="openRejectModal({{ $pesanan->id }})" title="Tolak"><i class="fas fa-times"></i></button>
                                            @elseif($pesanan->status === 'pending')
                                                <span style="color:#f59e0b;font-size:11px;font-weight:600;">Menunggu Pembayaran</span>
                                            @elseif($pesanan->status === 'confirmed')
                                                <button class="btn-sm btn-ship" onclick="shipOrder({{ $pesanan->id }})" title="Kirim"><i class="fas fa-truck"></i></button>
                                            @elseif($pesanan->status === 'shipped')
                                                <button class="btn-sm btn-complete" onclick="completeOrder({{ $pesanan->id }})" title="Selesai"><i class="fas fa-check-double"></i></button>
                                            @else
                                                <span style="color:#cbd5e1;font-size:12px;">Tidak ada aksi</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada pesanan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $pesanans->links('pagination::bootstrap-4') }}
            </section>
        </main>
    </div>

    <!-- Payment Proof Modal -->
    <div id="paymentProofModal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h2>Bukti Pembayaran</h2>
                <button type="button" onclick="closePaymentProofModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#6b7280;">&times;</button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran" style="max-width:100%;border-radius:8px;border:1px solid #e2e8f0;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closePaymentProofModal()">Tutup</button>
                <a id="downloadProof" href="" download class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
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
                        <textarea id="reason" name="reason" placeholder="Berikan alasan mengapa pesanan ini ditolak..." required></textarea>
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
            const form = document.getElementById('rejectForm');
            if (form) form.action = `/pesanan/${orderId}/reject`;
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.remove('active');
            currentRejectOrderId = null;
            const textarea = document.getElementById('reason');
            if (textarea) textarea.value = '';
        }

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            // Direct submission, no double alert
            const textarea = document.getElementById('reason');
            if (!textarea.value.trim()) {
                e.preventDefault();
                alert('Silakan isi alasan penolakan.');
                return;
            }
            // Show a simple loading state on the button
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            }
        });

        function confirmOrder(orderId) {
            confirmAction(null, 'Konfirmasi pesanan ini?', "{{ route('pesanan.confirm', ':id') }}".replace(':id', orderId));
        }

        function shipOrder(orderId) {
            confirmAction(null, 'Kirim pesanan ini?', "{{ route('pesanan.ship', ':id') }}".replace(':id', orderId));
        }


        function completeOrder(orderId) {
            confirmAction(null, 'Tandai pesanan ini sebagai selesai?', "{{ route('pesanan.complete', ':id') }}".replace(':id', orderId));
        }

        function viewPaymentProof(imageUrl) {
            const modal = document.getElementById('paymentProofModal');
            const image = document.getElementById('paymentProofImage');
            const download = document.getElementById('downloadProof');
            image.src = imageUrl;
            download.href = imageUrl;
            modal.classList.add('active');
        }

        function closePaymentProofModal() {
            const modal = document.getElementById('paymentProofModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('paymentProofModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentProofModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</body>
</html>
