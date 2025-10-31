<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Navbar JS loaded');

        // Mobile menu toggle
        const menuTrigger = document.querySelector('.menu-trigger');
        const navMenu = document.querySelector('.main-nav ul.nav');

        if (menuTrigger && navMenu) {
            menuTrigger.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                console.log('Mobile menu toggled');
            });
        }

        // === DROPDOWN TOGGLE (YANG BENAR) ===
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(function(dropdownToggle) {
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Cari dropdown menu yang sesuai
                const dropdownMenu = this.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    // Tutup dropdown lain yang terbuka
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        if (menu !== dropdownMenu) {
                            menu.classList.remove('show');
                        }
                    });

                    // Buka/tutup dropdown ini
                    dropdownMenu.classList.toggle('show');
                    console.log('Dropdown toggled');
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                menu.classList.remove('show');
            });
        });

        // === LOGOUT FUNCTION (YANG BENAR) ===
        const logoutButtons = document.querySelectorAll('.logout-btn');

        logoutButtons.forEach(function(logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        });

        console.log('Dropdown toggles found:', dropdownToggles.length);
        console.log('Logout buttons found:', logoutButtons.length);
    });
</script>

