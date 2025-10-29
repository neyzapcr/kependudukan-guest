<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const menuTrigger = document.querySelector('.menu-trigger');
        const navMenu = document.querySelector('.main-nav ul.nav');

        if (menuTrigger && navMenu) {
            menuTrigger.addEventListener('click', function() {
                navMenu.classList.toggle('active');
            });
        }

        // Dropdown toggle
        const dropdownToggle = document.getElementById('userDropdown');
        const dropdownMenu = document.getElementById('userDropdownMenu');

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                dropdownMenu.classList.remove('show');
            });
        }

        // Logout function
        const logoutBtn = document.getElementById('logout-btn');
        const logoutForm = document.getElementById('logout-form');

        if (logoutBtn && logoutForm) {
            logoutBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin logout?')) {
                    logoutForm.submit();
                }
            });
        }
    });
</script>
