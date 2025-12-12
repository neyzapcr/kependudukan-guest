<script>
    // === ALL JAVASCRIPT FUNCTIONALITY ===
    document.addEventListener('DOMContentLoaded', function() {
        console.log('All JS loaded');

        // === NAVBAR & DROPDOWN FUNCTIONALITY ===
        const menuTrigger = document.querySelector('.menu-trigger');
        const navMenu = document.querySelector('.main-nav ul.nav');

        if (menuTrigger && navMenu) {
            menuTrigger.addEventListener('click', function() {
                navMenu.classList.toggle('active');
            });
        }

        // Dropdown toggle
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
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                menu.classList.remove('show');
            });
        });

        // Logout confirmation
        const logoutButtons = document.querySelectorAll('.logout-btn');
        logoutButtons.forEach(function(logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        });

        // === AUTO CLOSE ALERTS ===
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });

        // === SEARCH FUNCTIONALITY ===
        function initializeSearch(formSelector) {
            const searchForm = document.querySelector(formSelector);
            if (searchForm) {
                const searchInput = searchForm.querySelector('input[name="search"]');
                const clearSearch = document.querySelector('.btn-clear-search');

                if (clearSearch) {
                    clearSearch.addEventListener('click', function() {
                        if (searchInput) {
                            searchInput.value = '';
                            searchForm.submit();
                        }
                    });
                }

                if (searchInput) {
                    searchInput.addEventListener('input', debounce(function() {
                        // searchForm.submit();
                    }, 500));
                }
            }
        }

        // Initialize search for common modules
        initializeSearch('form[action*="anggota"]');
        initializeSearch('form[action*="keluarga"]');
        initializeSearch('form[action*="warga"]');

        console.log('JavaScript initialized successfully');
    });

    // === UTILITY FUNCTIONS ===
    function showLoading(message = 'Memproses...') {
        const loader = document.createElement('div');
        loader.className = 'loading-overlay';
        loader.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-2 text-primary">${message}</div>
    `;
        document.body.appendChild(loader);
    }

    function hideLoading() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.remove();
        }
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function formatNumber(number) {
        if (!number) return '-';
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // === FUNGSI HAPUS DOKUMEN (untuk kelahiran & kematian) ===
    // dipasang di window supaya bisa dipanggil dari onclick="hapusDokumen(id)"
    window.hapusDokumen = function(mediaId) {
        if (confirm('Hapus dokumen ini?')) {
            const form = document.getElementById('hapusDokumen' + mediaId);
            if (form) {
                form.submit();
            } else {
                console.error('Form hapus dokumen dengan ID', mediaId, 'tidak ditemukan');
            }
        }
    };
</script>
