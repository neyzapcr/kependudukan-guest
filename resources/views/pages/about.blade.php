@extends('layouts.guest.app')

@section('title', 'Tentang Kami | Sistem Kependudukan')

@section('content')
    <div class="main-content about-page">
        <div class="container">

            {{-- HEADER --}}
            <div class="page-header about-header-center">
                <h1 class="page-title">Tentang Kami</h1>
                <p class="page-teks">
                    Platform digital untuk pengelolaan data warga yang lebih efisien dan transparan
                </p>
            </div>

            {{-- CARD TEKS --}}
            <div class="about-content about-content-center about-fadeup">
                <p>
                    Berawal dari kebutuhan akan pengelolaan data warga yang sering terlambat dan tidak teratur,
                    Sistem Kependudukan hadir sebagai solusi untuk mempermudah proses administrasi penduduk secara digital.
                </p>

                <p>
                    Melalui platform ini, setiap data warga dapat dicatat, diperbarui, dan dipantau dengan lebih cepat,
                    akurat, dan efisien. Petugas tidak lagi harus mencatat secara manual, semua sudah terhubung dalam
                    satu sistem yang mudah digunakan.
                </p>

                <p>
                    Dengan dukungan teknologi, kami berkomitmen untuk membantu pemerintah dan masyarakat dalam
                    menciptakan pelayanan kependudukan yang transparan, tertata, dan terpercaya.
                </p>
            </div>

            <div class="about-highlights about-fadeup">
                <div class="highlight-item">
                    <div class="highlight-icon"><i class="fas fa-bolt"></i></div>
                    <h5>Cepat</h5>
                    <p>Input dan pencarian data lebih praktis tanpa proses manual yang lama.</p>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon"><i class="fas fa-check-circle"></i></div>
                    <h5>Akurat</h5>
                    <p>Data tersimpan rapi, mudah diperbarui, dan meminimalkan kesalahan pencatatan.</p>
                </div>

                <div class="highlight-item">
                    <div class="highlight-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5>Transparan</h5>
                    <p>Informasi bisa dipantau dengan jelas untuk pelayanan yang lebih terpercaya.</p>
                </div>
            </div>


            {{-- GAMBAR DUA KOLOM --}}
            <div class="about-images-row">
                <div class="about-img-box animate-left">
                    <img src="{{ asset('assets/images/about-us-1.jpg') }}" alt="Tentang Kami 1">
                </div>

                <div class="about-img-box animate-right">
                    <img src="{{ asset('assets/images/about-us-2.jpg') }}" alt="Tentang Kami 2">
                </div>
            </div>


        </div>
    </div>
@endsection
