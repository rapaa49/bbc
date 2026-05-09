@if(isset($menus) && $menus->count() > 0)
    @foreach($menus as $menu)
    @php
        $isPaket = isset($menu->portion);
        $category = $isPaket ? 'paket' : $menu->category;
        $isRecommended = !$isPaket && $menu->is_recommended;
    @endphp
    <div class="menu-item">
        <div class="menu-card">
            <div class="menu-card-img">
                <img src="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/400x400/fdf5e6/3a2a1a?text=' . urlencode($menu->name) }}"
                     alt="{{ $menu->name }}" loading="lazy">
                
                @if($isRecommended)
                <span class="menu-badge reko"><i class="fas fa-star"></i></span>
                @endif
            </div>
            
            <div class="menu-card-body">
                <div class="flex justify-between items-start mb-1">
                    <span class="text-[9px] font-black uppercase tracking-widest text-red-600">{{ $category }}</span>
                    @if($isPaket)
                    <span class="text-[9px] font-bold text-gray-400 uppercase"><i class="fas fa-users mr-1"></i>{{ $menu->portion }} Porsi</span>
                    @endif
                </div>
                
                <h4 class="menu-card-title">{{ $menu->name }}</h4>
                
                @if($isPaket && $menu->description)
                <div class="menu-card-desc" style="white-space: normal; line-clamp: none; -webkit-line-clamp: unset; height: auto; overflow: visible; display: block; margin-bottom: 12px;">
                    <ul style="list-style-type: disc; padding-left: 1.2rem; margin: 0; text-align: left; display: flex; flex-direction: column; gap: 2px;">
                        @foreach(explode("\n", trim($menu->description)) as $line)
                            @if(trim($line) !== '')
                                <li style="word-break: break-word; overflow-wrap: break-word; font-size: 11px;">{{ trim(preg_replace('/^[-*\s]+/', '', $line)) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @else
                <p class="menu-card-desc" style="word-break: break-word; overflow-wrap: break-word; white-space: normal;">
                    {{ Str::limit($menu->description ?: 'Nikmati sajian lezat dengan racikan bumbu khas Bunderan Ciomas yang autentik dan menggugah selera.', 120) }}
                </p>
                @endif
                
                <div class="menu-card-footer">
                    <div class="menu-card-price">Rp {{ number_format((float) $menu->price, 0, ',', '.') }}</div>
                    <span class="menu-card-outlet"><i class="fas fa-store"></i> Outlet</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="col-span-full text-center py-20">
        <i class="fas fa-utensils text-4xl text-red-200 mb-4"></i>
        <h4 style="font-size:1.5rem;font-weight:800;color:#1a1a1a;margin-bottom:8px;">Menu Belum Tersedia</h4>
        <p style="color:#888;font-size:15px;">Kami sedang menyiapkan sajian spesial untuk Anda.</p>
    </div>
@endif
