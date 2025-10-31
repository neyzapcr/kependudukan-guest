@extends('layouts.guest.app')

@section('title', 'Login - Sistem Kependudukan')

@section('content')
<div class="bg-bubble"></div>
  <div class="bg-bubble"></div>
  <div class="bg-bubble"></div>

  <div class="login-horizontal-card">
    <div class="login-left-section">
      <div class="login-welcome">
        <div class="login-avatar">
          <i class="fas fa-user"></i>
        </div>
        <h2>Selamat Datang!</h2>
        <p>Silakan masuk ke akun Anda</p>
        <p><small>Sistem Informasi Kependudukan Desa Andromeda</small></p>
      </div>
    </div>

    <div class="login-right-section">
<form class="login-form-horizontal" method="POST" action="{{ route('login.post') }}">
    @csrf

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="form-group-horizontal">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="Masukkan email">
    </div>

    <div class="form-group-horizontal">
        <label for="password">Kata Sandi</label>
        <input id="password" type="password" name="password" class="form-control" required placeholder="Masukkan password">
        <div class="password-hint">Password minimal 3 karakter dan mengandung huruf kapital</div>
    </div>

    <button type="submit" class="btn-search">Masuk</button>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('guest.dashboard.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
        |
        <a href="{{ route('register') }}" class="back-link">Daftar Akun Baru</a>
    </div>
</form>

      <div class="footer-copyright">
        <small><center>Copyright © 2024 Bina Desa. All Rights Reserved.</center></small>
      </div>
    </div>
  </div>
@endsection
