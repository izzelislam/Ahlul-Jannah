<!-- TOP BAR (Fixed) -->
<header class="bg-white shadow-sm z-20 flex justify-between items-center p-4 h-16" x-data="{ showLogoutModal: false }">
    <div class="flex items-center">
        <!-- Mobile Menu Button -->
        <button id="sidebarToggle" class="text-gray-500 focus:outline-none md:hidden mr-4">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Right Side (Avatar & Dropdown) -->
    <div class="flex items-center space-x-4">
        <button class="text-gray-500 hover:text-gray-700 relative">
            <i class="fas fa-bell text-xl"></i>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">3</span>
        </button>

        <!-- Profile Dropdown Wrapper -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center focus:outline-none group">
                @if(Auth::user()->avatar)
                    <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 group-hover:border-primary-400 transition" src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar">
                @else
                    <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 group-hover:border-primary-400 transition" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="Avatar">
                @endif
                <span class="ml-2 text-sm font-medium text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down ml-1 text-xs text-gray-500 hidden md:block transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 z-50 ring-1 ring-black ring-opacity-5 border border-slate-100">
                
                <!-- User Info -->
                <div class="px-4 py-3 border-b border-slate-100">
                    <p class="text-xs text-slate-500">Masuk sebagai</p>
                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                </div>
                
                <!-- Menu Items -->
                <div class="py-1">
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                        <i class="fas fa-user-circle text-slate-400 w-5"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                        <i class="fas fa-cog text-slate-400 w-5"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
                
                <!-- Logout Button (triggers modal) -->
                <div class="border-t border-slate-100 pt-1">
                    <button @click="open = false; $dispatch('open-logout-modal')" type="button" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" 
         @open-logout-modal.window="showLogoutModal = true"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showLogoutModal = false"></div>
        
        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="showLogoutModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full p-6 text-center">
                
                <!-- Icon -->
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-sign-out-alt text-3xl text-red-600"></i>
                </div>
                
                <!-- Title -->
                <h3 class="text-xl font-bold text-slate-900 mb-2">Keluar dari Akun?</h3>
                <p class="text-slate-500 mb-6">Apakah Anda yakin ingin keluar dari dashboard admin?</p>
                
                <!-- Buttons -->
                <div class="flex gap-3">
                    <button @click="showLogoutModal = false" type="button" class="flex-1 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg transition">
                        Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                            Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
