
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // === CONFIRM DELETE ACTIONS ===
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                let itemName = '';
                const card = this.closest('.anggota-card, .keluarga-card, .warga-card');
                const tableRow = this.closest('tr');

                if (card) {
                    // Handle card view
                    if (card.classList.contains('anggota-card')) {
                        itemName = card.querySelector('.anggota-name')?.textContent || 'anggota ini';
                    } else if (card.classList.contains('keluarga-card')) {
                        itemName = card.querySelector('.keluarga-nomor')?.textContent || 'keluarga ini';
                    } else if (card.classList.contains('warga-card')) {
                        itemName = card.querySelector('.warga-name')?.textContent || 'warga ini';
                    }
                } else if (tableRow) {
                    // Handle table view
                    itemName = tableRow.querySelector('td:first-child')?.textContent || 'data ini';
                }

                let message = `Apakah Anda yakin ingin menghapus ${itemName}?`;

                if (!confirm(message)) {
                    e.preventDefault();
                }
            });
        });

        // === SEARCH FUNCTIONALITY ===
        function initializeSearch(formSelector) {
            const searchForm = document.querySelector(formSelector);
            if (searchForm) {
                const searchInput = searchForm.querySelector('input[name="search"]');
                const clearSearch = document.querySelector('.btn-clear-search');

                // Clear search functionality
                if (clearSearch) {
                    clearSearch.addEventListener('click', function() {
                        if (searchInput) {
                            searchInput.value = '';
                            searchForm.submit();
                        }
                    });
                }

                // Optional: Real-time search with debounce
                if (searchInput) {
                    searchInput.addEventListener('input', debounce(function() {
                        // Uncomment below line to enable real-time search
                        // searchForm.submit();
                    }, 500));
                }
            }
        }

        // Initialize search for different modules
        initializeSearch('form[action*="anggota"]');
        initializeSearch('form[action*="keluarga"]');
        initializeSearch('form[action*="warga"]');
        initializeSearch('form[action="{{ route("warga.index") }}"]');

        // === UTILITY FUNCTIONS ===
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

        // === FORM VALIDATION ENHANCEMENT ===
        const forms = document.querySelectorAll('form[method="post"]');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                }
            });
        });

        // === MODAL ENHANCEMENT ===
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                const input = this.querySelector('input[autofocus]');
                if (input) {
                    input.focus();
                }
            });
        });

        // === RESPONSIVE TABLE ENHANCEMENT ===
        const tables = document.querySelectorAll('.table-responsive table');
        tables.forEach(table => {
            const headers = table.querySelectorAll('thead th');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index].textContent);
                    }
                });
            });
        });
    });

    // === GLOBAL FUNCTIONS ===
    function showLoading() {
        const loader = document.createElement('div');
        loader.className = 'loading-overlay';
        loader.innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `;
        document.body.appendChild(loader);
    }

    function hideLoading() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.remove();
        }
    }

    // Utility function to format dates
    function formatDate(dateString) {
        if (!dateString) return '-';
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    // Utility function to format numbers (NIK, KK, etc.)
    function formatNumber(number) {
        if (!number) return '-';
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>

<style>
    /* Additional styles for JavaScript enhancements */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    @media (max-width: 768px) {
        .table-responsive table td::before {
            content: attr(data-label) ": ";
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        .table-responsive table td {
            display: block;
            text-align: left;
            border: none;
            border-bottom: 1px solid #eee;
        }
    }
</style>
