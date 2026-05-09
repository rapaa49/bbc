<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Edit Paket</title>
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
            align-items: center;
        }

        .logout-btn, .back-btn {
            padding: 8px 16px;
            border: none;
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

        .logout-btn {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
        }

        .back-btn:hover {
            background-color: #5a6269;
            transform: translateY(-1px);
        }

        /* Form Section */
        .content-section {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .content-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #27ae60;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background-color: #27ae60;
            color: white;
        }

        .btn-submit:hover {
            background-color: #229954;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background-color: #e9ecef;
            color: #495057;
        }

        .btn-cancel:hover {
            background-color: #dee2e6;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-list {
            list-style: none;
            font-size: 14px;
        }

        .error-list li {
            padding: 3px 0;
        }

        .image-preview {
            margin-top: 12px;
            width: min(260px, 100%);
            aspect-ratio: 1 / 1;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'paket', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Edit Paket</h1>
                    <p>Edit paket bundle produk BBC</p>
                </div>
                <div class="header-actions">
                    <a href="/paket" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </header>

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Validasi gagal!</strong>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <section class="content-section">
                <h2>Form Edit Paket</h2>
                <form action="/paket/{{ $paket->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Paket</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $paket->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="portion">Porsi (Jumlah Orang)</label>
                            <input type="number" id="portion" name="portion" value="{{ old('portion', $paket->portion) }}" min="1" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Harga Paket</label>
                            <input type="text" id="price" name="price" value="{{ old('price', number_format((float) $paket->price, 0, ',', '.')) }}" placeholder="contoh: 1.000.000" required>
                        </div>
                        <div class="form-group">
                            <label for="original_price">Harga Awal (Dicoret)</label>
                            <input type="text" id="original_price" name="original_price" value="{{ old('original_price', $paket->original_price ? number_format((float) $paket->original_price, 0, ',', '.') : '') }}" placeholder="Opsional, contoh: 1.200.000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="active" {{ old('status', $paket->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $paket->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi Paket</label>
                        <textarea id="description" name="description" required>{{ old('description', $paket->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Paket</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <div id="imagePreview" class="image-preview">
                            <img src="{{ $paket->image }}" alt="{{ $paket->name }}">
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="/paket" class="btn btn-cancel">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
        // Preview image sebelum upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.innerHTML = `<img src="${event.target.result}" alt="preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
