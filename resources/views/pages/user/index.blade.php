@extends('layouts.guest.app')

@section('title', 'Data Pengguna | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-users me-2"></i>Data Pengguna
                        </h1>
                        <p class="page-subtitle">Kelola data pengguna sistem</p>
                    </div>

                    @if (session('is_logged_in'))
                        <a href="{{ route('user.create') }}" class="btn btn-add">
                            <i class="fas fa-plus me-1"></i>Tambah Pengguna
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-add">
                            <i class="fas fa-sign-in-alt me-1"></i>Tambah Pengguna
                        </a>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- HEADER DI ATAS CARD --}}
            <div class="d-flex justify-content-end mb-2">
                <span class="text-muted">Total: {{ $users->total() }} pengguna</span>
            </div>

            {{-- Search and Filter --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('user.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nama atau email..." value="{{ request('search') }}"
                                        onchange="this.form.submit()">
                                    <button class="btn btn-search" type="submit">
                                        <i class="fas fa-search me-1"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('user.index') }}" method="GET" class="d-flex gap-2">
                                {{-- Hidden untuk menjaga search --}}
                                @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif

                                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">-- Urutkan berdasarkan --</option>
                                    <option value="created_at_desc"
                                        {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>
                                        Tanggal Terbaru
                                    </option>
                                    <option value="created_at_asc"
                                        {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>
                                        Tanggal Terlama
                                    </option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                        Nama A-Z
                                    </option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                        Nama Z-A
                                    </option>
                                </select>

                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">-- Status --</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif</option>
                                </select>

                                @if (request('search') || request('sort') || request('status'))
                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-outline-secondary btn-sm rounded-0 ms-1" title="Reset semua filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if ($users->count() > 0)
                <div class="row">
                    @foreach ($users as $user)
                        @php
                            $inisial1 = strtoupper(substr($user->name, 0, 1));
                            $inisial2 = strtoupper(substr(strstr($user->name, ' ') ?: '', 1, 1));
                            $fotoAda =
                                !empty($user->photo_profile) &&
                                file_exists(public_path('storage/' . $user->photo_profile));
                        @endphp

                        <div class="col-xl-4 col-lg-6 mb-4">
                            <div class="warga-card">
                                <div class="warga-card-header">
                                    {{-- AVATAR FOTO / INISIAL --}}
                                    <div class="warga-avatar overflow-hidden d-flex align-items-center justify-content-center"
                                        style="width:56px;height:56px;border-radius:50%;">
                                        @if ($fotoAda)
                                            <img src="{{ asset('storage/' . $user->photo_profile) }}"
                                                alt="Foto Profil {{ $user->name }}"
                                                style="width:100%;height:100%;object-fit:cover;display:block;">
                                        @else
                                            <img src="{{ asset('assets/images/placeholder-noprofile.png') }}"
                                                alt="Foto Profil {{ $user->name }}"
                                                style="width:100%;height:100%;object-fit:cover;display:block;">
                                        @endif
                                    </div>

                                    <div class="warga-info">
                                        <div class="warga-name">
                                            <i class="fas fa-user me-1"></i>{{ $user->name }}
                                        </div>
                                        <div class="warga-nik">
                                            <i class="fas fa-envelope me-1"></i>Email: {{ $user->email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="warga-card-body">
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-user me-1"></i>Nama Lengkap</div>
                                        <div class="info-value">{{ $user->name }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-envelope me-1"></i>Email</div>
                                        <div class="info-value">{{ $user->email }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-user-shield me-1"></i>Role</div>
                                        <div class="info-value">
                                            {{ ucwords(str_replace('-', ' ', $user->role)) }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-check-circle me-1"></i>Status</div>
                                        <div class="info-value">
                                            @if ($user->is_active)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-ban me-1"></i>Nonaktif
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-calendar-plus me-1"></i>Terdaftar</div>
                                        <div class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-calendar-check me-1"></i>Diperbarui</div>
                                        <div class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                <div class="warga-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-id-card me-1"></i>ID: {{ $user->id }}
                                    </small>

                                    @if (session('is_logged_in'))
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>

                                            @if (Auth::id() !== $user->id)
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete"
                                                        onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($users->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <a href="{{ $users->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                            </a>

                            <span class="text-muted small">
                                Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                            </span>

                            <a href="{{ $users->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h4>Belum ada data pengguna</h4>
                            <p class="mb-4">Silakan tambahkan data pengguna terlebih dahulu</p>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
