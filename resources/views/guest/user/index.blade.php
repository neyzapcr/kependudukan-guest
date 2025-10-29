@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-users me-2"></i>Data Pengguna
                        </h1>
                        <p class="page-subtitle">Kelola data pengguna sistem</p>
                    </div>

                    <!-- Tombol tambah pengguna -->
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

            <!-- Alert Messages -->
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

            <!-- Search Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <form action="{{ route('user.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nama atau email..." value="{{ request('search') }}">
                                    <button class="btn btn-search" type="submit">
                                        <i class="fas fa-search me-1"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="text-muted">Total: {{ $users->count() }} pengguna</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pengguna Cards -->
            @if ($users->count() > 0)
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-xl-4 col-lg-6 mb-4">
                            <div class="warga-card">
                                <div class="warga-card-header">
                                    <div class="warga-avatar">
                                        {{ substr($user->name, 0, 1) }}{{ substr(strstr($user->name, ' ') ?: '', 1, 1) }}
                                    </div>
                                    <div class="warga-info">
                                        <div class="warga-name">{{ $user->name }}</div>
                                        <div class="warga-nik">Email: {{ $user->email }}</div>
                                    </div>
                                </div>

                                <div class="warga-card-body">
                                    <div class="info-row">
                                        <div class="info-label">Nama Lengkap</div>
                                        <div class="info-value">{{ $user->name }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">{{ $user->email }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Status</div>
                                        <div class="info-value">
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Aktif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Terdaftar</div>
                                        <div class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Diperbarui</div>
                                        <div class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}</div>
                                    </div>
                                </div>

                                <div class="warga-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-id-card me-1"></i>
                                        ID: {{ $user->id }}
                                    </small>

                                    @if (session('is_logged_in'))
                                        <div class="action-buttons">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <button class="btn btn-delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $user->id }}"
                                                {{ Auth::id() === $user->id ? 'disabled' : '' }}>
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus pengguna:</p>
                                        <p><strong>{{ $user->name }}</strong> (Email: {{ $user->email }})</p>
                                        @if(Auth::id() === $user->id)
                                            <p class="text-danger"><strong>Tidak dapat menghapus akun sendiri!</strong></p>
                                        @else
                                            <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($users->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            {{-- Previous --}}
                            <a href="{{ $users->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                            </a>

                            {{-- Page Info --}}
                            <span class="text-muted small">
                                Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                            </span>

                            {{-- Next --}}
                            <a href="{{ $users->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h4>Belum ada data pengguna</h4>
                            <p class="mb-4">Silakan tambahkan data pengguna terlebih dahulu</p>
                            @if (session('is_logged_in'))
                                <a href="{{ route('user.create') }}" class="btn btn-add">
                                    <i class="fas fa-plus me-1"></i>Tambah Pengguna
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
