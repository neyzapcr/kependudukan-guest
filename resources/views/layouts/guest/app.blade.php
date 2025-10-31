<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.1.0/css/all.min.css">

    <title>@yield('title', 'Dashboard | Sistem Kependudukan')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets-guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets-guest/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/templatemo-scholar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    @include('layouts.guest.navbar-css')
    @include('layouts.guest.css')

    <!-- Custom Styles -->
    @stack('styles')
</head>
<body>

    <!-- Preloader -->
<!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Header -->
    @include('layouts.guest.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

<!-- Floating WhatsApp Button -->
<div class="wa-container">
  <a href="https://wa.me/6289652437006" target="_blank" class="wa-float" title="Hubungi Kami di WhatsApp">
    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
    <span class="wa-text">Hubungi Kami</span>
  </a>
</div>

    <!-- Footer -->
    @include('layouts.guest.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets-guest/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-guest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-guest/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets-guest/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets-guest/js/counter.js') }}"></script>
    <script src="{{ asset('assets-guest/js/custom.js') }}"></script>

    <!-- All JavaScript Functionality -->
    @include('layouts.guest.js')

    <!-- Custom Scripts -->
    @stack('scripts')

</body>
</html>

