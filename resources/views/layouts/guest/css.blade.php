<style>
/* ==============================
   GLOBAL / AUTH PAGE FIXES
   ============================== */
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Target teks "SISTEM KEPENDUDUKAN" */
h1,
.page-title,
.dashboard-title {
    color: #1e40af !important;
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

body.auth-page,
body:has(.login-horizontal-card) {
    min-height: 100%;
    background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    overflow-x: hidden;
}

/* Background bubbles effect */
body.auth-page::before,
body:has(.login-horizontal-card)::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
    z-index: 1;
    pointer-events: none;
}

body.auth-page::after,
body:has(.login-horizontal-card)::after {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:
        radial-gradient(circle at 60% 30%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
    z-index: 1;
    pointer-events: none;
}

/* Pastikan konten login penuh layar */
body.auth-page main,
body:has(.login-horizontal-card) main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    margin: 0;
    position: relative;
    z-index: 2;
}

/* ==============================
   MAIN BANNER
   ============================== */
.main-banner {
    background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
}

.main-banner .item {
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    border-radius: 25px;
    padding: 80px 90px !important;
    margin: 0 auto !important;
    max-width: 90%;
}

.main-banner .item h2 {
    font-size: 36px !important;
    font-weight: 700;
    color: #fff;
    line-height: 50px !important;
    width: 80% !important;
    margin-bottom: 40px !important;
}

.main-banner .item p {
    color: #fff;
    width: 80% !important;
    font-size: 17px;
}

.main-banner .item span.category {
    background-color: #3b82f6;
    color: #fff;
    font-size: 12px !important;
    text-transform: uppercase;
    padding: 4px 12px !important;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 40px !important;
}

.main-banner .item .buttons {
    display: flex;
    margin-top: 30px !important;
}

/* ==============================
   GLOBAL STYLES
   ============================== */
.main-content {
    margin-top: 100px;
    padding: 40px 0;
}

.page-header {
    margin-bottom: 30px;
    text-align: center;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #1e40af;
    margin-bottom: 10px;
    letter-spacing: -0.5px;
}

.page-subtitle {
    color: #4a5568;
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ==============================
   LOGIN CARD STYLES
   ============================== */
.login-horizontal-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
    display: flex;
    width: 800px !important;
    max-width: 85% !important;
    min-height: 450px !important;
    overflow: hidden;
    position: relative;
    z-index: 10;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top: 80px !important;
    margin-bottom: 40px !important;
}

.login-horizontal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 80px rgba(59, 130, 246, 0.2);
}

.login-left-section {
    flex: 1;
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    padding: 40px 35px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.login-left-section .login-welcome h2,
.login-left-section .login-welcome p,
.login-left-section .login-welcome small {
    color: #ffffff !important;
    opacity: 0.9 !important;
}

.login-left-section,
.login-left-section * {
    color: #ffffff !important;
}

.login-left-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    transform: rotate(30deg);
}

.login-right-section {
    flex: 1.2;
    padding: 40px 35px !important;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #fff;
}

.login-welcome {
    text-align: center;
    position: relative;
    z-index: 2;
}

.login-avatar {
    width: 80px !important;
    height: 80px !important;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px !important;
    margin: 0 auto 20px auto !important;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.3s ease;
}

.login-avatar:hover {
    transform: scale(1.05);
}

.login-welcome h2 {
    font-size: 24px !important;
    font-weight: 600;
    margin-bottom: 8px !important;
}

.login-welcome p {
    font-size: 14px !important;
    opacity: 0.9;
    margin-bottom: 6px !important;
    line-height: 1.5;
}

.login-welcome small {
    opacity: 0.7;
    font-size: 0.8rem !important;
}

.login-form-horizontal {
    width: 100%;
}

/* Alerts */
.alert-danger,
.invalid-feedback,
.is-invalid {
    background: linear-gradient(135deg, #fef2f2, #fee2e2) !important;
    border: 2px solid #fecaca !important;
    color: #dc2626 !important;
    padding: 16px 20px !important;
    border-radius: 12px !important;
    margin-bottom: 25px !important;
    font-weight: 500 !important;
    text-align: center !important;
}

.alert-success,
.is-valid {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7) !important;
    border: 2px solid #bbf7d0 !important;
    color: #166534 !important;
    padding: 16px 20px !important;
    border-radius: 12px !important;
    margin-bottom: 25px !important;
    font-weight: 500 !important;
    text-align: center !important;
}

/* ==============================
   WHATSAPP FLOAT BUTTON
   ============================== */
.wa-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

.wa-float {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #25d366;
    border-radius: 30px;
    padding: 8px 12px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.wa-float img {
    width: 25px;
    height: 25px;
}

.wa-text {
    color: white;
    font-weight: 500;
    font-size: 14px;
    opacity: 0;
    width: 0;
    overflow: hidden;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.wa-float:hover {
    transform: scale(1.05);
    padding-right: 18px;
}

.wa-float:hover .wa-text {
    opacity: 1;
    width: 100px;
}

/* Pulse animation */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
    100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
}

/* ==============================
   FORM STYLES
   ============================== */
.form-group-horizontal {
    margin-bottom: 20px !important;
    position: relative;
}

.form-group-horizontal label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
    font-size: 14px;
}

.form-group-horizontal input {
    width: 100%;
    padding: 12px 14px !important;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px !important;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-group-horizontal input:focus {
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
    transform: translateY(-2px);
}

.password-hint {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 6px;
    font-style: italic;
}

/* ==============================
   CARD STYLES (anggota, keluarga, warga)
   ============================== */
.anggota-card,
    .keluarga-card,
    .warga-card {
        /* Tetap sama dengan CSS asli */
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 25px;
        overflow: hidden;
        border: none;
    }

    .anggota-card:hover,
    .keluarga-card:hover,
    .warga-card:hover {
        /* Tetap sama dengan CSS asli */
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
    }

    /* === CARD HEADER STYLES (TIDAK DIUBAH) === */
    .anggota-card-header,
    .keluarga-card-header,
    .warga-card-header {
        /* Tetap sama dengan CSS asli */
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
    }

    .anggota-avatar,
    .keluarga-avatar,
    .warga-avatar {
        /* Tetap sama dengan CSS asli */
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 600;
        margin-right: 15px;
    }

    .anggota-info,
    .keluarga-info,
    .warga-info {
        /* Tetap sama dengan CSS asli */
        flex-grow: 1;
    }

    .anggota-name,
    .keluarga-name,
    .warga-name {
        /* Tetap sama dengan CSS asli */
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .anggota-kk,
    .keluarga-nomor,
    .warga-nik {
        /* Tetap sama dengan CSS asli */
        font-size: 14px;
        opacity: 0.9;
    }

    /* === CARD BODY STYLES (TIDAK DIUBAH) === */
    .anggota-card-body,
    .keluarga-card-body,
    .warga-card-body {
        /* Tetap sama dengan CSS asli */
        padding: 20px;
    }

    .info-row {
        /* Tetap sama dengan CSS asli */
        display: flex;
        margin-bottom: 12px;
        align-items: flex-start;
    }

    .info-label {
        /* Tetap sama dengan CSS asli */
        width: 140px;
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
    }

    .info-value {
        /* Tetap sama dengan CSS asli */
        flex-grow: 1;
        color: #2d3748;
        font-size: 14px;
    }

    /* === GENDER STYLES (TIDAK DIUBAH) === */
    .gender-male {
        /* Tetap sama dengan CSS asli */
        color: #2563eb;
        font-weight: 500;
    }

    .gender-female {
        /* Tetap sama dengan CSS asli */
        color: #cf1dd8;
        font-weight: 500;
    }

    /* === CARD FOOTER STYLES (TIDAK DIUBAH) === */
    .anggota-card-footer,
    .keluarga-card-footer,
    .warga-card-footer {
        /* Tetap sama dengan CSS asli */
        padding: 15px 20px;
        background: #f7fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* === ACTION BUTTONS === */
    .action-buttons {
        display: flex;
        gap: 12px;
    }

    .btn-edit {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-delete {
        background: transparent;
        border: 2px solid #ef4444;
        color: #ef4444;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* === SEARCH & ADD BUTTONS === */
    .search-container {
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .search-box {
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        padding: 12px 20px;
        font-size: 15px;
        width: 100%;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .search-box:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .btn-search {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-add {
        background: linear-gradient(135deg, #10b981, #34d399);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #059669, #10b981);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* === EMPTY STATE === */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #6b7280;
        background: #fafafa;
        border-radius: 16px;
        margin: 20px 0;
    }

    .empty-state i {
        font-size: 80px;
        margin-bottom: 25px;
        opacity: 0.4;
        color: #9ca3af;
    }

    .empty-state h4 {
        margin-bottom: 12px;
        font-weight: 600;
        color: #4b5563;
        font-size: 20px;
    }

    .empty-state p {
        color: #6b7280;
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* === TABLE STYLES === */
    .table-container {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.08);
        overflow: hidden;
        margin-bottom: 30px;
        border: 1px solid #f1f5f9;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border: none;
        padding: 18px 20px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .table thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 1px;
        background: rgba(255, 255, 255, 0.3);
    }

    .table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-color: #f1f5f9;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.01);
    }

    /* === PAGINATION === */
    .pagination-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        gap: 8px;
    }

    .pagination .page-link {
        color: #1e40af;
        border: 2px solid #e2e8f0;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-color: #1e40af;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    /* === RESPONSIVE DESIGN === */
    @media (max-width: 768px) {
        .login-horizontal-card {
            flex-direction: column;
            width: 95%;
            min-height: auto;
            margin-top: 40px !important;
        }

        .login-left-section,
        .login-right-section {
            padding: 40px 30px;
        }

        .login-left-section {
            padding: 40px 30px 30px;
        }

        /* Responsive untuk card (tetap sama) */
        .anggota-card-header,
        .keluarga-card-header,
        .warga-card-header {
            flex-direction: column;
            text-align: center;
        }

        .anggota-avatar,
        .keluarga-avatar,
        .warga-avatar {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .anggota-card-footer,
        .keluarga-card-footer,
        .warga-card-footer {
            flex-direction: column;
            gap: 10px;
        }

        .action-buttons {
            width: 100%;
            justify-content: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-label {
            width: 100%;
            margin-bottom: 5px;
        }

        .search-container {
            flex-direction: column;
            gap: 12px;
        }

        .btn-search,
        .btn-add {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .main-content {
            margin-top: 80px;
            padding: 20px 0;
        }

        .page-title {
            font-size: 26px;
        }

        .login-left-section,
        .login-right-section {
            padding: 30px 20px;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-edit,
        .btn-delete {
            width: 100%;
            justify-content: center;
        }
    }

    /* Additional utility classes */
    .text-gradient {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .card-shadow {
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.12);
    }

    .btn-shadow {
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }

/* ==============================
   ABOUT / PAGE LAYOUT STYLES
   ============================== */
.about-row {
    display: flex;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.about-image-wrapper {
    flex: 1;
    min-width: 300px;
}

.about-image {
    width: 100%;
    max-width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    opacity: 0;
    animation: fadeIn 1s ease-in-out 0.3s forwards;
}

.about-text {
    flex: 1;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    opacity: 0;
    transform: translateX(30px);
    animation: slideIn 0.8s ease-out 0.6s forwards;
}

.page-teks {
    color: #4a5568;
    font-size: 16px;
    line-height: 1.15;
    padding: 0px 0px 10px 0px;
    margin-bottom: 10px;
}

.about-content {
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    padding: 30px 20px;
    background: white;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.8s ease-out 0.9s forwards;
}

.about-content p {
    margin-bottom: 20px;
    font-size: 16px;
    line-height: 1.15;
    text-align: center;
}

.about-image:hover {
    transform: scale(1.02);
    transition: transform 0.3s ease;
}

.about-content:hover {
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    transition: box-shadow 0.3s ease;
}

/* ==============================
   ANIMATIONS
   ============================== */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ==============================
   RESPONSIVE
   ============================== */
@media (max-width: 768px) {
    .about-row { flex-direction: column; gap: 20px; }
    .about-image { height: 350px; }
    .page-title { font-size: 28px; }
}

@media (max-width: 576px) {
    .main-content { margin-top: 80px; padding: 20px 0; }
    .page-title { font-size: 26px; }
}

</style>

