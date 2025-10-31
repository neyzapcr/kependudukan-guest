@extends('layouts.guest.app')

@section('title', 'Data Kartu Keluarga')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
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
                        <form action="{{ route('keluarga.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-box"
                                       placeholder="Cari nomor KK, nama kepala keluarga, atau alamat..."
                                       value="{{ request('search') }}">
                                <button class="btn btn-search" type="submit">
                                    <i class="fas fa-search me-1"></i>Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="text-muted"><i class="fas fa-layer-group me-1"></i>Total: {{ $kk->count() }} KK</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Kartu Keluarga Cards -->
        @if($kk->count() > 0)
            <div class="row">
                @foreach($kk as $data)
                <div class="col-xl-6 col-lg-6 mb-4">
                    <div class="keluarga-card">
                        <div class="keluarga-card-header">
                            <div class="keluarga-avatar">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="keluarga-info">
                                <div class="keluarga-name"><i class="fas fa-user me-1"></i>Keluarga {{ $data->kepalaKeluarga->nama ?? 'Belum Ada' }}</div>
                                <div class="keluarga-nomor"><i class="fas fa-id-card me-1"></i>No. KK: {{ $data->kk_nomor }}</div>
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
                                    <span class="badge bg-primary">{{ $data->anggotaKeluarga->count() }} orang</span>
                                </div>
                            </div>
                        </div>

                        <div class="keluarga-card-footer">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $data->created_at->format('d/m/Y') }}
                            </small>

                            <div class="action-buttons">
                                <a href="{{ route('anggota.index', $data->kk_id) }}" class="btn btn-edit">
                                    <i class="fas fa-users me-1"></i>Lihat Anggota
                                </a>

                                @if (session('is_logged_in'))
                                    <a href="{{ route('keluarga.edit', $data->kk_id) }}" class="btn btn-edit">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <button class="btn btn-delete" data-id="{{ $data->kk_id }}">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="empty-state">
                        <i class="fas fa-home"></i>
                        <h4>Belum ada data kartu keluarga</h4>
                        <p class="mb-4">Silakan tambahkan data kartu keluarga terlebih dahulu</p>
                        @if (session('is_logged_in'))
                            <a href="{{ route('keluarga.create') }}" class="btn btn-add">
                                <i class="fas fa-plus me-1"></i>Tambah KK
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

