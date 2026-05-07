@if(isset($menus) && $menus->count() > 0)
         @foreach($menus as $menu)
         <article class="menu-item group h-full flex flex-col relative overflow-hidden rounded-[1.5rem] bg-white shadow-[0_4px_20px_rgba(0,0,0,0.06)] transition-all duration-500 hover:shadow-[0_12px_30px_rgba(139,0,0,0.12)] border border-transparent hover:border-red-100 hover:-translate-y-2">
             <!-- Image Container -->
             <div class="relative w-full pt-[75%] overflow-hidden bg-gray-50">
                 <img src="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/400x300/fdf5e6/3a2a1a?text=Menu' }}"
                      alt="{{ $menu->name }}"
                      class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105">
                 
                 <!-- Subtle top overlay just for the badge -->
                 <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-transparent opacity-60"></div>

                 <!-- Category Badge -->
                 <div class="absolute top-4 left-4 z-10">
                     <span class="inline-block rounded-lg bg-orange-500/90 backdrop-blur text-white px-3 py-1 text-[11px] font-bold uppercase tracking-widest shadow-sm">
                         {{ ucfirst($menu->category) }}
                     </span>
                 </div>
             </div>

             <!-- Content Area -->
             <div class="flex-1 flex flex-col p-5 sm:p-6 bg-white z-10 relative">
                 <!-- Price Tag -> moved out of image for cleanliness -->
                 <div class="flex justify-between items-start mb-2">
                     <h4 class="text-xl font-bold text-[#2a1a10] leading-tight group-hover:text-red-800 transition-colors line-clamp-2 pr-2">
                         {{ $menu->name }}
                     </h4>
                     <span class="text-lg font-bold text-red-700 whitespace-nowrap">
                         Rp {{ number_format((float) $menu->price, 0, ',', '.') }}
                     </span>
                 </div>

                 <!-- Divider -->
                 <div class="w-10 h-1 bg-red-600 rounded-full mb-3 origin-left transform transition-transform duration-300 group-hover:scale-x-150"></div>

                 <p class="text-sm leading-relaxed text-gray-500 mb-6 line-clamp-2">
                     {{ $menu->description ?: 'Pilihan menu terbaik dengan racikan bumbu khas cita rasa bunderan ciomas yang lezat dan otentik.' }}
                 </p>

                 <!-- Action Button Removed since Menus are only for showcase / dine-in -->
                 <div class="mt-auto">
                     <span class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-orange-200 bg-orange-50 px-5 py-2.5 text-sm font-bold text-orange-800">
                         <i class="fas fa-store"></i>
                         Tersedia di Outlet
                     </span>
                 </div>
             </div>
         </article>
         @endforeach
     @else
         <div class="col-span-full text-center text-gray-700">
             <div class="bg-[#F9EDDE] rounded-2xl p-10 shadow">
                 <h4 class="text-2xl font-bold mb-2">Menu belum tersedia</h4>
                 <p class="text-sm">Silakan tambahkan data menu dari halaman admin.</p>
         </div>
     </div>
 @endif
