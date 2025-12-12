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
                            <h2>Selamat datang di Sistem Kependudukan Desa Andromeda</h2>
                            <p>Lihat statistik warga dan informasi layanan kependudukan dengan mudah dan cepat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ========================== STATISTIC CARDS ========================== --}}
<div class="services section" id="services">
    <div class="container text-center">

        <div class="row justify-content-center">

            {{-- TOTAL PENDUDUK --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ asset('assets-guest/images/service-01.png') }}">
                    </div>
                    <div class="main-content">
                        <h1 class="mb-0">{{ $totalWarga }}</h1>
                        <h4>Total Penduduk</h4>
                        <small class="opacity-75">Update {{ date('F Y') }}</small>
                    </div>
                </div>
            </div>

            {{-- KELAHIRAN --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ asset('assets-guest/images/service-02.png') }}">
                    </div>
                    <div class="main-content">
                        <h1 class="mb-0">{{ $kelahiranTahunIni }}</h1>
                        <h4>Kelahiran Tahun Ini</h4>
                        <small class="opacity-75">Laporan resmi desa</small>
                    </div>
                </div>
            </div>

            {{-- KEMATIAN --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ asset('assets-guest/images/service-03.png') }}">
                    </div>
                    <div class="main-content">
                        <h1 class="mb-0">{{ $kematianTahunIni }}</h1>
                        <h4>Kematian Tahun Ini</h4>
                        <small class="opacity-75">Data terverifikasi</small>
                    </div>
                </div>
            </div>

            {{-- PINDAH --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ asset('assets-guest/images/service-02.png') }}">
                    </div>
                    <div class="main-content">
                        <h1 class="mb-0">{{ $pindahTahunIni }}</h1>
                        <h4>Penduduk Pindah</h4>
                        <small class="opacity-75">Perpindahan warga</small>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


{{-- ========================== CHARTS ========================== --}}
<div class="container mt-5">

    <div class="row mb-4">

        {{-- KELAHIRAN PER BULAN --}}
        <div class="col-md-4 mb-4">
            <div class="chart-container p-3 rounded shadow-sm" style="background:#fff;">
                <h5 class="mb-3 text-center">Kelahiran per Bulan</h5>
                <canvas id="chartKelahiran" height="250"></canvas>
            </div>
        </div>

        {{-- PERBANDINGAN GENDER --}}
        <div class="col-md-4 mb-4">
            <div class="chart-container p-3 rounded shadow-sm" style="background:#fff;">
                <h5 class="mb-3 text-center">Perbandingan Gender</h5>
                <canvas id="chartGender" height="250"></canvas>
            </div>
        </div>

        {{-- TREN 5 TAHUN --}}
        <div class="col-md-4 mb-4">
            <div class="chart-container p-3 rounded shadow-sm" style="background:#fff;">
                <h5 class="mb-3 text-center">Tren 5 Tahun Terakhir</h5>
                <canvas id="chartTrend" height="250"></canvas>
            </div>
        </div>

    </div>

    {{-- PENGUMUMAN --}}
 {{-- PENGUMUMAN TENGAH --}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="chart-container p-4 rounded shadow-sm text-center" style="background:#fff;">
            <h5 class="mb-3">Info & Pengumuman</h5>

            <ul style="list-style: none; padding: 0; margin: 0;">
                @foreach ($pengumuman as $info)
                    <li class="mb-2" style="font-size: 15px; color:#333;">
                        {{ $info }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>



</div>


{{-- ========================== CHART JS ========================== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // KELAHIRAN PER BULAN
    new Chart(document.getElementById("chartKelahiran"), {
        type: "bar",
        data: {
            labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
            datasets: [{
                label: "Kelahiran",
                data: @json(array_values($grafikKelahiran)),
                backgroundColor: "#3b82f6"
            }]
        }
    });

    // GENDER
    new Chart(document.getElementById("chartGender"), {
        type: "doughnut",
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: @json(array_values($grafikGender)),
                backgroundColor: ["#1e40af", "#f472b6"]
            }]
        }
    });

    // TREN 5 TAHUN
    new Chart(document.getElementById("chartTrend"), {
        type: "line",
        data: {
            labels: @json($tahunGrafik),
            datasets: [
                {
                    label: "Penduduk",
                    data: @json($grafikPenduduk),
                    borderColor: "#1e40af",
                    borderWidth: 2,
                    tension: .3
                },
                {
                    label: "Kelahiran",
                    data: @json($grafikLahir),
                    borderColor: "#3b82f6",
                    borderWidth: 2,
                    tension: .3
                },
                {
                    label: "Kematian",
                    data: @json($grafikMati),
                    borderColor: "#ef4444",
                    borderWidth: 2,
                    tension: .3
                },
                {
                    label: "Pindah",
                    data: @json($grafikPindah),
                    borderColor: "#f59e0b",
                    borderWidth: 2,
                    tension: .3
                },
            ]
        }
    });
</script>

@endsection
