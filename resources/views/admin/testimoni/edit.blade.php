<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Edit Testimoni Influencer</title>
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
        .form-group input[type="url"],
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

        .form-group textarea {
            height: 140px;
            resize: none;
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
        @include('admin.partials.sidebar', ['activeMenu' => 'testimoni', 'pendingCount' => $pendingCount ?? 0])
        
        <main class="main-content">
            <div class="form-card">
                <div class="form-header">
                    <a href="{{ route('admin.testimoni.index') }}" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
                    <h1 class="form-title">Edit Testimoni Influencer</h1>
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
                
                <form method="POST" action="{{ route('admin.testimoni.influencer.update', $influencerTestimonial->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-layout">
                        <!-- Left Column -->
                        <div class="left-col">
                            <div class="form-group">
                                <label>Nama Influencer / Media Review (Opsional)</label>
                                <input id="influencer_name" type="text" name="title" value="{{ old('title', $influencerTestimonial->title) }}" placeholder="Contoh: Nex Carlos / Kuliner Bogor">
                            </div>
                            <div class="form-group">
                                <label>URL YouTube</label>
                                <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url', $influencerTestimonial->youtube_url) }}" required placeholder="https://www.youtube.com/...">
                                <div style="margin-top: 8px; font-size: 12px; color: #0369a1; background: #e0f2fe; padding: 10px 12px; border-radius: 6px; display: flex; align-items: center; gap: 8px; border: 1px solid #bae6fd;">
                                    <i class="fas fa-magic"></i>
                                    <span>Isi link YouTube untuk mendapatkan <strong>Nama</strong> dan <strong>Thumbnail</strong> secara otomatis dan cepat!</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Urutan Tampil</label>
                                <input type="number" name="display_order" value="{{ old('display_order', $influencerTestimonial->display_order) }}" min="0">
                            </div>
                            <div class="form-group" style="margin-top:30px;">
                                <label class="checkbox-label" style="display:flex; align-items:center; gap:10px; font-weight:500; cursor:pointer;">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $influencerTestimonial->is_active) ? 'checked' : '' }} style="width:18px; height:18px; accent-color:#8B0000; margin:0;">
                                    Aktif Ditampilkan
                                </label>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="right-col">
                            <div class="form-group">
                                <label>Thumbnail HD (Otomatis)</label>
                                <input id="thumbnail_preview_url" type="url" readonly placeholder="Akan Terisi Otomatis Dari URL YouTube" style="background:#f1f5f9; color:#64748b;">
                                <div id="imagePreview" style="margin-top:16px; width: 100%; border-radius:8px; overflow:hidden; border:1px solid #e2e8f0; background:#f8fafc; min-height:160px; display:flex; align-items:center; justify-content:center;">
                                    <img id="youtube_thumb_preview" src="{{ $influencerTestimonial->thumbnail_url }}" alt="Preview thumbnail YouTube" style="width:100%; height:auto; display:block;">
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
        function extractYoutubeId(url) {
            if (!url) return null;
            const match = url.match(/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/i);
            return match ? match[1] : null;
        }

        function updateYoutubeThumbnailPreview() {
            const youtubeInput = document.getElementById('youtube_url');
            const previewUrlInput = document.getElementById('thumbnail_preview_url');
            const previewImg = document.getElementById('youtube_thumb_preview');
            const videoId = extractYoutubeId(youtubeInput.value);

            if (videoId) {
                const hdThumb = `https://i.ytimg.com/vi/${videoId}/maxresdefault.jpg`;
                previewUrlInput.value = hdThumb;
                previewImg.src = hdThumb;
                previewImg.style.display = 'block';
                return;
            }

            previewUrlInput.value = '';
            previewImg.removeAttribute('src');
            previewImg.style.display = 'none';
        }

        function toTitleCase(value) {
            const acronyms = {
                tv: 'TV', tvri: 'TVRI', bbc: 'BBC', rcti: 'RCTI',
                sctv: 'SCTV', mnc: 'MNC', net: 'NET', cnn: 'CNN', id: 'ID',
            };

            return value
                .trim()
                .split(/\s+/)
                .map(part => part.split('-').map(segment => {
                    const lower = segment.toLowerCase();
                    if (acronyms[lower]) return acronyms[lower];
                    return lower.replace(/\b([a-z])/g, (_, letter) => letter.toUpperCase());
                }).join('-'))
                .join(' ');
        }

        let lastFetchedVideoId = extractYoutubeId(document.getElementById('youtube_url').value);

        async function autofillInfluencerName(isInitialLoad = false) {
            const youtubeInput = document.getElementById('youtube_url');
            const nameInput = document.getElementById('influencer_name');
            const youtubeUrl = youtubeInput.value.trim();
            const currentVideoId = extractYoutubeId(youtubeUrl);

            // If URL is empty/invalid, clear the name (only if it's not the initial page load)
            if (!currentVideoId) {
                if (!isInitialLoad) {
                    nameInput.value = '';
                    lastFetchedVideoId = null;
                }
                return;
            }

            // If the video ID hasn't changed since last fetch, do nothing
            if (!isInitialLoad && currentVideoId === lastFetchedVideoId) return;

            // On initial load, if the name is already filled, don't overwrite it
            if (isInitialLoad && nameInput.value.trim() !== '') {
                return;
            }

            try {
                const oembedUrl = `https://www.youtube.com/oembed?url=${encodeURIComponent(youtubeUrl)}&format=json`;
                const res = await fetch(oembedUrl);
                if (!res.ok) return;
                const data = await res.json();

                const autoName = toTitleCase((data.author_name || data.title || '').trim());
                if (autoName) {
                    nameInput.value = autoName;
                    lastFetchedVideoId = currentVideoId;
                }
            } catch (e) {
                // Ignore fetch errors
            }
        }

        document.getElementById('youtube_url').addEventListener('input', updateYoutubeThumbnailPreview);
        document.getElementById('youtube_url').addEventListener('input', () => autofillInfluencerName(false));
        updateYoutubeThumbnailPreview();
        autofillInfluencerName(true);
    </script>
</body>
</html>
