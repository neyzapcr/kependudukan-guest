@extends('layouts.guest.app')

@section('title', 'Tentang Kami | Sistem Kependudukan')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar di kiri -->
             <div class="col-lg-4 text-center mb-4 mb-lg-0">
                <div class="about-image-wrapper">
                    <img src="{{ asset('assets/images/about-us.png') }}" class="about-image large">
                </div>
            </div>

            <!-- Konten di kanan, judul & subtitle di tengah vertikal -->
            <div class="col-lg-8 d-flex flex-column justify-content-center">
                <h1 class="page-title" style="margin-left: 38%;">Tentang Kami</h1>
                <p class="page-teks" style="margin-left: 15%;" >
                    Platform digital untuk pengelolaan data warga yang lebih efisien dan transparan
                </p>

                <div class="about-content">
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
            </div>
        </div>
    </div>
</div>
@endsection

