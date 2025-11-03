@extends('layouts.guest.app')

@section('title', 'Tambah Anggota Keluarga')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <h1 class="page-title">Tambah Anggota Keluarga</h1>
                <p class="page-subtitle">KK: {{ $kk->kk_nomor }} - {{ $kk->kepalaKeluarga->nama ?? 'Kepala Keluarga' }}</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="anggota-card">
                        <div class="anggota-card-header">
                            <div class="anggota-avatar">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="anggota-info">
                                <div class="anggota-name">Form Tambah Anggota Keluarga</div>
                                <div class="anggota-kk">Lengkapi data anggota baru</div>
                            </div>
                        </div>

                        <div class="anggota-card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan:
                                    </h5>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li><i class="fas fa-circle-exclamation"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Info Anggota Saat Ini -->
                            <div class="alert alert-info mb-4">
                                <h6><i class="fas fa-info-circle me-1"></i>Informasi:</h6>
                                <ul class="mb-0">
                                    <li>Kepala keluarga
                                        <strong>{{ $kk->kepalaKeluarga->nama ?? 'Tidak Diketahui' }}</strong> sudah otomatis
                                        terdaftar sebagai anggota</li>
                                    <li>Hanya menampilkan warga yang belum terdaftar di keluarga ini</li>
                                    <li>Total warga tersedia: {{ $warga->count() }} orang</li>
                                </ul>
                            </div>

                            @if ($warga->count() > 0)
                                <form method="POST" action="{{ route('anggota.store', $kk->kk_id) }}">
                                    @csrf
                                    <input type="hidden" name="kk_id" value="{{ $kk->kk_id }}">

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-id-card"></i> Pilih Warga</label>
                                        <select name="warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Warga --</option>
                                            @foreach ($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pilih warga yang sudah terdaftar di sistem</small>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label"><i class="fas fa-link me-1"></i> Hubungan Keluarga</label>
                                        <select name="hubungan" class="form-control search-box" required>
                                            <option value="">-- Pilih Hubungan --</option>
                                            <option value="Suami" {{ old('hubungan') == 'Suami' ? 'selected' : '' }}>Suami
                                            </option>
                                            <option value="Istri" {{ old('hubungan') == 'Istri' ? 'selected' : '' }}>Istri
                                            </option>
                                            <option value="Anak" {{ old('hubungan') == 'Anak' ? 'selected' : '' }}>Anak
                                            </option>
                                            <option value="Menantu" {{ old('hubungan') == 'Menantu' ? 'selected' : '' }}>
                                                Menantu</option>
                                            <option value="Cucu" {{ old('hubungan') == 'Cucu' ? 'selected' : '' }}>Cucu
                                            </option>
                                            <option value="Orang Tua"
                                                {{ old('hubungan') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                            <option value="Mertua" {{ old('hubungan') == 'Mertua' ? 'selected' : '' }}>
                                                Mertua</option>
                                            <option value="Famili Lain"
                                                {{ old('hubungan') == 'Famili Lain' ? 'selected' : '' }}>Famili Lain
                                            </option>
                                            <option value="Lainnya" {{ old('hubungan') == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                        <div class="form-text"><i class="fas fa-info-circle"></i> Pilih hubungan keluarga
                                            sesuai KK</div>
                                    </div>

                                    <div class="anggota-card-footer">
                                        <a href="{{ route('anggota.index', $kk->kk_id) }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <div class="action-buttons">
                                            <button type="submit" class="btn-edit">
                                                <i class="fas fa-plus-circle"></i> Tambah Anggota
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5>Tidak ada warga yang dapat ditambahkan</h5>
                                    <p class="text-muted">Semua warga sudah terdaftar di keluarga ini atau tidak ada data
                                        warga tersedia.</p>
                                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Tambah Data Warga
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
