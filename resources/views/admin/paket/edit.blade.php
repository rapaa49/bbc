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

        .form-group textarea {
            height: 140px;
            resize: none;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s;
            position: relative;
            background: #fff;
        }
        .upload-area:hover {
            border-color: #8B0000;
        }
        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            z-index: 2;
        }
        .upload-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(139, 0, 0, 0.04);
            color: #8B0000;
            font-size: 18px;
            margin-bottom: 12px;
        }
        .upload-text {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
        }
        .upload-text strong {
            color: #8B0000;
        }
        .upload-subtext {
            color: #64748b;
            font-size: 11px;
            font-weight: 500;
            margin-top: 6px;
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
        @include('admin.partials.sidebar', ['activeMenu' => 'paket', 'pendingCount' => $pendingCount ?? 0])
        
        <main class="main-content">
            <div class="form-card">
                <div class="form-header">
                    <a href="/paket" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
                    <h1 class="form-title">Edit Paket</h1>
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
                
                <form action="{{ route('paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-layout">
                        <!-- Left Column -->
                        <div class="left-col">
                            <div class="form-group">
                                <label>Nama Paket</label>
                                <input type="text" name="name" value="{{ old('name', $paket->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Paket</label>
                                <input type="number" name="price" value="{{ old('price', $paket->price) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Awal (Dicoret)</label>
                                <input type="number" name="original_price" value="{{ old('original_price', $paket->original_price) }}">
                            </div>
                            <div class="form-group">
                                <label>Porsi (Jumlah Orang)</label>
                                <input type="number" name="portion" value="{{ old('portion', $paket->portion) }}" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" required>
                                    <option value="active" {{ old('status', $paket->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $paket->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="right-col">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" required>{{ old('description', $paket->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="upload-area" id="uploadArea" style="overflow:hidden; padding:0; min-height:180px; display:flex; align-items:center; justify-content:center; position:relative;">
                                    <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this)" style="z-index:20;">
                                    <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                                    <div id="uploadContent" style="padding:40px 20px; z-index:10; text-align:center; display:{{ $paket->image ? 'none' : 'block' }};">
                                        <div class="upload-icon"><i class="fas fa-file-upload"></i></div>
                                        <div class="upload-text"><strong>Unggah</strong> File</div>
                                        <div class="upload-subtext">JPG atau PNG, maksimal 10 MB</div>
                                    </div>
                                    <img id="imagePreview" src="{{ $paket->image ? asset($paket->image) : '' }}" style="display:{{ $paket->image ? 'block' : 'none' }}; width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0; z-index:5;" alt="Preview">
                                    <button type="button" id="removeImageBtn" onclick="removeImage()" style="display:{{ $paket->image ? 'flex' : 'none' }}; position:absolute; top:12px; right:12px; z-index:30; background:#dc2626; color:white; border:none; border-radius:50%; width:32px; height:32px; cursor:pointer; box-shadow:0 4px 12px rgba(0,0,0,0.15); align-items:center; justify-content:center; transition: background 0.2s;"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            
                            <div class="submit-btn-container">
                                <button type="submit" class="submit-btn">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const content = document.getElementById('uploadContent');
            const removeBtn = document.getElementById('removeImageBtn');
            const removeInput = document.getElementById('removeImageInput');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if(content) content.style.display = 'none';
                    if(removeBtn) removeBtn.style.display = 'flex';
                    if(removeInput) removeInput.value = '0';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('imageInput');
            const preview = document.getElementById('imagePreview');
            const content = document.getElementById('uploadContent');
            const removeBtn = document.getElementById('removeImageBtn');
            const removeInput = document.getElementById('removeImageInput');
            
            if(input) input.value = '';
            if(preview) {
                preview.style.display = 'none';
                preview.src = '';
            }
            if(content) content.style.display = 'block';
            if(removeBtn) removeBtn.style.display = 'none';
            if(removeInput) removeInput.value = '1';
        }
    </script>
</body>
</html>
