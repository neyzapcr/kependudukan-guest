<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Navbar JS loaded');

        // Mobile menu toggle - PERBAIKAN DI SINI
        const menuTrigger = document.querySelector('.menu-trigger');
        const navMenu = document.querySelector('.main-nav ul.nav');

        if (menuTrigger && navMenu) {
            menuTrigger.addEventListener('click', function() {
                // PERBAIKAN: ganti 'active' jadi 'show'
                navMenu.classList.toggle('show');
                // Juga toggle class active untuk hamburger icon
                this.classList.toggle('active');
                console.log('Mobile menu toggled');
            });
        }

        // === DROPDOWN TOGGLE ===
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(function(dropdownToggle) {
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const dropdownMenu = this.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        if (menu !== dropdownMenu) {
                            menu.classList.remove('show');
                        }
                    });

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

        // === LOGOUT FUNCTION ===
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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const menuTrigger = document.querySelector(".menu-trigger");
    const nav = document.querySelector(".main-nav .nav");

    if (menuTrigger) {
        menuTrigger.addEventListener("click", function () {
            menuTrigger.classList.toggle("active");
            nav.classList.toggle("show");
        });
    }
});
<script>
document.addEventListener("DOMContentLoaded", function () {
    const menu = document.querySelector(".main-nav .nav");
    const trigger = document.querySelector(".menu-trigger");

    trigger.addEventListener("click", function () {
        trigger.classList.toggle("active");
        menu.classList.toggle("show");
    });
});
</script>


</script>
