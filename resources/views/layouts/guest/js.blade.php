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

        //         // === DYNAMIC ANGGOTA KELUARGA FORM ===
        // function initializeAnggotaForm() {
        //     const container = document.getElementById('anggota-container');
        //     const tambahBtn = document.getElementById('tambah-anggota-btn');

        //     // Cek jika element ada (hanya di halaman keluarga/create)
        //     if (!container || !tambahBtn) return;

        //     let anggotaCount = 0;

        //     tambahBtn.addEventListener('click', function() {
        //         anggotaCount++;

        //         const anggotaDiv = document.createElement('div');
        //         anggotaDiv.className = 'anggota-field mb-3 p-3 border rounded';
        //         anggotaDiv.innerHTML = `
        //             <div class="row">
        //                 <div class="col-md-6">
        //                     <label class="form-label">Pilih Anggota Keluarga</label>
        //                     <select name="anggota[${anggotaCount}][warga_id]" class="form-control search-box" required>
        //                         <option value="">-- Pilih Anggota --</option>
        //                         <!-- Data akan diisi manual oleh user -->
        //                     </select>
        //                     <small class="text-muted">Pilih dari daftar warga yang sudah terdaftar</small>
        //                 </div>
        //                 <div class="col-md-4">
        //                     <label class="form-label">Hubungan</label>
        //                     <input type="text" name="anggota[${anggotaCount}][hubungan]" class="form-control search-box"
        //                            placeholder="Contoh: Istri, Anak, Cucu" required>
        //                 </div>
        //                 <div class="col-md-2 d-flex align-items-end">
        //                     <button type="button" class="btn btn-outline-danger btn-sm hapus-anggota">
        //                         <i class="fas fa-trash"></i>
        //                     </button>
        //                 </div>
        //             </div>
        //         `;

        //         container.appendChild(anggotaDiv);

        //         // Event listener untuk hapus button
        //         anggotaDiv.querySelector('.hapus-anggota').addEventListener('click', function() {
        //             anggotaDiv.remove();
        //         });
        //     });
        // }

        // // Initialize dynamic anggota form
        // initializeAnggotaForm();

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
