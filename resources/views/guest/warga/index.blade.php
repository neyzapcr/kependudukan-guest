@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-users me-2"></i>Data Warga
                        </h1>
                        <p class="page-subtitle">Kelola data kependudukan warga</p>
                    </div>

                    <!-- Tombol tambah warga -->
                    @if (session('is_logged_in'))
                        <a href="{{ route('guest.warga.create') }}" class="btn btn-add">
                            <i class="fas fa-plus me-1"></i>Tambah Warga
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-add">
                            <i class="fas fa-sign-in-alt me-1"></i>Tambah Warga
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

            <!-- Search and Filter Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <form action="{{ route('warga.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nama, NIK, atau alamat..." value="{{ request('search') }}">
                                    <button class="btn btn-search" type="submit">
                                        <i class="fas fa-search me-1"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="text-muted">Total: {{ $warga->count() }} warga</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Warga Cards -->
            @if ($warga->count() > 0)
                <div class="row">
                    @foreach ($warga as $data)
                        <div class="col-xl-4 col-lg-6 mb-4">
                            <div class="warga-card">
                                <div class="warga-card-header">
                                    <div class="warga-avatar">
                                        {{ substr($data->nama, 0, 1) }}{{ substr(strstr($data->nama, ' ') ?: '', 1, 1) }}
                                    </div>
                                    <div class="warga-info">
                                        <div class="warga-name">{{ $data->nama }}</div>
                                        <div class="warga-nik">NIK: {{ $data->no_ktp }}</div>
                                    </div>
                                </div>

                                <div class="warga-card-body">
                                    <div class="info-row">
                                        <div class="info-label">Jenis Kelamin</div>
                                        <div class="info-value">
                                            <span
                                                class="{{ $data->jenis_kelamin == 'L' ? 'gender-male' : 'gender-female' }}">
                                                <i
                                                    class="fas fa-{{ $data->jenis_kelamin == 'L' ? 'mars' : 'venus' }} me-1"></i>
                                                {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Agama</div>
                                        <div class="info-value">{{ $data->agama }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Pekerjaan</div>
                                        <div class="info-value">{{ $data->pekerjaan }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">No. Telepon</div>
                                        <div class="info-value">{{ $data->telp }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">{{ $data->email ?: '-' }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Alamat</div>
                                        <div class="info-value">{{ Str::limit($data->alamat, 50) ?: '-' }}</div>
                                    </div>
                                </div>

                                <div class="warga-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $data->created_at->format('d/m/Y') }}
                                    </small>

                                    @if (session('is_logged_in'))
                                        <div class="action-buttons">
                                            <a href="{{ route('guest.warga.edit', $data->warga_id) }}"
                                                class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <button class="btn btn-delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $data->warga_id }}">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="deleteModal{{ $data->warga_id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus data warga:</p>
                                        <p><strong>{{ $data->nama }}</strong> (NIK: {{ $data->no_ktp }})</p>
                                        <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('warga.destroy', $data->warga_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->

                @if ($warga->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            {{-- Previous --}}
                            <a href="{{ $warga->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $warga->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                            </a>

                            {{-- Page Info --}}
                            <span class="text-muted small">
                                Halaman {{ $warga->currentPage() }} dari {{ $warga->lastPage() }}
                            </span>

                            {{-- Next --}}
                            <a href="{{ $warga->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$warga->hasMorePages() ? 'disabled' : '' }}">
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
                            <h4>Belum ada data warga</h4>
                            <p class="mb-4">Silakan tambahkan data warga terlebih dahulu</p>
                            @if (session('is_logged_in'))
                                <a href="{{ route('guest.warga.create') }}" class="btn btn-add">
                                    <i class="fas fa-plus me-1"></i>Tambah Warga
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

