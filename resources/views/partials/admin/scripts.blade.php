<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
    // --- 1. Sidebar Logic ---
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        // Toggle kelas translate untuk menampilkan/menyembunyikan sidebar di mobile
        sidebar.classList.toggle('-translate-x-full');
        // Toggle overlay
        sidebarOverlay.classList.toggle('hidden');
    }

    if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

    // --- 2. Dropdown Logic (Avatar) ---
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    if (profileButton) {
        profileButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah event click tembus ke document
            profileDropdown.classList.toggle('hidden');
        });
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', (e) => {
        if (profileButton && profileDropdown && !profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }
    });

    // --- 3. Submenu Logic ---
    function toggleSubmenu(id) {
        const submenu = document.getElementById(id);
        if (submenu) submenu.classList.toggle('hidden');
        
        // Rotasi icon panah (opsional, butuh selektor icon spesifik)
        // const icon = event.currentTarget.querySelector('.fa-chevron-down');
        // icon.classList.toggle('rotate-180');
    }

    // --- 4. Modal Logic ---
    const modal = document.getElementById('myModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const modalBackdrop = document.getElementById('modalBackdrop');

    function toggleModal(show) {
        if (!modal) return;
        if(show) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    if (openModalBtn) openModalBtn.addEventListener('click', () => toggleModal(true));
    if (closeModalBtn) closeModalBtn.addEventListener('click', () => toggleModal(false));
    if (confirmDeleteBtn) confirmDeleteBtn.addEventListener('click', () => {
        alert('Data dihapus!');
        toggleModal(false);
    });
    
    // Tutup modal jika klik di area gelap (backdrop)
    if (modalBackdrop) modalBackdrop.addEventListener('click', () => toggleModal(false));

</script>
