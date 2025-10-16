<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Kependudukan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('assets-guest/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{ asset('assets-guest/lib/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">

<style>
    :root {
        --primary-color: #0b57a8; /* biru muda */
        --secondary-color: #004E92; /* biru tua */
        --light-blue: #E8F0FF; /* biru lembut background */
        --white: #ffffff;
    }

    body {
        background-color: var(--light-blue);
        color: #333;
    }

    .navbar {
        background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
    }

    .navbar .nav-link.active,
    .navbar .nav-link:hover {
        color: var(--white) !important;
        font-weight: 600;
    }

    .btn-login,
    .btn-register {
        border: 1px solid #fff;
        color: var(--white);
        border-radius: 20px;
        padding: 5px 15px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background-color: var(--white);
        color: var(--primary-color);
    }

    .btn-register {
        background-color: var(--white);
        color: var(--primary-color);
    }

    .btn-register:hover {
        background-color: var(--secondary-color);
        color: var(--white);
    }

    /* ganti semua background kuning jadi biru lembut */
    .bg-primary,
    .btn-primary,
    .text-primary {
        background-color: var(--primary-color) !important;
        color: var(--white) !important;
        border-color: var(--primary-color) !important;
    }

    .bg-secondary {
        background-color: var(--secondary-color) !important;
    }

    .map-container {
        width: 100%;
        height: 500px;
        background-color: #cce3ff;
        border-radius: 10px;
        margin-top: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary-color);
        font-weight: bold;
        font-size: 1.5rem;
    }

    footer {
        background: var(--secondary-color);
        color: var(--white);
        padding: 20px 0;
    }

    footer a {
        color: #aad4ff;
        text-decoration: none;
    }

    footer a:hover {
        color: var(--white);
    }
</style>

</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid px-0 shadow">
        <nav class="navbar navbar-expand-lg navbar-dark py-3 px-4">
            <a href="#" class="navbar-brand">
                <h3 class="text-white fw-bold m-0">Sistem Kependudukan</h3>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="#" class="nav-item nav-link">Tentang</a>
                    <a href="#" class="nav-item nav-link">Data</a>
                    <a href="#" class="nav-item nav-link">Kontak</a>
                </div>
                <div class="d-flex">
                    <a href="#" class="btn-login me-2">Login</a>
                    <a href="#" class="btn-register">Register</a>

                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <div class="container-fluid bg-primary text-white text-center py-5 mb-4">
        <h1 class="display-5 fw-bold">Selamat Datang di Sistem Kependudukan</h1>
        <p class="lead mt-3">Pantau data penduduk secara menyeluruh di berbagai wilayah Indonesia.</p>

        <form class="mt-4" style="max-width: 500px; margin: 0 auto;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Masukkan nama desa atau daerah...">
                <button class="btn btn-light text-primary fw-bold">Cari</button>
            </div>
        </form>
    </div>

    <!-- Map Section -->
    <div class="container">
        <div class="map-container">
            <p>🗺️ Peta Sebaran Penduduk Indonesia</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center">
        <div class="container">
            <p class="mb-1">© 2025 Sistem Kependudukan Indonesia</p>
            <p class="small">Dibuat dengan 💙 untuk masyarakat Indonesia</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets-guest/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-guest/js/main.js') }}"></script>
</body>

</html>
