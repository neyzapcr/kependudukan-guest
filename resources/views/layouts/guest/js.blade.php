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

        // === DELETE BUTTONS FUNCTIONALITY ===
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function(deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Cari data dari card/table
                const card = this.closest('.warga-card, .keluarga-card, .anggota-card');
                let itemName = '';
                let itemIdentifier = '';
                let deleteUrl = '';

                if (card) {
                    // Untuk card view
                    if (card.classList.contains('warga-card')) {
                        itemName = card.querySelector('.warga-name')?.textContent ||
                        'warga ini';
                        itemIdentifier = card.querySelector('.warga-nik')?.textContent || '';
                        const wargaId = this.getAttribute('data-id') || this.closest(
                            '[data-id]')?.getAttribute('data-id');
                        deleteUrl = `{{ url('warga') }}/${wargaId}`;
                    } else if (card.classList.contains('keluarga-card')) {
                        itemName = card.querySelector('.keluarga-name')?.textContent ||
                            'keluarga ini';
                        itemIdentifier = card.querySelector('.keluarga-nomor')?.textContent ||
                            '';
                        const keluargaId = this.getAttribute('data-id') || this.closest(
                            '[data-id]')?.getAttribute('data-id');
                        deleteUrl = `{{ url('keluarga') }}/${keluargaId}`;
                    } else if (card.classList.contains('anggota-card')) {
                        itemName = card.querySelector('.anggota-name')?.textContent ||
                            'anggota ini';
                        itemIdentifier = card.querySelector('.anggota-kk')?.textContent || '';
                        const anggotaId = card.getAttribute('data-id');
                        deleteUrl = `{{ url('anggota') }}/${anggotaId}`;
                    }

                }

                const confirmation = confirm(
                    `Apakah Anda yakin ingin menghapus:\n\n${itemName}\n${itemIdentifier}\n\nData yang dihapus tidak dapat dikembalikan!`
                    );

                if (confirmation && deleteUrl) {
                    showLoading();

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                    // CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Method spoofing
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
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
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function formatNumber(number) {
        if (!number) return '-';
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>

<style>
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        font-family: 'Poppins', sans-serif;
    }
</style>

