@extends('layouts.guest.app')

@section('title', 'Edit Pengguna | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- HEADER --}}
            <div class="page-header mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-user-edit me-2"></i>Edit Pengguna
                        </h1>
                        <p class="page-subtitle">Perbarui data pengguna sistem</p>
                    </div>

                    @if (auth()->user()->role === 'super-admin')
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    @else
                        <a href="{{ route('pages.dashboard.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    @endif
                </div>
            </div>

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>Mohon periksa kembali inputan kamu.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- FORM UPDATEEE --}}
                    <form
                        action="{{ auth()->user()->role === 'super-admin' ? route('user.update', $user->id) : route('user.profile.update') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            {{-- KOLOM KIRI --}}
                            <div class="col-md-4">
                                <div class="p-3 rounded border bg-light">
                                    <div class="d-flex align-items-center gap-4">

                                        {{-- FOTO PROFIL --}}
                                        <div class="photo-wrapper">
                                            <img id="photoPreview"
                                                src="{{ !empty($user->photo_profile)
                                                    ? asset('storage/' . $user->photo_profile)
                                                    : asset('assets/images/placeholder-noprofile.png') }}"
                                                alt="Foto Profil">

                                            @if (!empty($user->photo_profile))
                                                <button type="button" class="btn-delete-photo"
                                                    data-action="{{ auth()->user()->role === 'super-admin'
                                                        ? route('user.photo.delete', $user->id)
                                                        : route('user.profile.photo.delete') }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>

                                        <div class="profile-info">
                                            <div class="name">{{ $user->name }}</div>
                                            <div class="email">{{ $user->email }}</div>
                                            <div class="text-muted small mt-1">ID: {{ $user->id }}</div>
                                        </div>

                                    </div>

                                    <hr class="my-3">

                                    <label class="form-label fw-semibold">Ganti Foto Profil (Opsional)</label>
                                    <input type="file" name="photo_profile" id="photoInput"
                                        class="form-control @error('photo_profile') is-invalid @enderror" accept="image/*">
                                    @error('photo_profile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="text-muted small mt-2">
                                        JPG / PNG / WEBP — Maks 2MB
                                    </div>
                                </div>
                            </div>

                            {{-- KOLOM KANAN --}}
                            <div class="col-md-8">
                                <div class="row g-3">

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Role</label>
                                        <select name="role" class="form-select">
                                            @foreach (['super-admin', 'administrator', 'admin', 'petugas', 'warga'] as $r)
                                                <option value="{{ $r }}"
                                                    {{ $user->role === $r ? 'selected' : '' }}>
                                                    {{ ucfirst(str_replace('-', ' ', $r)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="is_active" class="form-select">
                                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Password Baru</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ auth()->user()->role === 'super-admin' ? route('user.index') : route('pages.dashboard.index') }}"
                                        class="btn btn-outline-secondary">Batal</a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

                    {{-- FORM HAPUS FOTO (HIDDEN) --}}
                    <form id="deletePhotoForm" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // preview foto
            const input = document.getElementById("photoInput");
            const preview = document.getElementById("photoPreview");
            if (input && preview) {
                input.addEventListener("change", e => {
                    const f = e.target.files[0];
                    if (!f || !f.type.startsWith("image/")) return;
                    preview.src = URL.createObjectURL(f);
                });
            }

            // hapus foto
            const btn = document.querySelector('.btn-delete-photo');
            const form = document.getElementById('deletePhotoForm');

            if (btn && form) {
                btn.addEventListener('click', () => {
                    if (!confirm('Hapus foto profil?')) return;
                    form.action = btn.dataset.action;
                    form.submit();
                });
            }
        });
    </script>
@endsection
