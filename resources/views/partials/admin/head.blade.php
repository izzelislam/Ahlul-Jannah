<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Dashboard Template')</title>

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Konfigurasi Custom Warna (Opsional) -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#1e40af', // Warna Primary (Blue-800)
                    secondary: '#64748b',
                }
            }
        }
    }
</script>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<!-- Font Awesome untuk Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@stack('styles')

<style>
    /* Custom Scrollbar untuk Sidebar agar terlihat rapi */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .sidebar-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .sidebar-scroll::-webkit-scrollbar-track {
        background: #1e3a8a; 
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background-color: #60a5fa; 
        border-radius: 20px;
    }
</style>
