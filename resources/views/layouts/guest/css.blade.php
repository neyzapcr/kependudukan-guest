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
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        overflow-x: hidden;
        overflow: hidden;
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
        overflow: hidden;
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
        width: 800px;
        max-width: 85%;
        min-height: 450px;
        overflow: hidden;
        position: relative;
        z-index: 10;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: 80px;
        margin-bottom: 40px;
    }

    .login-horizontal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 80px rgba(59, 130, 246, 0.2);
    }

    .login-left-section {
        flex: 1;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        padding: 40px 35px;
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
        color: #ffffff;
        opacity: 0.9;
    }

    .login-left-section,
    .login-left-section * {
        color: #ffffff;
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
        padding: 40px 35px;
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
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 20px auto;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
    }

    .login-avatar:hover {
        transform: scale(1.05);
    }

    .login-welcome h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .login-welcome p {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 6px;
        line-height: 1.5;
    }

    .login-welcome small {
        opacity: 0.7;
        font-size: 0.8rem;
    }

    .login-form-horizontal {
        width: 100%;
    }

    /* Alerts */
    .alert-danger,
    .invalid-feedback,
    .is-invalid {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border: 2px solid #fecaca;
        color: #dc2626;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-weight: 500;
        text-align: center;
    }

    .alert-success,
    .is-valid {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 2px solid #bbf7d0;
        color: #166534;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-weight: 500;
        text-align: center;
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
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* ==============================
   FORM STYLES
   ============================== */
    .form-group-horizontal {
        margin-bottom: 20px;
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
        padding: 12px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
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
   UNIFIED CARD STYLES
   ============================== */
    .anggota-card,
    .keluarga-card,
    .warga-card {
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
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
    }

    /* Card Header */
    .anggota-card-header,
    .keluarga-card-header,
    .warga-card-header {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
    }

    .anggota-avatar,
    .keluarga-avatar,
    .warga-avatar {
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
        flex-grow: 1;
    }

    .anggota-name,
    .keluarga-name,
    .warga-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .anggota-kk,
    .keluarga-nomor,
    .warga-nik {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Card Body */
    .anggota-card-body,
    .keluarga-card-body,
    .warga-card-body {
        padding: 20px;
    }

    .info-row {
        display: flex;
        margin-bottom: 12px;
        align-items: flex-start;
    }

    .info-label {
        width: 140px;
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
    }

    .info-value {
        flex-grow: 1;
        color: #2d3748;
        font-size: 14px;
    }

    /* Gender Styles */
    .gender-male {
        color: #2563eb;
        font-weight: 500;
    }

    .gender-female {
        color: #cf1dd8;
        font-weight: 500;
    }

    /* Card Footer */
    .anggota-card-footer,
    .keluarga-card-footer,
    .warga-card-footer {
        padding: 15px 20px;
        background: #f7fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
    }

    /* Samakan ukuran/feel tombol di action */
.action-buttons .btn{
    padding: 8px 16px;
    border-radius: 8px; /* sama kayak edit & delete */
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* DETAIL: warna biru muda tapi masih satu tema */
.btn-detail{
    background: linear-gradient(135deg, #0ea5e9, #38bdf8); /* sky -> light sky */
    border: none;
    color: white;
}

/* Hover sama feel-nya seperti Edit/Hapus */
.btn-detail:hover{
    background: linear-gradient(135deg, #0284c7, #0ea5e9); /* lebih gelap pas hover */
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.30);
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

    /* Search & Add Buttons */
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

    /* Empty State */
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

    /* Table Styles */
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

    /* Pagination */
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
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease;
    }

    /* ==============================
   ANIMATIONS
   ============================== */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ==============================
   UTILITY CLASSES
   ============================== */
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

    /* CSS untuk button tambah anggota yang kecil dan elegan */
    .btn-tambah-anggota {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-tambah-anggota:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        color: white;
    }

    .btn-tambah-anggota:active {
        transform: translateY(0);
    }

    /* Icon animation */
    .btn-tambah-anggota i {
        transition: transform 0.3s ease;
        font-size: 12px;
    }

    .btn-tambah-anggota:hover i {
        transform: scale(1.1);
    }


    /* ==============================
   PENGEMBANG (LENGKAP + ANIMASI)
   ============================== */

    /* Card utama */
    .developer-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 18px 60px rgba(59, 130, 246, 0.14);
        border: 1px solid rgba(59, 130, 246, 0.10);
        overflow: hidden;
        display: flex;
        gap: 22px;
        padding: 22px;
        position: relative;
    }

    /* background halus */
    .developer-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 18% 18%, rgba(59, 130, 246, 0.10), transparent 55%),
            radial-gradient(circle at 85% 12%, rgba(30, 64, 175, 0.08), transparent 45%);
        pointer-events: none;
    }

    /* animasi masuk */
    .dev-animate {
        animation: devFadeUp .65s ease-out both;
    }

    @keyframes devFadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Kolom kiri */
    .dev-left {
        width: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    /* Foto portrait (memanjang ke bawah) */
    .dev-photo-wrap {
        width: 190px;
        /* lebar */
        height: 280px;
        /* ✅ tinggi > lebar (portrait) */
        border-radius: 22px;
        padding: 5px;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.9), rgba(59, 130, 246, 0.9));
        box-shadow: 0 14px 34px rgba(30, 64, 175, 0.25);
        transition: transform .25s ease;
    }

    .dev-photo {
        width: 100%;
        height: 100%;
        border-radius: 17px;
        object-fit: cover;
        object-position: center;
        display: block;
        background: #f3f4f6;
    }

    /* Kolom kanan */
    .dev-right {
        flex: 1;
        position: relative;
        z-index: 1;
        text-align: left;
    }

    /* Badge */
    .dev-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        background: rgba(59, 130, 246, 0.10);
        color: #1e40af;
        font-weight: 800;
        font-size: 13px;
    }

    /* Nama + sub */
    .dev-name {
        margin: 12px 0 6px 0;
        font-weight: 900;
        letter-spacing: -0.2px;
        color: #111827;
        font-size: 22px;
        line-height: 1.2;
    }

    .dev-sub {
        margin: 0 0 12px 0;
        color: #4b5563;
        font-size: 15px;
        line-height: 1.55;
    }

    /* Meta list */
    .dev-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: nowrap;
        /* ✅ desktop sebaris */
        margin: 10px 0 12px;
    }

    .dev-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 12px;
        background: #f8fafc;
        border: 1px solid rgba(15, 23, 42, 0.06);
        color: #334155;
        font-size: 14px;
        white-space: nowrap;
        /* ✅ desktop tidak turun */
    }

    .dev-meta-item i {
        color: #1e40af;
    }

    /* Social */
    .dev-social {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin-top: 10px;
        margin-bottom: 12px;
    }

    .dev-social-btn {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;

        background: #eef2ff;
        border: 1px solid rgba(59, 130, 246, 0.25);
        color: #1e40af;
        font-size: 18px;

        transition: transform .18s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
    }

    .dev-social-btn:hover {
        transform: translateY(-2px);
        background: #dbeafe;
        border-color: rgba(59, 130, 246, 0.35);
        box-shadow: 0 10px 22px rgba(59, 130, 246, 0.18);
    }

    .dev-social-btn:active {
        transform: translateY(0);
        box-shadow: none;
    }

    .dev-social-btn i {
        line-height: 1;
    }

    /* Note */
    .dev-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 11px 14px;
        border-radius: 14px;
        background: rgba(16, 185, 129, 0.10);
        border: 1px solid rgba(16, 185, 129, 0.18);
        color: #065f46;
        font-size: 14px;
        line-height: 1.35;
    }

    .dev-note i {
        margin-top: 2px;
        font-size: 16px;
    }

    /* Hover efek */
    .developer-card:hover .dev-photo-wrap {
        transform: rotate(-1deg) scale(1.03);
    }

    /* ==============================
   DROPDOWN STYLES - DIPERBAIKI
   ============================== */
    /* FIX: Warna teks dropdown harus jelas */
    .nav .dropdown-menu .dropdown-item {
        color: #333 !important;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }

    .nav .dropdown-menu {
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .nav .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #007bff !important;
    }

    .nav .dropdown-menu .dropdown-item.active {
        background-color: #007bff;
        color: white !important;
    }

    /* Pastikan semua link dalam dropdown memiliki warna teks yang jelas */
    .nav .dropdown-menu a {
        color: #333 !important;
    }

    .nav .dropdown-menu a:hover {
        color: #007bff !important;
    }

    /* Style untuk mobile */
    @media (max-width: 768px) {
        /* Dropdown akan full width di mobile */
        .nav .dropdown-menu {
            width: 100%;
            border: none;
            box-shadow: none;
            background-color: #f8f9fa;
        }

        .nav .dropdown-menu .dropdown-item {
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            color: #333 !important;
        }

        .nav .dropdown-menu .dropdown-item:hover {
            background-color: #e9ecef;
            color: #007bff !important;
        }

        /* Data Peristiwa dropdown khusus */
        .nav .dropdown-menu li:last-child .dropdown-item {
            border-bottom: none;
        }
    }

    /* ==============================
   RESPONSIVE DESIGN
   ============================== */
    @media (max-width: 768px) {
        .login-horizontal-card {
            flex-direction: column;
            width: 95%;
            min-height: auto;
            margin-top: 40px;
        }

        .login-left-section,
        .login-right-section {
            padding: 40px 30px;
        }

        .login-left-section {
            padding: 40px 30px 30px;
        }

        /* Responsive untuk card */
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

        .about-row {
            flex-direction: column;
            gap: 20px;
        }

        .about-image {
            height: 350px;
        }

        .page-title {
            font-size: 28px;
        }

        /* Responsive untuk pengembang */
        .developer-card {
            flex-direction: column;
            text-align: center;
            padding: 18px;
        }

        .dev-left {
            width: 100%;
        }

        .dev-photo-wrap {
            width: 175px;
            height: 245px;
            /* tetap portrait */
        }

        .dev-right {
            text-align: center;
            /* ✅ nama dll center */
        }

        .dev-badge {
            margin: 0 auto;
            /* badge ikut center */
        }

        .dev-name {
            font-size: 20px;
        }

        .dev-sub {
            font-size: 14px;
        }

        /* Meta: HP boleh wrap biar ga kepotong */
        .dev-meta {
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .dev-meta-item {
            white-space: normal;
            text-align: center;
        }

        .dev-social {
            justify-content: center;
        }

        .dev-note {
            justify-content: center;
            text-align: center;
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

    .login-avatar {
        width: 120px;
        /* ukuran lingkaran */
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        /* kunci biar bulat */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.35);
    }

    .login-avatar .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* 🔑 POTONG otomatis */
        object-position: center;
        /* fokus tengah gambar */
        border-radius: 40%;
        display: block;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 kolom */
        gap: 14px 16px;
        /* jarak antar field */
    }

    /* Biar hint password ga bikin layout berantakan */
    .form-grid .password-hint {
        margin-top: 6px;
        font-size: 12px;
        opacity: 0.9;
    }

    /* Responsive: kalau layar kecil jadi 1 kolom */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .login-form-horizontal .btn-search {
        display: block;
        width: 220px;
        /* atur lebar tombol */
        margin: 18px auto 0;
        /* auto = tengah */
        text-align: center;
    }

    .chart-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        padding: 16px;
        height: 360px;
        display: flex;
        flex-direction: column;
    }

    .chart-title {
        text-align: center;
        margin: 0 0 10px 0;
        font-weight: 600;
    }

    /* area chart dibuat tinggi fix (biar gak gepeng) */
    .chart-box {
        height: 260px;
        /* ✅ ini yang ngontrol tinggi chart */
        max-height: 260px;
        position: relative;
        margin-top: 6px;
    }

    /* canvas ngikut box */
    .chart-box canvas {
        width: 100% !important;
        height: 100% !important;
        display: block;
    }

    /* =========================================================
       ✅ TAMBAHAN FIX + RAPIN SHOW KELAHIRAN (DITARUH DI BAWAH)
       ========================================================= */

    /* FIX GAP putih sebelum footer, khusus halaman kelahiran-show */
    body:has(.kelahiran-show-page) footer {
        margin-top: 0 !important;
    }

    /* kurangi padding bawah konten supaya rapet sama footer */
    body:has(.kelahiran-show-page) .main-content {
        padding-bottom: 20px !important;
    }

    /* rapihin card show kelahiran */
    .kelahiran-show-page .warga-card {
        border-radius: 18px;
        box-shadow: 0 14px 45px rgba(30, 64, 175, 0.10);
        border: 1px solid rgba(15, 23, 42, 0.06);
    }

    .kelahiran-show-page .warga-card-header {
        padding: 18px 20px;
    }

    .kelahiran-show-page .warga-avatar {
        width: 56px;
        height: 56px;
        font-size: 20px;
    }

    .kelahiran-show-page .kelahiran-section-title {
        font-weight: 800;
        color: #0f172a;
    }

    .kelahiran-show-page .kelahiran-doc-card {
        background: #fff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 14px;
        padding: 12px 14px;
        box-shadow: 0 6px 18px rgba(30, 64, 175, 0.08);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .kelahiran-show-page .kelahiran-doc-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(30, 64, 175, 0.12);
    }

    .kelahiran-show-page .preview-file {
        color: #1e40af;
    }

    .kelahiran-show-page .preview-file:hover {
        text-decoration: underline;
    }

    /* =====================================================
   FIX SCROLL & GAP – KHUSUS HALAMAN DETAIL KEMATIAN
   ===================================================== */

/* Hilangkan dorongan footer (margin-top bawaan template) */
body:has(.kematian-show-page) footer {
    margin-top: 0 !important;
}

/* Kurangi tinggi konten supaya tidak perlu scroll */
body:has(.kematian-show-page) .main-content {
    margin-top: 90px;        /* sebelumnya 100px */
    padding-top: 24px;
    padding-bottom: 20px;
}

/* Card tampil lebih padat (tidak kepanjangan) */
body:has(.kematian-show-page) .warga-card {
    margin-bottom: 0;
    box-shadow: 0 12px 40px rgba(30, 64, 175, 0.12);
    border-radius: 18px;
}

/* Header card lebih ramping */
body:has(.kematian-show-page) .warga-card-header {
    padding: 16px 20px;
}

/* Avatar sedikit diperkecil */
body:has(.kematian-show-page) .warga-avatar {
    width: 54px;
    height: 54px;
    font-size: 20px;
}

/* Body card lebih hemat tinggi */
body:has(.kematian-show-page) .warga-card-body {
    padding: 18px 20px;
}

/* Section title */
body:has(.kematian-show-page) h5 {
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
}

/* Footer card rapat */
body:has(.kematian-show-page) .warga-card-footer {
    padding: 14px 20px;
}

/* Dokumen card lebih kecil */
body:has(.kematian-show-page) .border.rounded-3 {
    padding: 10px 12px !important;
}

/* Tombol aksi biar tidak bikin tinggi nambah */
body:has(.kematian-show-page) .action-buttons .btn {
    padding: 8px 14px;
    border-radius: 10px;
}

/* Mobile: pastikan tetap tanpa scroll aneh */
@media (max-width: 576px) {
    body:has(.kematian-show-page) .main-content {
        margin-top: 80px;
        padding-bottom: 16px;
    }
}
/* ==============================
   ABOUT PAGE (RAPI + PADAT + GAMBAR BAWAH + ANIMASI)
   ============================== */

.about-page .about-header-center{
    text-align: center;
    margin-bottom: 12px; /* rapetin */
}

.about-page .page-title{
    font-size: 40px;      /* sedikit lebih kecil biar ga makan ruang */
    font-weight: 800;
    letter-spacing: -0.6px;
    margin: 0 0 4px 0;    /* rapetin */
    line-height: 1.15;
}

.about-page .page-teks{
    margin: 0 auto 8px auto; /* rapetin */
    max-width: 850px;
    text-align: center;
    line-height: 1.55;
    font-size: 17px;
    color: #64748b;
    padding: 0;
}

/* Card teks (tetap ada, tapi ga kebesaran) */
.about-page .about-content-center{
    max-width: 980px;
    margin: 10px auto 0 auto;     /* rapetin */
    border-radius: 16px;
    padding: 20px 20px;           /* rapetin */
    background: #fff;
    box-shadow: 0 10px 28px rgba(15, 23, 42, 0.10);
    border: 1px solid rgba(59, 130, 246, 0.10);
}

.about-page .about-content-center p{
    text-align: center;
    color: #374151;
    line-height: 1.65;     /* ✅ jangan 1.2, terlalu mepet */
    font-size: 16px;
    margin-bottom: 12px;   /* rapetin */
}

.about-page .about-content-center p:last-child{
    margin-bottom: 0;
}

/* Wrapper gambar bawah (SATU KALI AJA, no duplicate) */
.about-page .about-image-bottom-wrap{
    max-width: 980px;
    margin: 12px auto 0 auto;  /* rapetin */
    display: flex;
    justify-content: center;
}

/* GAMBAR POLOS: no border, no shadow, no radius */
.about-page .about-image-bottom{
    width: 100%;
    max-width: 680px;
    height: auto;
    object-fit: contain;
    border-radius: 0;
    box-shadow: none;
    background: transparent;
    transition: transform .35s ease, opacity .35s ease;
}

/* Hover halus */
.about-page .about-image-bottom:hover{
    transform: translateY(-4px) scale(1.02);
}

/* Animasi masuk untuk card & gambar */
.about-fadeup{
    opacity: 0;
    transform: translateY(12px);
    animation: aboutFadeUp .6s ease-out .12s forwards;
}

.about-fadeup-delay{
    opacity: 0;
    transform: translateY(12px);
    animation: aboutFadeUp .6s ease-out .24s forwards;
}

@keyframes aboutFadeUp{
    from{ opacity: 0; transform: translateY(12px); }
    to  { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px){
    .about-page .page-title{ font-size: 30px; }
    .about-page .page-teks{ font-size: 15px; }
    .about-page .about-content-center{ padding: 16px; }
    .about-page .about-content-center p{ font-size: 15px; }
    .about-page .about-image-bottom{ max-width: 100%; }
}
/* ===== About Highlights (3 fitur) ===== */
.about-page .about-highlights{
    max-width: 980px;
    margin: 12px auto 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.about-page .highlight-item{
    background: #fff;
    border: 1px solid rgba(59, 130, 246, 0.10);
    border-radius: 16px;
    padding: 16px 14px;
    text-align: center;
    box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
    transition: transform .25s ease, box-shadow .25s ease;
}

.about-page .highlight-item:hover{
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(59, 130, 246, 0.14);
}

.about-page .highlight-icon{
    width: 46px;
    height: 46px;
    margin: 0 auto 8px auto;
    border-radius: 14px;
    display: grid;
    place-items: center;
    background: rgba(59, 130, 246, 0.12);
    color: #1e40af;
    font-size: 18px;
}

.about-page .highlight-item h5{
    margin: 0 0 6px 0;
    font-weight: 800;
    color: #0f172a;
}

.about-page .highlight-item p{
    margin: 0;
    font-size: 14px;
    line-height: 1.55;
    color: #475569;
}

/* Responsive */
@media (max-width: 768px){
    .about-page .about-highlights{
        grid-template-columns: 1fr;
    }
}

.nav-profile-img{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #4882e5;
}
.nav-profile-icon{
    font-size: 28px;
    color: #4882e5;
}
/* ===== Dropdown Profile Header ===== */
.dropdown-menu .dropdown-profile {
    padding: 12px 14px;
}

.dropdown-menu .dp-wrap{
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 14px;
    background: #f8fafc;
    border: 1px solid rgba(15, 23, 42, 0.08);
}

.dropdown-menu .dp-avatar{
    width: 46px;
    height: 46px;
    border-radius: 50%;
    overflow: hidden;
    flex: 0 0 46px;
    border: 2px solid rgba(72, 130, 229, 0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
}

.dropdown-menu .dp-avatar img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.dropdown-menu .dp-avatar i{
    font-size: 22px;
    color: #4882e5;
}

.dropdown-menu .dp-name{
    font-weight: 800;
    font-size: 16px;
    color: #334155;
    line-height: 1.2;
}

/* ===== Dropdown Profile Header (COMPACT) ===== */
.dropdown-menu .dropdown-profile.compact{
    padding: 8px 12px;
}

.dropdown-menu .dropdown-profile.compact .dp-wrap{
    background: transparent;   /* hilangkan card besar */
    border: 0;
    padding: 6px 4px;
    border-radius: 0;
    gap: 10px;
}

.dropdown-menu .dropdown-profile.compact .dp-avatar{
    width: 30px;              /* kecil */
    height: 30px;
    flex: 0 0 30px;
    border-radius: 50%;
    border: 2px solid rgba(72, 130, 229, 0.55);
    overflow: hidden;
    background: #fff;
}

.dropdown-menu .dropdown-profile.compact .dp-avatar img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.dropdown-menu .dropdown-profile.compact .dp-avatar i{
    font-size: 14px;          /* icon ikut kecil */
    color: #4882e5;
}

.dropdown-menu .dropdown-profile.compact .dp-name{
    font-weight: 800;
    font-size: 15px;
    color: #0f172a;
    line-height: 1.2;
}

/* =====================================================
   FIX SCROLL & GAP – KHUSUS HALAMAN DETAIL PINDAH
   ===================================================== */

/* Hilangkan dorongan footer (margin-top bawaan template) */
body:has(.pindah-show-page) footer {
    margin-top: 0 !important;
}

/* Kurangi tinggi konten supaya tidak perlu scroll */
body:has(.pindah-show-page) .main-content {
    margin-top: 90px;        /* sebelumnya 100px */
    padding-top: 24px;
    padding-bottom: 20px;
}

/* Card tampil lebih padat */
body:has(.pindah-show-page) .warga-card {
    margin-bottom: 0;
    box-shadow: 0 12px 40px rgba(30, 64, 175, 0.12);
    border-radius: 18px;
}

/* Header card lebih ramping */
body:has(.pindah-show-page) .warga-card-header {
    padding: 16px 20px;
}

/* Avatar sedikit diperkecil */
body:has(.pindah-show-page) .warga-avatar {
    width: 54px;
    height: 54px;
    font-size: 20px;
}

/* Body card lebih hemat tinggi */
body:has(.pindah-show-page) .warga-card-body {
    padding: 18px 20px;
}

/* Judul section */
body:has(.pindah-show-page) h5 {
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
}

/* Dokumen card lebih kecil */
body:has(.pindah-show-page) .border.rounded-3 {
    padding: 10px 12px !important;
}

/* Placeholder dokumen biar ga bikin tinggi kebanyakan */
body:has(.pindah-show-page) img[alt="Placeholder dokumen"] {
    width: 95px !important;
    height: 95px !important;
    opacity: 0.7 !important;
}

/* Footer card rapat */
body:has(.pindah-show-page) .warga-card-footer {
    padding: 14px 20px;
}

/* Tombol aksi biar tidak bikin tinggi nambah */
body:has(.pindah-show-page) .action-buttons .btn {
    padding: 8px 14px;
    border-radius: 10px;
}

@media (max-width: 576px) {
    body:has(.pindah-show-page) .main-content {
        margin-top: 80px;
        padding-bottom: 16px;
    }
}

</style>
