@extends('layouts.guest.app')

@section('title', 'Dashboard | Sistem Kependudukan')

@section('content')

    {{-- ========================== MAIN BANNER ========================== --}}
    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-banner">
                        <div class="item item-1">
                            <div class="header-text">
                                <span class="category">Sistem Kependudukan</span>
                                <h2>Selamat Datang di Sistem Data Penduduk Desa</h2>
                                <p>Platform digital untuk mengelola dan menyajikan informasi kependudukan secara akurat dan
                                    terintegrasi.</p>
                            </div>
                        </div>
                        <div class="item item-2">
                            <div class="header-text">
                                <span class="category">Sistem Kependudukan</span>
                                <h2>Pusat Informasi dan Layanan Kependudukan</h2>
                                <p>Akses data warga, keluarga, dan peristiwa kependudukan dengan mudah dan cepat.</p>
                            </div>
                        </div>
                        <div class="item item-3">
                            <div class="header-text">
                                <span class="category">Sistem Kependudukan</span>
                                <h2>Pengelolaan Data Kependudukan Berbasis Digital</h2>
                                <p>Mendukung pelayanan publik desa yang tertib, transparan, dan terintegrasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================== STATISTIC CARDS ========================== --}}
{{-- ========================== STATISTIC CARDS ========================== --}}
<div class="services section" id="services">
  <div class="container">

    {{-- BARIS ATAS --}}
    <div class="cards-wrapper">
      <div class="service-item">
        <div class="main-content">
          <div class="icon">
            <img src="{{ asset('assets-guest/images/total.png') }}">
          </div>
          <h1>{{ $totalWarga }}</h1>
          <h4>Total Penduduk</h4>
          <small>Keseluruhan data</small>
        </div>
      </div>

      {{-- Tambah ini --}}
      <div class="service-item">
        <div class="main-content">
          <div class="icon">
            <img src="{{ asset('assets-guest/images/kk.png') }}">
          </div>
          <h1>{{ $jumlahKeluarga }}</h1>
          <h4>Total Keluarga (KK)</h4>
          <small>Data kepala keluarga</small>
        </div>
      </div>
    </div>

    {{-- BARIS BAWAH --}}
    <div class="cards-wrapper">
      <div class="service-item">
        <div class="main-content">
          <div class="icon">
            <img src="{{ asset('assets-guest/images/lahir.png') }}">
          </div>
          <h1>{{ $kelahiranTahunIni }}</h1>
          <h4>Kelahiran</h4>
          <small>Tahun {{ date('Y') }}</small>
        </div>
      </div>

      <div class="service-item">
        <div class="main-content">
          <div class="icon">
            <img src="{{ asset('assets-guest/images/mati.png') }}">
          </div>
          <h1>{{ $kematianTahunIni }}</h1>
          <h4>Kematian</h4>
          <small>Tahun {{ date('Y') }}</small>
        </div>
      </div>

      <div class="service-item">
        <div class="main-content">
          <div class="icon">
            <img src="{{ asset('assets-guest/images/pindah.png') }}">
          </div>
          <h1>{{ $pindahTahunIni }}</h1>
          <h4>Pindah</h4>
          <small>Tahun {{ date('Y') }}</small>
        </div>
      </div>
    </div>

  </div>
</div>




    {{-- ========================== CHART SECTION ========================== --}}
    <div class="container mt-5">
        <div class="row">

            {{-- KELAHIRAN PER BULAN --}}
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h5 class="chart-title">Kelahiran per Bulan</h5>
                    <div class="chart-box">
                        <canvas id="chartKelahiran"></canvas>
                    </div>
                </div>
            </div>

            {{-- GENDER --}}
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h5 class="chart-title">Perbandingan Gender</h5>
                    <div class="chart-box">
                        <canvas id="chartGender"></canvas>
                    </div>
                </div>
            </div>

            {{-- TREN 5 TAHUN --}}
            <div class="col-md-4 mb-4">
                <div class="chart-card">
                    <h5 class="chart-title">Data Kependudukan 5 Tahun Terakhir</h5>
                    <div class="chart-box">
                        <canvas id="chartTrend"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- ========================== PENGEMBANG ========================== --}}
    <div class="row justify-content-center mt-4">
        <div class="col-lg-9 col-md-10">
            <div class="developer-card dev-animate">
                <div class="dev-left">
                    <div class="dev-photo-wrap">
                        <img src="{{ asset('assets/images/neyza_foto.jpg') }}" alt="Foto Pengembang" class="dev-photo">
                    </div>
                </div>

                <div class="dev-right">
                    <div class="dev-badge">
                        <i class="fa-solid fa-code"></i>
                        <span>Profil Pengembang</span>
                    </div>

                    <h4 class="dev-name">Neyza Shafalika</h4>
                    <p class="dev-sub">
                        NIM <b>2457301113</b> • Prodi <b>Sistem Informasi</b> • Kampus <b>Politeknik Caltex Riau</b>
                    </p>


                    <div class="dev-meta">
                        <div class="dev-meta-item">
                            <i class="fa-solid fa-id-card"></i>
                            <span>Mahasiswa</span>
                        </div>
                        <div class="dev-meta-item">
                            <i class="fa-solid fa-users"></i>
                            <span>G'24</span>
                        </div>
                        <div class="dev-meta-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Indonesia</span>
                        </div>
                        <div class="dev-meta-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span>neyza24si@mahasiswa.pcr.ac.id</span>
                        </div>
                    </div>

                    <div class="dev-social">
                        <a class="dev-social-btn" href="https://www.linkedin.com/in/neyza-shafalika-s0020244636"
                            target="_blank" aria-label="LinkedIn" title="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a class="dev-social-btn" href="https://github.com/neyzapcr" target="_blank" aria-label="GitHub"
                            title="GitHub">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a class="dev-social-btn" href="https://instagram.com/neza.sha" target="_blank"
                            aria-label="Instagram" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a class="dev-social-btn" href="https://wa.me/6289652437006" target="_blank"
                            aria-label="WhatsApp" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{-- ========================== CHART JS ========================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* =========================
       OPTIONS GLOBAL (SEMUA CHART)
       ========================= */
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true, // bikin legend jadi DOT
                        pointStyle: 'circle', // bentuk lingkaran
                        boxWidth: 10,
                        boxHeight: 10,
                        padding: 20,
                        font: {
                            size: 13,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    padding: 10,
                    titleFont: {
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        };

        /* =========================
           CHART 1 — KELAHIRAN PER BULAN
           ========================= */
        new Chart(document.getElementById("chartKelahiran"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: "Kelahiran",
                    data: @json(array_values($grafikKelahiran)),
                    backgroundColor: "#3b82f6",
                    borderRadius: 8,
                    maxBarThickness: 35
                }]
            },
            options: commonOptions
        });

        /* =========================
           CHART 2 — PERBANDINGAN GENDER
           ========================= */
        new Chart(document.getElementById("chartGender"), {
            type: "doughnut",
            data: {
                labels: ["Laki-laki", "Perempuan"],
                datasets: [{
                    data: @json(array_values($grafikGender)),
                    backgroundColor: ["#1e40af", "#f472b6"],
                    hoverOffset: 8
                }]
            },
            options: {
                ...commonOptions,
                cutout: "65%"
            }
        });

        /* =========================
           CHART 3 — TREN 5 TAHUN TERAKHIR
           ========================= */
        new Chart(document.getElementById("chartTrend"), {
            type: "line",
            data: {
                labels: @json($tahunGrafik),
                datasets: [{
                        label: "Penduduk (Akumulatif)",
                        data: @json($grafikPenduduk),
                        borderColor: "#1e40af",
                        backgroundColor: "rgba(30,64,175,0.15)",
                        borderWidth: 3,
                        tension: 0.35,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: "Kelahiran",
                        data: @json($grafikLahir),
                        borderColor: "#3b82f6",
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4
                    },
                    {
                        label: "Kematian",
                        data: @json($grafikMati),
                        borderColor: "#ef4444",
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4
                    },
                    {
                        label: "Pindah",
                        data: @json($grafikPindah),
                        borderColor: "#f59e0b",
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4
                    }
                ]
            },
            options: commonOptions
        });
    </script>

@endsection
