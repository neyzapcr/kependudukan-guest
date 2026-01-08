@extends('layouts.guest.app')

@section('title', 'Data Kartu Keluarga | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-home me-2"></i>Data Kartu Keluarga
                        </h1>
                        <p class="page-subtitle">Kelola data kartu keluarga di lingkungan Anda</p>
                    </div>

                    <!-- Tombol tambah KK -->
                    @if (session('is_logged_in'))
                        <a href="{{ route('keluarga.create') }}" class="btn btn-add">
                            <i class="fas fa-plus me-1"></i>Tambah KK
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-add">
                            <i class="fas fa-sign-in-alt me-1"></i>Tambah KK
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

            {{-- HEADER DI ATAS CARD (mirip warga.index) --}}
            <div class="d-flex justify-content-end mb-2">
                <span class="text-muted">Total: {{ $kk->total() }} KK</span>
            </div>

            <!-- Search and Sort Section (mirip warga.index) -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        {{-- Search --}}
                        <div class="col-md-6">
                            <form action="{{ route('keluarga.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nomor KK, nama kepala keluarga, atau alamat..."
                                        value="{{ request('search') }}" onchange="this.form.submit()">
                                    <button class="btn btn-search" type="submit">
                                        <i class="fas fa-search me-1"></i>Cari
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Sort 1 dropdown --}}
                        <div class="col-md-6">
                            <form action="{{ route('keluarga.index') }}" method="GET" class="d-flex gap-2">

                                {{-- keep search --}}
                                @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif

                                {{-- FILTER RT --}}
                                <input type="text" name="rt" class="form-control form-control-sm"
                                    placeholder="RT (contoh 012)" value="{{ request('rt') }}" onchange="this.form.submit()">

                                {{-- FILTER RW --}}
                                <input type="text" name="rw" class="form-control form-control-sm"
                                    placeholder="RW (contoh 003)" value="{{ request('rw') }}"
                                    onchange="this.form.submit()">

                                {{-- FILTER JUMLAH ANGGOTA (kelompok) --}}
                                <select name="anggota_range" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Anggota</option>
                                    <option value="1-3" {{ request('anggota_range') == '1-3' ? 'selected' : '' }}>
                                        1 - 3 orang
                                    </option>
                                    <option value="4-6" {{ request('anggota_range') == '4-6' ? 'selected' : '' }}>
                                        4 - 6 orang
                                    </option>
                                    <option value="7+" {{ request('anggota_range') == '7+' ? 'selected' : '' }}>
                                        7+ orang
                                    </option>
                                </select>

                                {{-- SORT (opsional tetap ada) --}}
                                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Urutkan Berdasarkan</option>
                                    <option value="created_at_desc"
                                        {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Tanggal Terbaru</option>
                                    <option value="created_at_asc"
                                        {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Tanggal Terlama</option>
                                    <option value="kk_nomor_asc" {{ request('sort') == 'kk_nomor_asc' ? 'selected' : '' }}>
                                        No KK Kecil - Besar</option>
                                    <option value="kk_nomor_desc" {{ request('sort') == 'kk_nomor_desc' ? 'selected' : '' }}>
                                        No KK Besar -  Kecil</option>
                                    <option value="kepala_nama_asc"
                                        {{ request('sort') == 'kepala_nama_asc' ? 'selected' : '' }}>Kepala Keluarga A-Z
                                    </option>
                                    <option value="kepala_nama_desc"
                                        {{ request('sort') == 'kepala_nama_desc' ? 'selected' : '' }}>Kepala Keluarga Z-A
                                    </option>
                                </select>

                                {{-- RESET --}}
                                @if (request('search') || request('sort') || request('rt') || request('rw') || request('anggota_range'))
                                    <a href="{{ route('keluarga.index') }}"
                                        class="btn btn-outline-secondary btn-sm rounded-0 ms-1" title="Reset semua filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Kartu Keluarga Cards -->
            @if ($kk->count() > 0)
                <div class="row">
                    @foreach ($kk as $data)
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="keluarga-card">
                                <div class="keluarga-card-header">
                                    <div class="keluarga-avatar">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="keluarga-info">
                                        <div class="keluarga-name">
                                            <i class="fas fa-user me-1"></i>
                                            Keluarga {{ $data->kepalaKeluarga->nama ?? 'Belum Ada' }}
                                        </div>
                                        <div class="keluarga-nomor">
                                            <i class="fas fa-id-card me-1"></i>No. KK: {{ $data->kk_nomor }}
                                        </div>
                                    </div>
                                </div>

                                <div class="keluarga-card-body">
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-user me-1"></i>Kepala Keluarga</div>
                                        <div class="info-value">
                                            <strong>{{ $data->kepalaKeluarga->nama ?? '-' }}</strong>
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-map-marker-alt me-1"></i>Alamat</div>
                                        <div class="info-value">{{ $data->alamat ?: '-' }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-home me-1"></i>RT/RW</div>
                                        <div class="info-value">{{ $data->rt }}/{{ $data->rw }}</div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-users me-1"></i>Jumlah Anggota</div>
                                        <div class="info-value">
                                            <span class="badge bg-primary">{{ $data->anggotaKeluarga->count() }}
                                                orang</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="keluarga-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $data->created_at->format('d/m/Y') }}
                                    </small>

                                    <div class="action-buttons d-flex gap-2">
                                        <a href="{{ route('anggota.index', $data->kk_id) }}" class="btn btn-edit">
                                            <i class="fas fa-users me-1"></i>Lihat Anggota
                                        </a>

                                        @if (session('is_logged_in'))
                                            <a href="{{ route('keluarga.edit', $data->kk_id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            
                                            <form action="{{ route('keluarga.destroy', $data->kk_id) }}" method="POST"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Yakin hapus data keluarga ini?')">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination mirip warga.index --}}
                @if ($kk->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <a href="{{ $kk->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $kk->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                            </a>

                            <span class="text-muted small">
                                Halaman {{ $kk->currentPage() }} dari {{ $kk->lastPage() }}
                            </span>

                            <a href="{{ $kk->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$kk->hasMorePages() ? 'disabled' : '' }}">
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
                            <i class="fas fa-home"></i>
                            <h4>Belum ada data kartu keluarga</h4>
                            <p class="mb-4">Silakan tambahkan data kartu keluarga terlebih dahulu</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
