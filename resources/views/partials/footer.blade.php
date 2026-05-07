<footer class="bg-[#26180f] text-[#EFE1D1] pt-16 pb-8 relative overflow-hidden border-t-4 border-red-800 mt-auto">
    <!-- Decorative subtle background blob -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-900/20 rounded-full blur-[80px] pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-900/10 rounded-full blur-[80px] pointer-events-none translate-y-1/3 -translate-x-1/4"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 items-start mb-12">
            
            <!-- Brand Info -->
            <div class="lg:col-span-4 flex flex-col items-center sm:items-start text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 mb-4">
                    <div class="w-24 h-25 sm:w-28 sm:h-26 bg-white rounded-lg p-2 shadow-xl flex items-center justify-center shrink-0 overflow-hidden hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('logo.jpeg') }}" onerror="this.onerror=null;this.src='https://placehold.co/150x150/8B0000/ffffff?text=BBC';" alt="Bakso Bunderan Ciomas" class="w-full h-full object-contain" />
                    </div>
                    <div class="leading-none text-left font-poppins pt-2">
                        <div class="text-xl font-bold tracking-widest text-[#EFE1D1] uppercase">Bakso</div>
                        <div class="text-xl font-bold tracking-widest text-[#EFE1D1] uppercase">Bunderan</div>
                        <div class="text-xl font-bold tracking-widest text-red-600 uppercase">Ciomas</div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="lg:col-span-3 flex flex-col items-center sm:items-start text-center sm:text-left">
                <h4 class="text-white font-bold text-sm tracking-widest uppercase mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    Alamat
                </h4>
                <div class="text-gray-300 text-sm leading-relaxed space-y-1.5">
                    <p>Jl. Vihara Ciomas, Ciomas</p>
                    <p>Rahayu, Kec. Ciomas,</p>
                    <p>Kabupaten Bogor, Jawa Barat</p>
                    <p class="font-bold text-white pt-1">16610</p>
                </div>
            </div>

            <!-- Kontak -->
            <div class="lg:col-span-3 flex flex-col items-center sm:items-start text-center sm:text-left">
                <h4 class="text-white font-bold text-sm tracking-widest uppercase mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    Kontak
                </h4>
                <div class="text-gray-300 text-sm space-y-4">
                    <a href="tel:0852xxxxxxxx" class="flex items-center gap-3 hover:text-white transition-colors group">
                        <i class="fab fa-whatsapp text-xl text-gray-500 group-hover:text-green-500 transition-colors"></i>
                        <span class="font-medium tracking-wide">0852xxxxxxxx</span>
                    </a>
                    <a href="mailto:baksobunderan@gmail.com" class="flex items-start gap-3 hover:text-white transition-colors group">
                        <i class="fas fa-envelope text-xl text-gray-500 group-hover:text-red-500 transition-colors mt-1"></i>
                        <span class="font-medium tracking-wide leading-tight">
                            baksobunderan<br>@gmail.com
                        </span>
                    </a>
                </div>
            </div>

            <!-- Media Sosial -->
            <div class="lg:col-span-2 flex flex-col items-center sm:items-start text-center sm:text-left">
                <h4 class="text-white font-bold text-sm tracking-widest uppercase mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    Sosial
                </h4>
                <div class="flex items-center gap-3">
                    <a href="#" class="w-10 h-10 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-gray-300 hover:bg-gradient-to-tr hover:from-pink-600 hover:to-purple-600 hover:text-white hover:border-transparent hover:-translate-y-1 transition-all duration-300 shadow-lg" aria-label="Instagram">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-gray-300 hover:bg-[#1877F2] hover:text-white hover:border-transparent hover:-translate-y-1 transition-all duration-300 shadow-lg" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-gray-300 hover:bg-black hover:text-white hover:border-transparent hover:-translate-y-1 transition-all duration-300 shadow-lg" aria-label="TikTok">
                        <i class="fab fa-tiktok text-lg"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col items-center justify-center text-center">
            <p class="text-gray-500 text-xs sm:text-sm font-medium tracking-wide">
                &copy; {{ date('Y') }} Bakso Bunderan Ciomas. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</footer>
