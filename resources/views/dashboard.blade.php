<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Kependudukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        :root {
            --primary: #0b57a8;
            --secondary: #004E92;
            --success: #198754;
            --warning: #ffc107;
            --info: #0dcaf0;

            --grad-1: linear-gradient(135deg, #0b57a8, #004E92);
            --grad-2: linear-gradient(135deg, #1a73e8, #0b57a8);
            --glass-bg: linear-gradient(135deg, rgba(255, 255, 255, .85), rgba(255, 255, 255, .65));
        }

        /* ====== Global Look & Feel ====== */
        * {
            scroll-behavior: smooth
        }

        body.bg-light {
            background: radial-gradient(1200px 600px at 10% 0%, #e6f0ff 0%, #f3f7ff 40%, #f8fbff 70%, #ffffff 100%);
        }

        /* Soft animated gradient for the navbar */
        .navbar.navbar-dark {
            background: var(--grad-1);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
            box-shadow: 0 10px 24px rgba(11, 87, 168, .25);
        }

        .navbar-brand.fw-bold::after {
            content: "  🌐";
        }

        /* Center nav links: slick underline + hover glow */
        .navbar .nav-link {
            position: relative;
            font-weight: 500;
            letter-spacing: .2px;
        }

        .navbar .nav-link::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 2px;
            width: 0;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all .3s ease;
        }

        .navbar .nav-link:hover::after {
            left: 0;
            width: 100%;
        }

        /* User button subtle glow */
        .btn-outline-light.btn-sm {
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .35);
            transition: transform .2s ease, box-shadow .3s ease, background .3s ease;
        }

        .btn-outline-light.btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, .25);
        }

        /* ====== Welcome Section ====== */
        .welcome-section {
            background: var(--grad-1);
            background-size: 200% 200%;
            animation: gradientShift 12s ease infinite;
            color: white;
            border-radius: 18px;
            padding: 32px;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            /* glow bubble */
            content: "";
            position: absolute;
            right: -80px;
            top: -80px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, .5), rgba(255, 255, 255, 0) 60%);
            filter: blur(6px);
            animation: floatUp 8s ease-in-out infinite;
        }

        .welcome-section h2 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .welcome-section h2::before {
            content: "📊";
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, .15));
            animation: pop .8s ease-out;
        }

        /* ====== Primary Buttons (Tambah Data) ====== */
        .btn.btn-primary {
            background: var(--grad-2);
            border: none;
            box-shadow: 0 10px 20px rgba(26, 115, 232, .25);
            transition: transform .2s ease, box-shadow .3s ease, filter .2s ease;
        }

        .btn.btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(26, 115, 232, .35);
            filter: brightness(1.05);
        }

        /* ====== Cards (Stats) ====== */
        .stat-card.card {
            border-radius: 16px;
            border: none;
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            transition: transform .3s ease, box-shadow .3s ease;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .08);
            background-image: radial-gradient(120px 120px at 85% -10%, rgba(255, 255, 255, .35), rgba(255, 255, 255, 0) 60%);
        }

        .stat-card.card::after {
            /* animated top sheen */
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .25) 50%, rgba(255, 255, 255, 0) 100%);
            transform: translateX(-100%);
            animation: shimmer 4.5s ease-in-out infinite 1.2s;
            pointer-events: none;
        }

        .stat-card.card:hover {
            transform: translateY(-6px) rotateX(1deg);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .12);
        }

        .stat-icon {
            font-size: 2.6rem;
            opacity: .9;
            transform: translateZ(0);
            transition: transform .4s cubic-bezier(.2, .8, .2, 1);
        }

        .stat-card.card:hover .stat-icon {
            transform: translateY(-3px) scale(1.06);
        }

        /* Extra emojis on specific icons */
        .stat-card .fa-users::after {
            content: " 👥";
        }

        .stat-card .fa-baby::after {
            content: " 👶";
        }

        .stat-card .fa-cross::after {
            content: " 🕊️";
        }

        .stat-card .fa-walking::after {
            content: " 🚶";
        }

        /* ====== Quick Action ====== */
        .quick-action-btn.card {
            padding: 22px;
            border-radius: 16px;
            border: 2px dashed #d7e3ff;
            background: var(--glass-bg);
            backdrop-filter: blur(6px);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }

        .quick-action-btn.card:hover {
            transform: translateY(-4px) scale(1.02);
            border-color: #8ab4ff;
            box-shadow: 0 16px 30px rgba(11, 87, 168, .15);
        }

        .quick-action-btn i {
            transition: transform .4s ease;
        }

        .quick-action-btn:hover i {
            transform: translateY(-3px) rotate(-3deg);
        }

        /* Extra cute emojis near headings */
        .quick-action-btn h5::after {
            content: "  ✍️";
        }

        /* ====== Chart Containers ====== */
        .chart-container {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(11, 87, 168, .08);
            border: 1px solid rgba(11, 87, 168, .08);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .chart-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(11, 87, 168, .12);
        }

        .chart-container h5::before {
            content: "📈  ";
        }

        /* ====== Tables & Lists ====== */
        .table.table-sm thead th {
            background: linear-gradient(180deg, #f0f6ff, #e7f0ff);
            color: #0b57a8;
            border-bottom: 0;
        }

        .table.table-sm tbody tr {
            transition: background .2s ease, transform .2s ease;
        }

        .table.table-sm tbody tr:hover {
            background: rgba(26, 115, 232, .06);
            transform: translateX(2px);
        }

        .list-group-item {
            border-radius: 10px !important;
            border: 1px solid rgba(11, 87, 168, .08) !important;
            margin-bottom: 8px;
        }

        .badge.bg-primary.rounded-pill {
            animation: pulseGlow 2s ease-in-out infinite;
        }

        /* ====== Footer ====== */
        footer {
            position: relative;
        }

        footer::before {
            content: "💠";
            margin-right: 6px;
        }

        /* ====== Dropdown animation (enhanced) ====== */
        .dropdown-menu.animate-dropdown {
            opacity: 0;
            transform: translateY(-8px) scale(.98);
            transition: opacity .22s ease, transform .22s ease;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .06);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .08);
        }

        .dropdown-menu.show.animate-dropdown {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* ====== Utility Emojis for section titles ====== */
        h4.mb-3::before {
            content: "⚡ ";
        }

        h5.mb-3::before {
            content: "✨ ";
        }

        /* ====== Keyframes ====== */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @keyframes floatUp {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(10px)
            }
        }

        @keyframes pop {
            0% {
                transform: scale(.7);
                opacity: 0
            }

            60% {
                transform: scale(1.08);
                opacity: 1
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-120%)
            }

            60% {
                transform: translateX(120%)
            }

            100% {
                transform: translateX(120%)
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(26, 115, 232, .35)
            }

            50% {
                box-shadow: 0 0 0 8px rgba(26, 115, 232, 0)
            }
        }

        /* ====== Small tweaks on badges/status ====== */
        .badge.bg-success::before {
            content: "✅ ";
        }

        .badge.bg-warning::before {
            content: "⏳ ";
        }

        .badge.bg-dark::before {
            content: "🕯️ ";
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <!-- Navigation -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0b57a8, #004E92);">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="#">
                Sistem Kependudukan
            </a>

            <!-- Toggle untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu + User Info -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- Navigasi Tengah -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0" style="display:flex; justify-content:center; gap:30px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('keluarga.index') }}">Data Warga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kelahiran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kematian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perpindahan</a>
                    </li>
                </ul>

                <!-- User Info di Kanan -->
                <ul class="navbar-nav ms-auto">
                    @if (!session()->has('is_logged_in'))
                        <li class="nav-item">
                            <a href="{{ route('login.form') }}" class="btn btn-outline-light btn-sm"
                                style="padding: 6px 14px; border-radius: 6px;">Masuk</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <!-- Username sebagai tombol dropdown -->
                            <a class="btn btn-outline-light btn-sm dropdown-toggle" href="#" role="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                style="padding: 6px 14px; border-radius: 6px;">
                                {{ session()->get('username') }}
                            </a>

                            <!-- Dropdown menu dengan animasi -->
                            <ul class="dropdown-menu dropdown-menu-end animate-dropdown" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3 py-2">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100 btn-sm"
                                            style="border-radius:6px;">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-4">
        <div class="row mb-4">
            @if (session('is_logged_in'))
                <div class="col-md-3 mb-3">
                    <a href="{{ route('tambah-data.create') }}" class="btn btn-primary w-100">Tambah Data</a>
                </div>
            @else
                <div class="col-md-3 mb-3">
                    <a href="{{ route('login.form') }}" class="btn btn-primary w-100">Tambah Data</a>
                </div>
            @endif
        </div>
        <!-- Header / Sambutan -->
        <div class="welcome-section mb-4">
            <h2 class="mb-3">Selamat datang di Sistem Informasi Kependudukan Desa Andromeda</h2>
            <p class="lead mb-0">Melalui halaman ini, Anda dapat melihat data penduduk serta melaporkan peristiwa
                kependudukan seperti kelahiran, kematian, dan perpindahan.</p>
        </div>

        <!-- Ringkasan Statistik Cepat -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{ $totalWarga }}</h4>
                                <small>Total Penduduk</small>
                            </div>
                            <i class="fas fa-users stat-icon"></i>
                        </div>
                        <small class="opacity-75">Update terakhir: {{ date('F Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{ $kelahiranTahunIni }}</h4>
                                <small>Kelahiran Tahun Ini</small>
                            </div>
                            <i class="fas fa-baby stat-icon"></i>
                        </div>
                        <small class="opacity-75">Naik 10% dari tahun lalu</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card card text-white bg-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{ $kematianTahunIni }}</h4>
                                <small>Kematian Tahun Ini</small>
                            </div>
                            <i class="fas fa-cross stat-icon"></i>
                        </div>
                        <small class="opacity-75">Turun 5% dari tahun lalu</small>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{ $pindahTahunIni }}</h4>
                                <small>Penduduk Pindah</small>
                            </div>
                            <i class="fas fa-walking stat-icon"></i>
                        </div>
                        <small class="opacity-75">6 pindah masuk, 6 pindah keluar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Akses Cepat ke Laporan -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3">Akses Cepat Laporan</h4>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="quick-action-btn card text-center d-block"
                    onclick="alert('Fitur ini belum tersedia');">

                    <i class="fas fa-baby fa-3x text-success mb-3"></i>
                    <h5>Laporkan Kelahiran</h5>
                    <small class="text-muted">Lapor kelahiran bayi baru</small>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="quick-action-btn card text-center d-block"
                    onclick="alert('Fitur ini belum tersedia');">
                    <i class="fas fa-cross fa-3x text-dark mb-3"></i>
                    <h5>Laporkan Kematian</h5>
                    <small class="text-muted">Lapor kematian penduduk</small>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="#" class="quick-action-btn card text-center d-block"
                    onclick="alert('Fitur ini belum tersedia');">
                    <i class="fas fa-walking fa-3x text-warning mb-3"></i>
                    <h5>Laporkan Pindah</h5>
                    <small class="text-muted">Lapor perpindahan penduduk</small>
                </a>
            </div>
        </div>

        <!-- Grafik Visualisasi -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="chart-container">
                    <h5 class="mb-3">Kelahiran per Bulan</h5>
                    <canvas id="chartKelahiran" height="250"></canvas>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="chart-container">
                    <h5 class="mb-3">Perbandingan Gender</h5>
                    <canvas id="chartGender" height="250"></canvas>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="chart-container">
                    <h5 class="mb-3">Tren Pertumbuhan</h5>
                    <canvas id="chartPertumbuhan" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Data Terbaru -->
            <div class="col-md-6 mb-4">
                <div class="chart-container">
                    <h5 class="mb-3">Laporan Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanTerbaru as $laporan)
                                    <tr>
                                        <td>
                                            @if ($laporan->jenis == 'Kelahiran')
                                                <span class="badge bg-success">Kelahiran</span>
                                            @elseif($laporan->jenis == 'Kematian')
                                                <span class="badge bg-dark">Kematian</span>
                                            @else
                                                <span class="badge bg-warning">Pindah</span>
                                            @endif
                                        </td>
                                        <td>{{ $laporan->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}</td>
                                        <td>
                                            @if (rand(0, 1))
                                                <span class="badge bg-success">✅ Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning">⏳ Menunggu</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sebaran Penduduk -->
            <div class="col-md-3 mb-4">
                <div class="chart-container">
                    <h5 class="mb-3">Sebaran per Dusun</h5>
                    <div class="list-group">
                        @foreach ($sebaranDusun as $dusun)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $dusun['wilayah'] }}
                                <span class="badge bg-primary rounded-pill">{{ $dusun['jumlah'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Info & Pengumuman -->
            <div class="col-md-3 mb-4">
                <div class="chart-container">
                    <h5 class="mb-3">Info & Pengumuman</h5>
                    <div class="list-group">
                        @foreach ($pengumuman as $info)
                            <div class="list-group-item">
                                <small>{{ $info }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center text-muted">
            <p class="mb-1">Sistem Kependudukan Desa Andromeda © 2025</p>
            <p class="small">Hubungi kami: Kantor Desa Andromeda, Telp. 0812-xxxx-xxxx</p>
        </footer>
    </div>

    <script>
        // Grafik Kelahiran per Bulan
        <script>
    // Grafik Kelahiran per Bulan
    const chartKelahiran = new Chart(document.getElementById('chartKelahiran'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Warga Baru',
                data: @json(array_values($grafikLengkap)),
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Grafik Gender
    const chartGender = new Chart(document.getElementById('chartGender'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: @json([$grafikGender['L'], $grafikGender['P']]),
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        }
    });

    // Grafik Pertumbuhan
    const chartPertumbuhan = new Chart(document.getElementById('chartPertumbuhan'), {
        type: 'line',
        data: {
            labels: @json(array_keys($grafikPertumbuhan)),
            datasets: [{
                label: 'Total Penduduk',
                data: @json(array_values($grafikPertumbuhan)),
                borderColor: '#FF6384',
                tension: 0.3,
                fill: false
            }]
        }
    });
</script>

</body>

</html>
