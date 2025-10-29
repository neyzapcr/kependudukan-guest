<style>
/* === GLOBAL / AUTH PAGE FIXES === */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Target teks "SISTEM KEPENDUDUKAN" */
h1, .page-title, .dashboard-title {
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
    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.2) 0%, transparent 50%),
    radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
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

/* === GLOBAL STYLES === */
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

/* === LOGIN CARD STYLES === */
.login-horizontal-card {
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
  display: flex;
  width: 900px;
  max-width: 90%;
  min-height: 500px;
  overflow: hidden;
  position: relative;
  z-index: 10;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-horizontal-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 25px 80px rgba(59, 130, 246, 0.2);
}

.login-left-section {
  flex: 1;
  background: linear-gradient(135deg, #1e40af, #3b82f6);
  padding: 50px 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  position: relative;
  overflow: hidden;
}

.login-left-section::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 100%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  transform: rotate(30deg);
}

.login-right-section {
  flex: 1.2;
  padding: 50px 40px;
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
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 40px;
  margin: 0 auto 25px auto;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.3);
  transition: transform 0.3s ease;
}

.login-avatar:hover {
  transform: scale(1.05);
}

.login-welcome h2 {
  font-size: 28px;
  font-weight: 600;
  margin-bottom: 10px;
}

.login-welcome p {
  font-size: 16px;
  opacity: 0.9;
  margin-bottom: 8px;
  line-height: 1.5;
}

.login-welcome small {
  opacity: 0.7;
  font-size: 0.85rem;
}

.login-form-horizontal {
  width: 100%;
}

.form-group-horizontal {
  margin-bottom: 25px;
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
  padding: 14px 16px;
  border: 2px solid #e5e7eb;
  border-radius: 10px;
  font-size: 15px;
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

/* === CARD STYLES (TIDAK DIUBAH - tetap seperti semula) === */
.anggota-card, .keluarga-card, .warga-card {
  /* Tetap sama dengan CSS asli */
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.08);
  transition: all 0.3s ease;
  margin-bottom: 25px;
  overflow: hidden;
  border: none;
}

.anggota-card:hover, .keluarga-card:hover, .warga-card:hover {
  /* Tetap sama dengan CSS asli */
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
}

/* === CARD HEADER STYLES (TIDAK DIUBAH) === */
.anggota-card-header, .keluarga-card-header, .warga-card-header {
  /* Tetap sama dengan CSS asli */
  background: linear-gradient(135deg, #1e40af, #3b82f6);
  color: white;
  padding: 20px;
  display: flex;
  align-items: center;
}

.anggota-avatar, .keluarga-avatar, .warga-avatar {
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

.anggota-info, .keluarga-info, .warga-info {
  /* Tetap sama dengan CSS asli */
  flex-grow: 1;
}

.anggota-name, .keluarga-name, .warga-name {
  /* Tetap sama dengan CSS asli */
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 5px;
}

.anggota-kk, .keluarga-nomor, .warga-nik {
  /* Tetap sama dengan CSS asli */
  font-size: 14px;
  opacity: 0.9;
}

/* === CARD BODY STYLES (TIDAK DIUBAH) === */
.anggota-card-body, .keluarga-card-body, .warga-card-body {
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
.anggota-card-footer, .keluarga-card-footer, .warga-card-footer {
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

/* === MODAL STYLES === */
.modal-content {
  border-radius: 16px;
  border: none;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.modal-header {
  background: linear-gradient(135deg, #1e40af, #3b82f6);
  color: white;
  border-radius: 16px 16px 0 0;
  padding: 25px 30px;
  border-bottom: none;
}

.modal-header .modal-title {
  font-weight: 600;
  font-size: 20px;
}

.modal-header .btn-close {
  filter: invert(1);
  opacity: 0.8;
  transition: opacity 0.3s ease;
}

.modal-header .btn-close:hover {
  opacity: 1;
}

.modal-body {
  padding: 30px;
}

/* === RESPONSIVE DESIGN === */
@media (max-width: 768px) {
  .login-horizontal-card {
    flex-direction: column;
    width: 95%;
    min-height: auto;
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

  .btn-search, .btn-add {
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

  .btn-edit, .btn-delete {
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
</style>
