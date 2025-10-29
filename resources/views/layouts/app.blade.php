<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>@yield('title', 'Dashboard | Sistem Kependudukan')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets-guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets-guest/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/templatemo-scholar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-guest/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Navbar Styles -->
    @include('layouts.navbar-css')

    <!-- Warga Styles (LOAD DI SEMUA HALAMAN) -->
    @include('layouts.css')

    <!-- Custom Styles -->
    @stack('styles')


</head>
<body>

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
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets-guest/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-guest/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-guest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-guest/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets-guest/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets-guest/js/counter.js') }}"></script>
    <script src="{{ asset('assets-guest/js/custom.js') }}"></script>

    <!-- Navbar JavaScript -->
    @include('layouts.navbar-js')


    <!-- Custom Scripts -->
    @stack('scripts')


    @include('layouts.js')

</body>
</html>
