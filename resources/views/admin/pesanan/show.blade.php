<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Detail Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #334155;
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
            background-color: #ffffff;
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
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0;
        }

        .page-header p {
            color: #64748b;
            font-size: 16px;
            margin-bottom: 0;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .logout-btn, .back-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .back-btn {
            background-color: #6c757d;
        }

        .back-btn:hover {
            background-color: #5a6269;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        /* Detail Container */
        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .content-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-section h2 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            width: 30%;
        }

        .info-value {
            color: #2c3e50;
            word-break: break-word;
        }

        /* Order Items */
        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-items li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .order-items li:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 600;
            flex: 1;
        }

        .item-qty {
            background-color: #f0f0f0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin: 0 10px;
        }

        .item-price {
            font-weight: 600;
            color: #27ae60;
            min-width: 100px;
            text-align: right;
        }

        /* Status Card */
        .status-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .status-badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.confirmed {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-badge.shipped {
            background-color: #e2d5f2;
            color: #5a1384;
        }

        .status-badge.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-confirm {
            background-color: #4caf50;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #45a049;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
        }

        .btn-reject:hover {
            background-color: #da190b;
        }

        .btn-ship {
            background-color: #ff9800;
            color: white;
        }

        .btn-ship:hover {
            background-color: #e68900;
        }

        .btn-complete {
            background-color: #2196f3;
            color: white;
        }

        .btn-complete:hover {
            background-color: #0b7dda;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Total Section */
        .total-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 80px 20px 20px;
            }
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
            .main-content {
                padding: 80px 16px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'pesanan', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Detail Pesanan {{ $pesanan->order_id }}</h1>
                    <p>Lihat informasi lengkap pesanan</p>
                </div>
                <div class="header-actions">
                    <a href="/pesanan" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </header>

            <div class="detail-grid">
                <!-- Left Column -->
                <div>
                    <!-- Customer Info -->
                    <section class="content-section">
                        <h2>Informasi Pelanggan</h2>
                        <div class="info-row">
                            <div class="info-label">Nama</div>
                            <div class="info-value">{{ $pesanan->customer_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $pesanan->customer_email }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Telepon</div>
                            <div class="info-value">{{ $pesanan->customer_phone }}</div>
                        </div>
                    </section>

                    <!-- Order Items -->
                    <section class="content-section">
                        <h2>Detail Pesanan</h2>
                        <ul class="order-items">
                            @foreach($pesanan->items as $item)
                                <li>
                                    <span class="item-name">{{ $item['name'] }}</span>
                                    <span class="item-qty">{{ $item['quantity'] }}x</span>
                                    <span class="item-price">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total-section">
                            <div class="total-row">
                                <span>Total Pembayaran:</span>
                                <span>Rp {{ number_format($pesanan->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </section>

                    <!-- Special Request -->
                    @if($pesanan->special_request && array_filter($pesanan->special_request))
                        <section class="content-section">
                            <h2>Catatan Khusus</h2>
                            @foreach($pesanan->special_request as $key => $value)
                                @if($value)
                                    <div class="info-row">
                                        <div class="info-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</div>
                                        <div class="info-value">{{ $value }}</div>
                                    </div>
                                @endif
                            @endforeach
                        </section>
                    @endif
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Status -->
                    <section class="status-section">
                        <h2>Status Pesanan</h2>
                        <span class="status-badge {{ $pesanan->status }}">
                            @switch($pesanan->status)
                                @case('pending')
                                    Menunggu Konfirmasi
                                    @break
                                @case('confirmed')
                                    Dikonfirmasi
                                    @break
                                @case('shipped')
                                    Dikirim
                                    @break
                                @case('completed')
                                    Selesai
                                    @break
                                @case('rejected')
                                    Ditolak
                                    @break
                            @endswitch
                        </span>

                        <div class="info-row" style="border-bottom: 1px solid #e9ecef;">
                            <div class="info-label">Tanggal Pesanan</div>
                            <div class="info-value">{{ $pesanan->created_at->format('d M Y H:i') }}</div>
                        </div>

                        <div class="action-buttons">
                            @if($pesanan->status === 'pending')
                                <button class="btn btn-confirm" onclick="confirmAction(event, 'Konfirmasi pesanan ini?', '/pesanan/{{ $pesanan->id }}/confirm')">
                                    <i class="fas fa-check"></i>
                                    Konfirmasi Pesanan
                                </button>
                                <button class="btn btn-reject" onclick="event.preventDefault(); Swal.fire('Info', 'Tolak pesanan - fitur akan diaktifkan segera', 'info');">
                                    <i class="fas fa-times"></i>
                                    Tolak Pesanan
                                </button>
                            @elseif($pesanan->status === 'confirmed')
                                <button class="btn btn-ship" onclick="confirmAction(event, 'Tandai pesanan sebagai dikirim?', '/pesanan/{{ $pesanan->id }}/ship')">
                                    <i class="fas fa-truck"></i>
                                    Tandai Dikirim
                                </button>
                            @elseif($pesanan->status === 'shipped')
                                <button class="btn btn-complete" onclick="confirmAction(event, 'Tandai pesanan sebagai selesai?', '/pesanan/{{ $pesanan->id }}/complete')">
                                    <i class="fas fa-check-double"></i>
                                    Tandai Selesai
                                </button>
                            @else
                                <button class="btn" disabled>
                                    <i class="fas fa-lock"></i>
                                    Tidak Ada Aksi
                                </button>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
