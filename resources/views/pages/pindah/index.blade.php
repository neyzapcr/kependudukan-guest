@extends('layouts.guest.app')

@section('title', 'Data Pindah | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-route me-2"></i>Data Pindah
                        </h1>
                        <p class="page-subtitle">
                            Kelola data kepindahan warga. Klik detail untuk informasi lengkap.
                        </p>
                    </div>

                    {{-- Tombol Tambah Data --}}
                    @if (session('is_logged_in'))
                        <a href="{{ route('pindah.create') }}" class="btn btn-add">
                            <i class="fas fa-plus me-1"></i>Tambah Data Pindah
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-add">
                            <i class="fas fa-sign-in-alt me-1"></i>Tambah Data Pindah
                        </a>
                    @endif
                </div>
            </div>

            {{-- ALERT MESSAGE --}}
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

            {{-- TOTAL DATA DI KANAN --}}
            <div class="d-flex justify-content-end mb-2">
                <span class="text-muted">Total: {{ $pindah->total() }} Pindah</span>
            </div>

            {{-- SEARCH + FILTER --}}
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">

                        {{-- FORM SEARCH + FILTER --}}
                        <form action="{{ route('pindah.index') }}" method="GET" class="flex-grow-1">
                            <div class="d-flex flex-column flex-xl-row gap-2">

                                {{-- SEARCH BOX BESAR --}}
                                <div class="input-group flex-grow-1">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nama warga, alamat tujuan, alasan, atau no surat..."
                                        value="{{ request('search') }}">
                                    <button class="btn btn-search">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </div>

                                {{-- FILTER ALAMAT TUJUAN (opsional) --}}
                                <input type="text" name="alamat_tujuan" class="form-control form-control-sm flex-grow-0"
                                    style="max-width: 220px;" placeholder="Alamat tujuan (cth: Pekanbaru)"
                                    value="{{ request('alamat_tujuan') }}">

                                {{-- FILTER TAHUN --}}
                                <input type="text" name="tahun" class="form-control form-control-sm flex-grow-0"
                                    style="max-width: 120px;" placeholder="Tahun (cth: 2024)" value="{{ request('tahun') }}"
                                    maxlength="4">

                                {{-- FILTER BULAN --}}
                                <select name="bulan" class="form-select form-select-sm flex-grow-0"
                                    style="max-width: 150px;" onchange="this.form.submit()">
                                    <option value="">Semua Bulan</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}"
                                            {{ request('bulan') == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>

                                {{-- RESET --}}
                                @if (request('search') || request('alamat_tujuan') || request('tahun') || request('bulan'))
                                    <a href="{{ route('pindah.index') }}"
                                        class="btn btn-outline-secondary btn-sm rounded-0 ms-1" title="Reset semua filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{-- LIST KARTU --}}
            @if ($pindah->count() > 0)
                <div class="row">
                    @foreach ($pindah as $data)
                        @php
                            $namaWarga = $data->warga->nama ?? 'NN';
                            $parts = explode(' ', trim($namaWarga));
                            $inisial = strtoupper(
                                substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''),
                            );
                        @endphp

                        <div class="col-xl-6 col-lg-12 mb-4">
                            <div class="warga-card">

                                {{-- HEADER CARD: cuma nama --}}
                                <div class="warga-card-header">
                                    <div class="warga-avatar">
                                        {{ $inisial }}
                                    </div>

                                    <div class="warga-info">
                                        <div class="warga-name">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $data->warga->nama ?? 'Nama Tidak Ada' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- BODY CARD: No Surat + Tanggal Pindah saja --}}
                                <div class="warga-card-body">
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-file-alt me-1"></i>No. Surat Pindah
                                        </div>
                                        <div class="info-value">
                                            {{ $data->no_surat ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Pindah
                                        </div>
                                        <div class="info-value">
                                            {{ \Carbon\Carbon::parse($data->tgl_pindah)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>

                                {{-- FOOTER CARD --}}
                                <div class="warga-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Ditambahkan: {{ $data->created_at->format('d/m/Y') }}
                                    </small>

                                    <div class="action-buttons d-flex gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('pindah.show', $data->pindah_id) }}"
                                            class="btn btn-detail btn-sm">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>

                                        {{-- Edit / Hapus hanya untuk login --}}
                                        @if (session('is_logged_in'))
                                            <a href="{{ route('pindah.edit', $data->pindah_id) }}"
                                                class="btn btn-edit btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>

                                            <form action="{{ route('pindah.destroy', $data->pindah_id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-delete btn-sm"
                                                    onclick="return confirm('Hapus data pindah ini?')">
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

                {{-- PAGINATION --}}
                @if ($pindah->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">

                            <a href="{{ $pindah->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $pindah->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i> Sebelumnya
                            </a>

                            <span class="text-muted small">
                                Halaman {{ $pindah->currentPage() }} dari {{ $pindah->lastPage() }}
                            </span>

                            <a href="{{ $pindah->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$pindah->hasMorePages() ? 'disabled' : '' }}">
                                Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>
                @endif
            @else
                {{-- EMPTY STATEEE --}}
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-route fa-3x text-muted mb-3"></i>
                        <h4>Belum ada data pindah</h4>
                        <p class="text-muted mb-4">Silakan tambahkan data pindah terlebih dahulu.</p>

                        @if (session('is_logged_in'))
                        @else
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
