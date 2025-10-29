@extends('layouts.app')

@section('title', 'Edit Data Pengguna')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-edit me-2"></i>Edit Data Pengguna
                    </h1>
                    <p class="page-subtitle">Perbarui data pengguna: {{ $user->name }}</p>
                </div>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
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

                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="name" class="form-control search-box"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Masukkan nama lengkap" required>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control search-box"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="Masukkan alamat email" required>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="password" class="form-control search-box"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                    <small class="text-muted">Password minimal 3 karakter dan mengandung huruf kapital</small>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control search-box"
                                           placeholder="Konfirmasi password baru">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Dibuat</label>
                                    <input type="text" class="form-control search-box"
                                           value="{{ $user->created_at->format('d/m/Y H:i') }}" readonly disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Terakhir Diupdate</label>
                                    <input type="text" class="form-control search-box"
                                           value="{{ $user->updated_at->format('d/m/Y H:i') }}" readonly disabled>
                                </div>
                            </div>

                            <div class="warga-card-footer">
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div class="action-buttons">
                                    @if(session('user_id') != $user->id)
                                        <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    @else
                                        <button type="button" class="btn-delete" disabled title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    @endif
                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-save me-1"></i>Update Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
@if(session('user_id') != $user->id)
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data pengguna:</p>
                <p><strong>{{ $user->name }}</strong> (Email: {{ $user->email }})</p>
                <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
