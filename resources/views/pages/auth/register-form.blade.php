@extends('layouts.guest.app')

@section('title', 'Daftar | Sistem Kependudukan')

@section('content')
    <div class="bg-bubble"></div>
    <div class="bg-bubble"></div>
    <div class="bg-bubble"></div>

    <div class="login-horizontal-card">
        <div class="login-left-section">
            <div class="login-welcome">
                <div class="login-avatar">
                    <img src="{{ asset('assets/images/logo-vertikal.png') }}" alt="Avatar" class="avatar-img">
                </div>

                <h2>Daftar Akun Baru</h2>
                <p>Buat akun untuk mengakses sistem</p>
                <p><small>Sistem Informasi Kependudukan Desa Andromeda</small></p>
            </div>
        </div>

        <div class="login-right-section">
            <form class="login-form-horizontal" method="POST" action="{{ route('register.post') }}">
                @csrf

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
<div class="form-grid">
  <div class="form-group-horizontal">
    <label for="name">Nama Lengkap</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control"
      required placeholder="Masukkan nama lengkap">
  </div>

  <div class="form-group-horizontal">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control"
      required placeholder="Masukkan alamat email">
  </div>

  <div class="form-group-horizontal">
    <label for="password">Kata Sandi</label>
    <input id="password" type="password" name="password" class="form-control" required
      placeholder="Masukkan password">
    <div class="password-hint">Password minimal 3 karakter dan mengandung huruf kapital</div>
  </div>

  <div class="form-group-horizontal">
    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
      required placeholder="Masukkan ulang password">
  </div>
</div>


                <button type="submit" class="btn-search">Daftar</button>

                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </form>

            <div class="footer-copyright">
                <small>
                    <center>Copyright © 2025 Bina Desa. All Rights Reserved.</center>
                </small>
            </div>
        </div>
    </div>

@endsection
