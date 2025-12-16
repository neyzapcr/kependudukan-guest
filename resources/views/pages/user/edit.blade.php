@extends('layouts.guest.app')

@section('title', 'Edit Pengguna | Sistem Kependudukan')

@section('content')
<div class="main-content">
  <div class="container">

    <div class="page-header mb-3">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="page-title">
            <i class="fas fa-user-edit me-2"></i>Edit Pengguna
          </h1>
          <p class="page-subtitle">Perbarui data pengguna sistem</p>
        </div>

        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
          <i class="fas fa-arrow-left me-1"></i>Kembali
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>Mohon periksa kembali inputan kamu.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="card shadow-sm">
      <div class="card-body">

        <form
    action="{{ auth()->user()->role === 'super-admin'
        ? route('user.update', $user->id)
        : route('user.profile.update') }}"
    method="POST"
    enctype="multipart/form-data"
>

          @csrf
          @method('PUT')

          <div class="row g-4">

            {{-- KOLOM KIRI: FOTO PROFIL --}}
            <div class="col-md-4">
              <div class="p-3 rounded border bg-light">
                <div class="d-flex align-items-center gap-3">
                  <div class="overflow-hidden d-flex align-items-center justify-content-center"
                       style="width:96px;height:96px;border-radius:50%;background:#fff;">
                    @if (!empty($user->photo_profile))
  <img id="photoPreview"
       src="{{ asset('storage/'.$user->photo_profile) }}"
       alt="Foto Profil {{ $user->name }}"
       style="width:100%;height:100%;object-fit:cover;display:block;">
@else
  <img id="photoPreview"
       src="{{ asset('assets/img/placeholder.webp') }}"
       alt="Placeholder Foto Profil"
       style="width:100%;height:100%;object-fit:cover;display:block;opacity:.85;">
@endif

                  </div>

                  <div>
                    <div class="fw-bold">{{ $user->name }}</div>
                    <div class="text-muted small">{{ $user->email }}</div>
                    <div class="text-muted small mt-1">ID: {{ $user->id }}</div>
                  </div>
                </div>

                <hr class="my-3">

                <label class="form-label fw-semibold">Ganti Foto Profil (Opsional)</label>
                <input type="file"
                       name="photo_profile"
                       id="photoInput"
                       class="form-control @error('photo_profile') is-invalid @enderror"
                       accept="image/*">
                @error('photo_profile')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="text-muted small mt-2">
                  Format: JPG/PNG/WEBP. Maks: 2MB.
                </div>
              </div>
            </div>

            {{-- KOLOM KANAN: DATA USER --}}
            <div class="col-md-8">

              <div class="row g-3">

                <div class="col-12">
                  <label class="form-label fw-semibold">Nama Lengkap</label>
                  <input type="text"
                         name="name"
                         class="form-control @error('name') is-invalid @enderror"
                         value="{{ old('name', $user->name) }}"
                         placeholder="Masukkan nama lengkap">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-12">
                  <label class="form-label fw-semibold">Email</label>
                  <input type="email"
                         name="email"
                         class="form-control @error('email') is-invalid @enderror"
                         value="{{ old('email', $user->email) }}"
                         placeholder="Masukkan email">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Role</label>
                  <select name="role" class="form-select @error('role') is-invalid @enderror">
                    @php
                      $roles = [
                        'super-admin'   => 'Super Admin',
                        'administrator' => 'Administrator',
                        'admin'         => 'Admin',
                        'petugas'       => 'Petugas',
                        'warga'         => 'Warga',
                      ];
                      $selectedRole = old('role', $user->role);
                    @endphp

                    @foreach ($roles as $val => $label)
                      <option value="{{ $val }}" {{ $selectedRole === $val ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                  @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Status</label>
                  @php $selectedStatus = old('is_active', $user->is_active); @endphp
                  <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                    <option value="1" {{ (string)$selectedStatus === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ (string)$selectedStatus === '0' ? 'selected' : '' }}>Nonaktif</option>
                  </select>
                  @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                  <input type="password"
                         name="password"
                         class="form-control @error('password') is-invalid @enderror"
                         placeholder="Isi jika ingin mengganti">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  <div class="text-muted small mt-1">Minimal 3 karakter & mengandung huruf kapital.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Konfirmasi Password</label>
                  <input type="password"
                         name="password_confirmation"
                         class="form-control"
                         placeholder="Ulangi password baru">
                </div>

              </div>

              <hr class="my-4">

              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                  Batal
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save me-1"></i>Simpan Perubahan
                </button>
              </div>

            </div>
          </div>
        </form>

      </div>
    </div>

  </div>
</div>

{{-- Preview foto sebelum submit --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("photoInput");
    const preview = document.getElementById("photoPreview");
    if (!input || !preview) return;

    input.addEventListener("change", function (e) {
      const file = e.target.files && e.target.files[0];
      if (!file) return;

      // validasi ringan di client (tetap validasi server wajib)
      if (!file.type.startsWith("image/")) return;

      const url = URL.createObjectURL(file);
      preview.src = url;
      preview.style.opacity = "1";
    });
  });
</script>
@endsection
