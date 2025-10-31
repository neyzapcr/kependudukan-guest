<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('guest.dashboard.index') }}" class="logo">
                        <i class="fas fa-home me-2"></i>
                        <h1>Bina Desa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ route('warga.index') }}"
                                class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                                <i class="fas fa-users me-2"></i>Data Warga
                            </a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('keluarga.index') }}"
                                class="{{ request()->routeIs('keluarga.*') ? 'active' : '' }}">
                                <i class="fas fa-house-user me-2"></i>Data Keluarga
                            </a>
                        </li>

                        <li class="scroll-to-section">
                            <a href="{{ route('guest.about') }}"
                                class="{{ request()->routeIs('guest.about') ? 'active' : '' }}">
                                <i class="fas fa-info-circle me-2"></i>Tentang Kami
                            </a>
                        </li>

                        <!-- Data User hanya muncul jika sudah login -->

                        <li class="scroll-to-section">
                            <a href="{{ route('user.index') }}"
                                class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog me-2"></i>Data User
                            </a>
                        </li>



                        <!-- Auth Section -->
                        <!-- Auth Section -->
                        <!-- Data User hanya muncul jika sudah login -->
@if(session('is_logged_in'))
    <li class="scroll-to-section">
        <a href="{{ route('user.index') }}"
           class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="fas fa-user-cog me-2"></i>Data User
        </a>
    </li>
@endif

<!-- Auth Section -->
@if(session('is_logged_in'))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
           data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
            <i class="fa-regular fa-circle-user me-1" style="color: #4882e5;"></i>
            <span class="username">{{ session('username') }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
                <div class="dropdown-header text-dark">
                    <i class="fa-solid fa-user me-1" style="color: #296ce0;"></i>
                    {{ session('username') }}
                </div>
            </li>
            <li><hr class="dropdown-divider m-0"></li>
            <li>
                <a class="dropdown-item" href="{{ route('user.edit', ['user' => session('user_id')]) }}" style="color: #333 !important;">
                    <i class="fas fa-user-edit me-2"></i>Edit Profil
                </a>
            </li>
            <li><hr class="dropdown-divider m-0"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger logout-btn" style="border: none; background: none; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
@else
    <li class="scroll-to-section auth-links">
        <a href="{{ route('login') }}" class="btn-login">
            <i class="fas fa-sign-in-alt me-1"></i>Masuk
        </a>
        <span class="separator">|</span>
        <a href="{{ route('register') }}" class="btn-register">
            <i class="fas fa-user-plus me-1"></i>Daftar
        </a>
    </li>
@endif


                        <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
