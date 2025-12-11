    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <!-- Logo or Brand -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="leading-tight">
                            <h1 class="text-lg font-bold text-slate-900">AHLUL JANNAH</h1>
                            <p class="text-xs text-primary-600 font-medium tracking-wider">Pesantren Tahfidz</p>
                        </div>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    @if(\App\Models\Setting::isMenuEnabled('menu_home'))
                        <a href="{{ route('home') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">Home</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_profil'))
                        <a href="{{ route('landing.profil') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.profil') ? 'text-primary-600' : '' }}">Profil</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_program'))
                        <a href="{{ route('landing.program') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.program') ? 'text-primary-600' : '' }}">Program</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_ppdb'))
                        <a href="{{ route('landing.pendaftaran') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.pendaftaran') ? 'text-primary-600' : '' }}">PPDB</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_galeri'))
                        <a href="{{ route('landing.galeri') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.galeri') ? 'text-primary-600' : '' }}">Galeri</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_blog'))
                        <a href="{{ route('landing.blog') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.blog*') ? 'text-primary-600' : '' }}">Blog</a>
                    @endif
                    @if(\App\Models\Setting::isMenuEnabled('menu_kontak'))
                        <a href="{{ route('landing.kontak') }}" class="text-slate-600 hover:text-primary-600 font-medium transition {{ request()->routeIs('landing.kontak') ? 'text-primary-600' : '' }}">Kontak</a>
                    @endif
                </div>
                <div class="hidden md:flex">
                    <a href="{{ route('landing.pendaftaran') }}" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-full shadow-lg shadow-primary-600/30 transition transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </a>
                </div>
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-slate-600 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
                @if(\App\Models\Setting::isMenuEnabled('menu_home'))
                    <a href="{{ route('home') }}" class="block text-slate-600 hover:text-primary-600 py-2">Home</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_profil'))
                    <a href="{{ route('landing.profil') }}" class="block text-slate-600 hover:text-primary-600 py-2">Profil</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_program'))
                    <a href="{{ route('landing.program') }}" class="block text-slate-600 hover:text-primary-600 py-2">Program</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_ppdb'))
                    <a href="{{ route('landing.pendaftaran') }}" class="block text-slate-600 hover:text-primary-600 py-2">PPDB</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_galeri'))
                    <a href="{{ route('landing.galeri') }}" class="block text-slate-600 hover:text-primary-600 py-2">Galeri</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_blog'))
                    <a href="{{ route('landing.blog') }}" class="block text-slate-600 hover:text-primary-600 py-2">Blog</a>
                @endif
                @if(\App\Models\Setting::isMenuEnabled('menu_kontak'))
                    <a href="{{ route('landing.kontak') }}" class="block text-slate-600 hover:text-primary-600 py-2">Kontak</a>
                @endif
                <a href="{{ route('landing.pendaftaran') }}" class="block px-6 py-2.5 bg-primary-600 text-white text-center rounded-full mt-2">Daftar Sekarang</a>
            </div>
        </div>
    </nav>
