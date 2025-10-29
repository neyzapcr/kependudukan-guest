<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('guest.dashboard.index') }}" class="logo">
                        <h1>Bina Desa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ route('warga.index') }}"
                                class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">Data Warga</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('keluarga.index') }}"
                                class="{{ request()->routeIs('keluarga.*') ? 'active' : '' }}">Data Keluarga</a>
                        </li>
                        @if (session('is_logged_in'))
                            <li class="scroll-to-section">
                                <a href="{{ route('user.index') }}"
                                    class="{{ request()->routeIs('user.*') ? 'active' : '' }}">Data User</a>
                            </li>
                        @endif
                        <li class="scroll-to-section">
                            <a href="#team">Team</a>
                        </li>

                        @if (session('is_logged_in'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown">
                                    <i class="fas fa-user me-1"></i> {{ session('username') }}
                                </a>
                                <ul class="dropdown-menu" id="userDropdownMenu">
                                    <li>
                                        <span class="dropdown-header">
                                            <i class="fas fa-user me-2"></i>
                                            {{ session('username') }}
                                        </span>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item" id="logout-btn">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="scroll-to-section auth-links">
                                <a href="{{ route('login') }}" class="btn-login">
                                    <i class="fas fa-sign-in-alt me-1"></i> Masuk
                                </a>
                                <span class="separator">|</span>
                                <a href="{{ route('register') }}" class="btn-register">
                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                </a>
                            </li>
                        @endif
                    </ul>

                    <a class='menu-trigger'>
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Form Logout (Hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
