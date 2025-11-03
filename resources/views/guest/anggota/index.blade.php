@extends('layouts.guest.app')

@section('title', 'Data Anggota Keluarga')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-users me-2"></i>Data Anggota Keluarga
                        </h1>
                        <p class="page-subtitle">KK: {{ $kk->kk_nomor }} -
                            {{ $kk->kepalaKeluarga->nama ?? 'Kepala Keluarga' }}</p>
                    </div>

                    <div class="action-buttons">
                        @if (session('is_logged_in'))
                            <a href="{{ route('anggota.create', $kk->kk_id) }}" class="btn btn-add">
                                <i class="fas fa-user-plus me-1"></i>Tambah Anggota
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

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Data Anggota Keluarga -->
            @if ($kk->anggotaKeluarga->count() > 0)
                <div class="row">
                    @foreach ($kk->anggotaKeluarga as $anggota)
                        <div class="col-xl-6 col-lg-6 mb-4">
                            <div class="anggota-card" data-id="{{ $anggota->anggota_id }}">
                                <div class="anggota-card-header">
                                    <div class="anggota-avatar">
                                        {{ substr($anggota->warga->nama ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="anggota-info">
                                        <div class="anggota-name"><i
                                                class="fas fa-user me-1"></i>{{ $anggota->warga->nama ?? '-' }}</div>
                                        <div class="anggota-kk"><i
                                                class="fas fa-link me-1"></i>{{ $anggota->hubungan ?? 'Anggota' }}</div>
                                    </div>
                                </div>

                                <div class="anggota-card-body">
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-id-card me-1"></i>NIK</div>
                                        <div class="info-value">{{ $anggota->warga->no_ktp ?? '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-venus-mars me-1"></i>Jenis Kelamin</div>
                                        <div class="info-value">
                                            <span
                                                class="{{ ($anggota->warga->jenis_kelamin ?? '') == 'L' ? 'gender-male' : 'gender-female' }}">
                                                <i
                                                    class="fas fa-{{ ($anggota->warga->jenis_kelamin ?? '') == 'L' ? 'mars' : 'venus' }} me-1"></i>
                                                {{ ($anggota->warga->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-praying-hands me-1"></i>Agama</div>
                                        <div class="info-value">{{ $anggota->warga->agama ?? '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-briefcase me-1"></i>Pekerjaan</div>
                                        <div class="info-value">{{ $anggota->warga->pekerjaan ?? '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-phone me-1"></i>Telepon</div>
                                        <div class="info-value">{{ $anggota->warga->telp ?? '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-envelope me-1"></i>Email</div>
                                        <div class="info-value">{{ $anggota->warga->email ?? '-' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label"><i class="fas fa-link me-1"></i>Hubungan</div>
                                        <div class="info-value">
                                            <span class="badge bg-primary">{{ $anggota->hubungan ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="anggota-card-footer">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $anggota->created_at->format('d/m/Y') }}
                                    </small>

                                    <div class="action-buttons">
                                        @if (session('is_logged_in'))
                                            <a href="{{ route('anggota.edit', $anggota->anggota_id) }}"
                                                class="btn btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('anggota.destroy', $anggota->anggota_id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-delete"
                                                    onclick="return confirm('Yakin hapus data anggota ini?')">
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
            @else
                <!-- Empty State -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="empty-state text-center">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h4>Belum ada anggota keluarga</h4>
                            <p class="mb-4">Silakan tambahkan anggota keluarga terlebih dahulu</p>
                            @if (session('is_logged_in'))
                            @else
                                <a href="{{ route('login') }}" class="btn btn-add">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login untuk Tambah Anggota
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
