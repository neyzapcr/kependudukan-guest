@extends('layouts.guest.app')

@section('title', 'Data Anggota Keluarga | Sistem Kependudukan')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-1">
            <div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">
            <i class="fas fa-users me-2"></i>Anggota Keluarga
        </h1>
        <p class="page-subtitle">
            Data anggota untuk No. KK: <strong>{{ $kk->kk_nomor }}</strong>
        </p>
    </div>

    {{-- WRAPPER tombol --}}
    <div class="d-flex align-items-center gap-2">
        @if (session('is_logged_in'))
            <a href="{{ route('anggota.create', $kk->kk_id) }}" class="btn btn-add">
                <i class="fas fa-plus me-1"></i>Tambah Anggota
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-add">
                <i class="fas fa-sign-in-alt me-1"></i>Tambah Anggota
            </a>
        @endif

        <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali ke KK
        </a>
    </div>
</div>

        </div>

        {{-- Alert Messages --}}
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

        {{-- Header total --}}
        <div class="d-flex justify-content-end mb-2">
            <span class="text-muted">Total: {{ $anggota->total() }} anggota</span>
        </div>

        {{-- Search & Filter --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">

                    {{-- Search --}}
                    <div class="col-md-6">
                        <form action="{{ route('anggota.index', $kk->kk_id) }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search"
                                    class="form-control search-box"
                                    placeholder="Cari nama, NIK, alamat, atau hubungan..."
                                    value="{{ request('search') }}"
                                    onchange="this.form.submit()">
                                <button class="btn btn-search" type="submit">
                                    <i class="fas fa-search me-1"></i>Cari
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Filters + Sort --}}
                    <div class="col-md-6">
                        <form action="{{ route('anggota.index', $kk->kk_id) }}" method="GET" class="d-flex gap-2">

                            {{-- keep search --}}
                            @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif

                            {{-- hubungan --}}
                            <select name="hubungan" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Hubungan</option>
                                <option value="Kepala Keluarga" {{ request('hubungan')=='Kepala Keluarga' ? 'selected':'' }}>
                                    Kepala Keluarga
                                </option>
                                <option value="Istri" {{ request('hubungan')=='Istri' ? 'selected':'' }}>Istri</option>
                                <option value="Suami" {{ request('hubungan')=='Suami' ? 'selected':'' }}>Suami</option>
                                <option value="Anak" {{ request('hubungan')=='Anak' ? 'selected':'' }}>Anak</option>
                                <option value="Orang Tua" {{ request('hubungan')=='Orang Tua' ? 'selected':'' }}>Orang Tua</option>
                                <option value="Lainnya" {{ request('hubungan')=='Lainnya' ? 'selected':'' }}>Lainnya</option>
                            </select>

                            {{-- jenis kelamin --}}
                            <select name="jenis_kelamin" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua JK</option>
                                <option value="L" {{ request('jenis_kelamin')=='L' ? 'selected':'' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin')=='P' ? 'selected':'' }}>Perempuan</option>
                            </select>

                            {{-- agama --}}
                            <select name="agama" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Semua Agama</option>
                                <option value="Islam" {{ request('agama')=='Islam' ? 'selected':'' }}>Islam</option>
                                <option value="Kristen" {{ request('agama')=='Kristen' ? 'selected':'' }}>Kristen</option>
                                <option value="Katolik" {{ request('agama')=='Katolik' ? 'selected':'' }}>Katolik</option>
                                <option value="Hindu" {{ request('agama')=='Hindu' ? 'selected':'' }}>Hindu</option>
                                <option value="Buddha" {{ request('agama')=='Buddha' ? 'selected':'' }}>Buddha</option>
                                <option value="Konghucu" {{ request('agama')=='Konghucu' ? 'selected':'' }}>Konghucu</option>
                            </select>

                            {{-- pekerjaan --}}
                            <input type="text" name="pekerjaan"
                                class="form-control form-control-sm"
                                placeholder="Pekerjaan"
                                value="{{ request('pekerjaan') }}"
                                onchange="this.form.submit()">


                            {{-- reset --}}
                            @if (request('search') || request('hubungan') || request('jenis_kelamin') || request('agama') || request('pekerjaan') || request('sort'))
                                <a href="{{ route('anggota.index', $kk->kk_id) }}"
                                    class="btn btn-outline-secondary btn-sm rounded-0 ms-1"
                                    title="Reset semua filter">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cards --}}
        @if ($anggota->count() > 0)
            <div class="row">
                @foreach ($anggota as $item)
                    @php
                        $isKepala = strtolower($item->hubungan) === 'kepala keluarga';
                        $jk = $item->warga->jenis_kelamin ?? '';
                    @endphp

                    <div class="col-xl-4 col-lg-6 mb-4">
                        <div class="warga-card">
                            <div class="warga-card-header">
                                <div class="warga-avatar">
                                    {{ substr($item->warga->nama ?? '-', 0, 1) }}
                                    {{ substr(strstr($item->warga->nama ?? '', ' ') ?: '', 1, 1) }}
                                </div>
                                <div class="warga-info">
                                    <div class="warga-name">
                                        <i class="fas fa-user me-1"></i>{{ $item->warga->nama ?? '-' }}
                                    </div>
                                    <div class="warga-nik">
                                        <i class="fas fa-id-card me-1"></i>NIK: {{ $item->warga->no_ktp ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="warga-card-body">
                                {{-- Hubungan badge --}}
                                <div class="info-row">
                                    <div class="info-label"><i class="fas fa-link me-1"></i>Hubungan</div>
                                    <div class="info-value d-flex gap-1 flex-wrap">
                                        <span class="badge bg-primary rounded-pill px-3 py-1 small fw-semibold">
                                            {{ $item->hubungan }}
                                        </span>

                                        {{-- Kepala keluarga L + ada istri --}}
                                        @if ($isKepala && $jk === 'L' && $hasIstri)
                                            <span class="badge bg-primary rounded-pill px-3 py-1 small fw-semibold">
                                                Suami
                                            </span>
                                        @endif

                                        {{-- Kepala keluarga P + ada suami --}}
                                        @if ($isKepala && $jk === 'P' && $hasSuami)
                                            <span class="badge bg-primary rounded-pill px-3 py-1 small fw-semibold">
                                                Istri
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Jenis kelamin --}}
                                <div class="info-row">
                                    <div class="info-label"><i class="fas fa-venus-mars me-1"></i>Jenis Kelamin</div>
                                    <div class="info-value">
                                        <span class="{{ $jk === 'L' ? 'gender-male' : 'gender-female' }}">
                                            <i class="fas fa-{{ $jk === 'L' ? 'mars' : 'venus' }} me-1"></i>
                                            {{ $jk === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label"><i class="fas fa-praying-hands me-1"></i>Agama</div>
                                    <div class="info-value">{{ $item->warga->agama ?? '-' }}</div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label"><i class="fas fa-briefcase me-1"></i>Pekerjaan</div>
                                    <div class="info-value">{{ $item->warga->pekerjaan ?? '-' }}</div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label"><i class="fas fa-map-marker-alt me-1"></i>Alamat</div>
                                    <div class="info-value">{{ Str::limit($item->warga->alamat ?? '-', 50) }}</div>
                                </div>
                            </div>

                            <div class="warga-card-footer">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $item->created_at->format('d/m/Y') }}
                                </small>

                                @if (session('is_logged_in'))
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('anggota.edit', $item->anggota_id) }}" class="btn btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>

                                        <form action="{{ route('anggota.destroy', $item->anggota_id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete"
                                                onclick="return confirm('Yakin hapus anggota ini?')">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($anggota->hasPages())
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <a href="{{ $anggota->previousPageUrl() }}"
                            class="btn btn-outline-primary btn-sm {{ $anggota->onFirstPage() ? 'disabled' : '' }}">
                            <i class="fas fa-arrow-left me-1"></i>Sebelumnya
                        </a>

                        <span class="text-muted small">
                            Halaman {{ $anggota->currentPage() }} dari {{ $anggota->lastPage() }}
                        </span>

                        <a href="{{ $anggota->nextPageUrl() }}"
                            class="btn btn-outline-primary btn-sm {{ !$anggota->hasMorePages() ? 'disabled' : '' }}">
                            Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endif

        @else
            {{-- Empty state --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <h4>Belum ada anggota keluarga</h4>
                        <p class="mb-4">Silakan tambahkan anggota keluarga terlebih dahulu</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
