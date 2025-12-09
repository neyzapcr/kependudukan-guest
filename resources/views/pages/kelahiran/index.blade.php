@extends('layouts.guest.app')

@section('title', 'Data Kelahiran | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-baby me-2"></i>Data Kelahiran
                        </h1>
                        <p class="page-subtitle">Kelola data kelahiran warga. Klik detail untuk informasi lengkap.</p>
                    </div>

                    {{-- Tombol Tambah Data --}}
                    @if (session('is_logged_in'))
                        <a href="{{ route('kelahiran.create') }}" class="btn btn-add">
                            <i class="fas fa-plus me-1"></i>Tambah Data Kelahiran
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-add">
                            <i class="fas fa-sign-in-alt me-1"></i>Tambah Data Kelahiran
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
                <span class="text-muted">Total: {{ $kelahiran->total() }} Kelahiran </span>
            </div>
            {{-- SEARCH --}}
            {{-- SEARCH --}}
            {{-- SEARCH + FILTER + TOTAL --}}
            <div class="card shadow-sm mb-3">
                <div class="card-body">

                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                        {{-- FORM SEARCH + FILTER --}}
                        <form action="{{ route('kelahiran.index') }}" method="GET" class="flex-grow-1">
                            <div class="d-flex flex-column flex-xl-row gap-2">

                                {{-- SEARCH BOX BESAR --}}
                                <div class="input-group flex-grow-1">
                                    <input type="text" name="search" class="form-control search-box"
                                        placeholder="Cari nama anak, nama orang tua, tempat lahir, atau no akta..."
                                        value="{{ request('search') }}">
                                    <button class="btn btn-search">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </div>

                                {{-- FILTER TEMPAT LAHIR --}}
                                <input type="text" name="tempat_lahir" class="form-control form-control-sm flex-grow-0"
                                    style="max-width: 180px;" placeholder="Tempat lahir (cth: Pekanbaru)"
                                    value="{{ request('tempat_lahir') }}">

                                {{-- FILTER TAHUN --}}
                                {{-- FILTER TAHUN (INPUT KETIK) --}}
                                <input type="text" name="tahun" class="form-control form-control-sm flex-grow-0"
                                    style="max-width: 120px;" placeholder="Tahun (cth: 2024)" value="{{ request('tahun') }}"
                                    maxlength="4">


                                {{-- FILTER BULAN --}}
                                <select name="bulan" class="form-select form-select-sm flex-grow-0"
                                    style="max-width: 150px;">
                                    <option value="">Semua Bulan</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}"
                                            {{ request('bulan') == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>

                                {{-- RESET --}}
                                @if (request('search') || request('tempat_lahir') || request('tahun') || request('bulan'))
                                    <a href="{{ route('kelahiran.index') }}"
                                        class="btn btn-outline-secondary btn-sm rounded-0 ms-1" title="Reset semua filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>

                        {{-- TOTAL DATA DI KANAN
            <div class="text-muted small text-nowrap ms-lg-3">
                Total: <strong>{{ $kelahiran->total() }}</strong> data kelahiran
            </div> --}}
                    </div>

                </div>
            </div>


            {{-- LIST KARTU --}}
            @if ($kelahiran->count() > 0)
                <div class="row">
                    @foreach ($kelahiran as $data)
                        @php
                            // Ambil inisial nama anak
                            $namaAnak = $data->warga->nama ?? 'NN';
                            $parts = explode(' ', trim($namaAnak));
                            $inisial = strtoupper(
                                substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''),
                            );
                        @endphp

                        <div class="col-xl-6 col-lg-12 mb-4">
                            <div class="warga-card">

                                {{-- HEADER CARD --}}
                                <div class="warga-card-header">
                                    <div class="warga-avatar">
                                        {{ $inisial }}
                                    </div>

                                    <div class="warga-info">
                                        <div class="warga-name">
                                            <i class="fas fa-baby me-1"></i>
                                            {{ $data->warga->nama ?? 'Nama Tidak Ada' }}
                                        </div>

                                        <div class="warga-nik">
                                            <i class="fas fa-id-card me-1"></i>
                                            No. Akta: {{ $data->no_akta }}
                                        </div>
                                    </div>
                                </div>

                                {{-- BODY CARD (hanya tanggal & tempat lahir) --}}
                                <div class="warga-card-body">
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Lahir
                                        </div>
                                        <div class="info-value">
                                            {{ \Carbon\Carbon::parse($data->tgl_lahir)->format('d/m/Y') }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Tempat Lahir
                                        </div>
                                        <div class="info-value">
                                            {{ $data->tempat_lahir }}
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
                                        <a href="{{ route('kelahiran.show', $data->kelahiran_id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </a>

                                        {{-- Edit / Hapus hanya untuk login --}}
                                        @if (session('is_logged_in'))
                                            <a href="{{ route('kelahiran.edit', $data->kelahiran_id) }}"
                                                class="btn btn-edit btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>

                                            <form action="{{ route('kelahiran.destroy', $data->kelahiran_id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-delete btn-sm"
                                                    onclick="return confirm('Hapus data kelahiran ini?')">
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
                @if ($kelahiran->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-center align-items-center gap-3">

                            <a href="{{ $kelahiran->previousPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ $kelahiran->onFirstPage() ? 'disabled' : '' }}">
                                <i class="fas fa-arrow-left me-1"></i> Sebelumnya
                            </a>

                            <span class="text-muted small">
                                Halaman {{ $kelahiran->currentPage() }} dari {{ $kelahiran->lastPage() }}
                            </span>

                            <a href="{{ $kelahiran->nextPageUrl() }}"
                                class="btn btn-outline-primary btn-sm {{ !$kelahiran->hasMorePages() ? 'disabled' : '' }}">
                                Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>
                @endif
            @else
                {{-- EMPTY STATE --}}
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-baby fa-3x text-muted mb-3"></i>
                        <h4>Belum ada data kelahiran</h4>
                        <p class="text-muted mb-4">Silakan tambahkan data kelahiran terlebih dahulu.</p>

                        @if (session('is_logged_in'))
                            <a href="{{ route('kelahiran.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Tambah Data Kelahiran
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt me-1"></i>Login untuk menambah data
                            </a>
                        @endif
                    </div>
                </div>

            @endif

        </div>
    </div>
@endsection
