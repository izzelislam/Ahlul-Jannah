<!-- SIDEBAR -->
<!-- Mobile: Default hidden (translate-x-full), Desktop: Default visible -->
<aside id="sidebar" class="bg-primary text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-30 flex flex-col h-full">
    
    <!-- Logo -->
    <div class="flex items-center space-x-2 px-4 mb-6">
        <i class="fas fa-cube text-3xl"></i>
        <span class="text-2xl font-extrabold">AhlulJannah</span>
    </div>

    <!-- Menu (Scrollable) -->
    <nav class="flex-1 overflow-y-auto sidebar-scroll px-2 space-y-1">
        <!-- Active Link -->
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 bg-blue-700 text-white">
            <i class="fas fa-home w-6"></i> Dashboard
        </a>

        <!-- Normal Links -->
        <a href="{{ route('admin.users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-users w-6"></i> Pengguna
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-images w-6"></i> Galeri
        </a>
        <a href="{{ route('admin.programs.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.programs.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-list-alt w-6"></i> Program
        </a>

         
        @php
            $isContentActive = request()->routeIs('admin.post-categories.*') || request()->routeIs('admin.posts.*');
        @endphp
        
        <!-- Content Submenu -->
        <div x-data="{ open: {{ $isContentActive ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center {{ $isContentActive ? 'bg-blue-700' : '' }}">
                <span class="flex items-center"><i class="fas fa-newspaper w-6"></i> Content</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1 bg-black/10 rounded-md overflow-hidden">
                <a href="{{ route('admin.post-categories.index') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->routeIs('admin.post-categories.*') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-tags w-4 mr-2"></i> Kategori
                </a>
        
                <a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->routeIs('admin.posts.*') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-pen-nib w-4 mr-2"></i> Post
                </a>
            </div>
        </div>

        <a href="{{ route('admin.structurals.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.structurals.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-sitemap w-6"></i> Struktural
        </a>

        <!-- PPDB Submenu -->
        @php
            $isPpdbActive = request()->routeIs('admin.ppdb.*') || request()->routeIs('admin.students.*') || request()->routeIs('admin.academic-years.*');
        @endphp
        <div x-data="{ open: {{ $isPpdbActive ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center {{ $isPpdbActive ? 'bg-blue-700' : '' }}">
                <span class="flex items-center"><i class="fas fa-user-graduate w-6"></i> PPDB</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1 bg-black/10 rounded-md overflow-hidden">
                <a href="{{ route('admin.pages.edit_by_slug', 'ppdb') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->url() == route('admin.pages.edit_by_slug', 'ppdb') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-file-alt w-4 mr-2"></i> Halaman Pendaftar
                </a>
                <a href="{{ route('admin.students.index') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->routeIs('admin.students.*') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-users w-4 mr-2"></i> Pendaftar
                </a>
                <a href="{{ route('admin.academic-years.index') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->routeIs('admin.academic-years.*') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-calendar-alt w-4 mr-2"></i> Tahun Ajaran
                </a>
            </div>
        </div>

        
        <!-- Submenu Example -->
         <!-- Pages Submenu -->
        <div x-data="{ open: {{ request()->routeIs('admin.pages.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center {{ request()->routeIs('admin.pages.*') ? 'bg-blue-700' : '' }}">
                <span class="flex items-center"><i class="fas fa-file-alt w-6"></i> Pages</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1 bg-black/10 rounded-md overflow-hidden">
                <a href="{{ route('admin.pages.edit_by_slug', 'home') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->url() == route('admin.pages.edit_by_slug', 'home') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-home w-4 mr-2"></i> Home
                </a>
                <a href="{{ route('admin.pages.edit_by_slug', 'profil') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->url() == route('admin.pages.edit_by_slug', 'profil') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-user w-4 mr-2"></i> Profil
                </a>
                <a href="{{ route('admin.pages.edit_by_slug', 'kontak') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->url() == route('admin.pages.edit_by_slug', 'kontak') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-address-book w-4 mr-2"></i> Kontak
                </a>
                <a href="{{ route('admin.pages.index') }}" class="block py-2 px-4 rounded text-sm hover:bg-blue-600 hover:text-white {{ request()->routeIs('admin.pages.index') ? 'bg-blue-600 text-white' : 'text-gray-100' }}">
                     <i class="fas fa-list w-4 mr-2"></i> Semua Halaman
                </a>
            </div>
        </div>
        <!-- <div x-data="{ open: false }">
            <button onclick="toggleSubmenu('submenu1')" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-cog w-6"></i> Pengaturan</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div id="submenu1" class="hidden pl-8 mt-1 space-y-1">
                <a href="#" class="block py-2 px-2 text-sm hover:text-gray-300">Umum</a>
                <a href="#" class="block py-2 px-2 text-sm hover:text-gray-300">Keamanan</a>
                <a href="#" class="block py-2 px-2 text-sm hover:text-gray-300">API Key</a>
            </div>
        </div> -->

        <a href="{{ route('admin.settings') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.settings*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-cog w-6"></i> Pengaturan
        </a>

        <!-- Dummy Menu Items untuk Test Scroll -->
        <!-- <div class="pt-4 pb-2">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Lainnya</p>
        </div>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
            <i class="fas fa-file w-6"></i> Laporan
        </a>
        <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
            <i class="fas fa-bell w-6"></i> Notifikasi
        </a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">
            <i class="fas fa-question-circle w-6"></i> Bantuan
        </a> -->
    </nav>

    <!-- Sidebar Footer -->
    <div class="px-4 py-2 border-t border-blue-700">
        <p class="text-xs text-gray-300">© 2023 AdminPanel</p>
    </div>
</aside>
