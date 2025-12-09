@extends('layouts.guest.app')

@section('title', 'Edit Data Pengguna | Sistem Kependudukan')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>Edit Data Pengguna
            </h1>
            <p class="page-subtitle">Perbarui data pengguna: {{ $user->name }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="warga-card">
                    <div class="warga-card-header">
                        <div class="warga-avatar">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="warga-info">
                            <div class="warga-name">Form Edit Data Pengguna</div>
                            <div class="warga-nik">Perbarui data dengan informasi yang valid</div>
                        </div>
                    </div>

                    <div class="warga-card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5 class="alert-heading">Terjadi Kesalahan:</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ Auth::user()->role === 'super-admin'
                                            ? route('user.update', $user->id)
                                            : route('user.profile.update') }}">
                            @csrf
                            @method('PUT')

                            {{-- NAME + EMAIL --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i>Nama Lengkap *
                                    </label>
                                    <input type="text" name="name" class="form-control search-box"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Masukkan nama lengkap" required>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email *
                                    </label>
                                    <input type="email" name="email" class="form-control search-box"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="Masukkan alamat email" required>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- ROLE + STATUS (SUPER ADMIN ONLY) --}}
                            @if (Auth::user()->role === 'super-admin')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-user-shield me-1"></i>Role *
                                        </label>
                                        <select name="role" class="form-select search-box" required>
                                            <option value="">-- Pilih Role --</option>
                                            <option value="super-admin" {{ old('role', $user->role) == 'super-admin' ? 'selected' : '' }}>
                                                Super Admin
                                            </option>
                                            <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>
                                                Administrator
                                            </option>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                                                Petugas
                                            </option>
                                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>
                                                Warga
                                            </option>
                                        </select>
                                        @error('role')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-toggle-on me-1"></i>Status *
                                        </label>
                                        <select name="is_active" class="form-select search-box" required>
                                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                                                Nonaktif
                                            </option>
                                        </select>
                                        @error('is_active')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            {{-- PASSWORD --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-key me-1"></i>Password Baru
                                    </label>
                                    <input type="password" name="password" class="form-control search-box"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <small class="text-muted">
                                        Password minimal 3 karakter dan mengandung huruf kapital
                                    </small>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-key me-1"></i>Konfirmasi Password Baru
                                    </label>
                                    <input type="password" name="password_confirmation" class="form-control search-box"
                                           placeholder="Konfirmasi password baru">
                                </div>
                            </div>

                            {{-- CREATED / UPDATED --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-plus me-1"></i>Tanggal Dibuat
                                    </label>
                                    <input type="text" class="form-control search-box"
                                           value="{{ $user->created_at->format('d/m/Y H:i') }}" readonly disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-check me-1"></i>Terakhir Diupdate
                                    </label>
                                    <input type="text" class="form-control search-box"
                                           value="{{ $user->updated_at->format('d/m/Y H:i') }}" readonly disabled>
                                </div>
                            </div>

                            {{-- FOOTER BUTTONS --}}
                            <div class="warga-card-footer">
                                <a href="{{ Auth::user()->role === 'super-admin'
                                            ? route('user.index')
                                            : route('pages.dashboard.index') }}"
                                   class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>

                                <div class="action-buttons">
                                    @if (Auth::user()->role === 'super-admin')
                                        @if (session('user_id') != $user->id)
                                            <button type="button" class="btn-delete" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        @else
                                            <button type="button" class="btn-delete" disabled
                                                    title="Tidak dapat menghapus akun sendiri">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        @endif
                                    @endif

                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-save me-1"></i>Update Data
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div> {{-- warga-card-body --}}
                </div> {{-- warga-card --}}
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL (SUPER ADMIN ONLY & NOT SELF) --}}
@if (Auth::user()->role === 'super-admin' && session('user_id') != $user->id)
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-trash me-1"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data pengguna:</p>
                    <p><strong>{{ $user->name }}</strong> (Email: {{ $user->email }})</p>
                    <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
