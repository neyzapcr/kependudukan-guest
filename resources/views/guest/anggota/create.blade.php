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
                                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan:</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-circle-exclamation"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('anggota.store', $kk->kk_id) }}">
                            @csrf
                            <input type="hidden" name="kk_id" value="{{ $kk->kk_id }}">

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-id-card"></i> Pilih Warga</label>
                                <select name="warga_id" class="form-control search-box" required>
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-link me-1"></i> Hubungan</label>
                                <input type="text" name="hubungan" class="form-control search-box"
                                       value="{{ old('hubungan') }}"
                                       placeholder="Contoh: Anak, Istri, Suami, Cucu" required>
                                <div class="form-text"><i class="fas fa-info-circle"></i> Masukkan hubungan keluarga sesuai KK</div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


