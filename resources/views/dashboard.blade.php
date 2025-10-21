<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Kependudukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #0b57a8;
            --secondary: #004E92;
            --success: #198754;
            --warning: #ffc107;
            --info: #0dcaf0;
        }

        .stat-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .quick-action-btn {
            padding: 20px;
            border-radius: 15px;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .quick-action-btn:hover {
            border-color: var(--primary);
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 15px;
            padding: 30px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-users me-2"></i>Sistem Kependudukan
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i> Guest
                </span>
                @if (!session('is_logged_in'))
                    <a href="{{ route('login.form') }}" class="btn btn-outline-light btn-sm">
                        Masuk
                    </a>
                @endif
            </div>
        </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row mb-4">
            @if (session('is_logged_in'))
                <div class="col-md-3 mb-3">
                    <a href="{{ route('tambah-data.create') }}" class="btn btn-primary w-100">Tambah Data</a>
                </div>
               <div class="col-md-3 mb-3">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>
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
        const chartKelahiran = new Chart(document.getElementById('chartKelahiran'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Kelahiran',
                    data: @json(array_values($grafikKelahiran)),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Grafik Gender
        const chartGender = new Chart(document.getElementById('chartGender'), {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: @json([$grafikGender['L'] ?? 0, $grafikGender['P'] ?? 0]),
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
                    tension: 0.1,
                    fill: false
                }]
            }
        });
    </script>
</body>

</html>
