<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Edit Admin</title>
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
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 272px;
            padding: 40px;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .form-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .form-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            position: relative;
        }

        .back-arrow {
            position: absolute;
            left: 0;
            color: #64748b;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .back-arrow:hover {
            color: #0f172a;
        }

        .form-title {
            flex: 1;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .form-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 24px;
                padding-top: 80px;
            }
        }

        @media (max-width: 768px) {
            .form-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .main-content {
                padding: 16px;
                padding-top: 80px;
            }
            .form-card {
                padding: 24px;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #334155;
            outline: none;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #8B0000;
        }

        .submit-btn-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .submit-btn {
            background: #8B0000;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 10px 40px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }
        .submit-btn:hover {
            background: #660000;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error ul {
            margin-top: 5px;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'admin', 'pendingCount' => $pendingCount ?? 0])
        
        <main class="main-content">
            <div class="form-card">
                <div class="form-header">
                    <a href="/kelola-admin" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
                    <h1 class="form-title">Edit Admin</h1>
                </div>
                
                @if ($errors->any())
                    <div class="alert-error">
                        <strong>Validasi gagal!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="/kelola-admin/{{ $admin['id'] }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-layout">
                        <!-- Left Column -->
                        <div class="left-col">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $admin['name']) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ old('username', $admin['username']) }}" required>
                                <div style="font-size: 11px; color: #64748b; margin-top: 6px;">Gunakan untuk login (tidak ada spasi)</div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', $admin['email']) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="owner" {{ old('role', $admin['role']) == 'owner' ? 'selected' : '' }}>Owner (Full Access)</option>
                                    <option value="admin" {{ old('role', $admin['role']) == 'admin' ? 'selected' : '' }}>Admin (Limited Access)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="right-col">
                            <div class="form-group">
                                <label>Password Baru <span style="color: #64748b; font-weight: 400;">(Opsional)</span></label>
                                <input type="password" name="password">
                                <div style="font-size: 11px; color: #64748b; margin-top: 6px;">Kosongkan jika tidak ingin mengubah. Minimal 6 karakter.</div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="active" {{ old('status', $admin['status']) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $admin['status']) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            
                            <div class="submit-btn-container" style="margin-top: 48px;">
                                <button type="submit" class="submit-btn">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
