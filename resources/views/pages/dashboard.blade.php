@extends('layouts.guest.app')

@section('title', 'Dashboard - Sistem Kependudukan')

@section('content')
    <!-- Main Banner Section -->
    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-banner">
                        <div class="item item-1">
                            <div class="header-text">
                                <span class="category">Sistem Kependudukan</span>
                                <h2>Selamat datang di Sistem Kependudukan Desa Andromeda</h2>
                                <p>Melalui halaman ini, Anda dapat melihat data penduduk serta melaporkan peristiwa
                                    kependudukan seperti kelahiran, kematian, dan perpindahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services section" id="services">
        <div class="container">
            <div class="row text-center justify-content-center">
                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('assets-guest/images/service-01.png') }}" alt="total warga">
                        </div>
                        <div class="main-content">
                            <h1 class="mb-0">{{ $totalWarga }}</h1>
                            <h4>Total Penduduk</h4>
                            <small class="opacity-75">Update terakhir: {{ date('F Y') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('assets-guest/images/service-02.png') }}" alt="kelahiran">
                        </div>
                        <div class="main-content">
                            <h1 class="mb-0">{{ $kelahiranTahunIni }}</h1>
                            <h4>Kelahiran Tahun Ini</h4>
                            <small class="opacity-75">Naik 10% dari tahun lalu</small>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('assets-guest/images/service-03.png') }}" alt="kematian">
                        </div>
                        <div class="main-content">
                             <h1 class="mb-0">{{ $kematianTahunIni }}</h1>
                            <h4>Kematian Tahun Ini</h4>
                            <small class="opacity-75">Turun 5% dari tahun lalu</small>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="icon">
                            <img src="{{ asset('assets-guest/images/service-02.png') }}" alt="penduduk pindah">
                        </div>
                        <div class="main-content">
                            <h1 class="mb-0">{{ $pindahTahunIni }}</h1>
                            <h4>Penduduk Pindah</h4>
                            <small class="opacity-75">6 pindah masuk, 6 pindah keluar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Charts Section -->
    <div class="container mt-5">
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

        <!-- Data Section -->
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
    </div>

@endsection
