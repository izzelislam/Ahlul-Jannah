<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.admin.head')
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        @include('partials.admin.sidebar')

        <!-- CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- TOP BAR (Fixed) -->
            @include('partials.admin.topbar')

            <!-- MAIN CONTENT (Scrollable) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay untuk Mobile Sidebar (Saat dibuka) -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black opacity-50 z-20 md:hidden"></div>

    <!-- Modal Component -->
    {{-- @include('partials.admin.modal') --}}
    @yield('modals')

    <!-- Toast Notifications -->
    <x-ui.toast />

    <!-- JAVASCRIPT LOGIC -->
    @include('partials.admin.scripts')
    @stack('scripts')
</body>
</html>
