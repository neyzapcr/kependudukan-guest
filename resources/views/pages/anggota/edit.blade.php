@extends('layouts.guest.app')

@section('title', 'Edit Anggota Keluarga')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
            <h1 class="page-title">Edit Anggota Keluarga</h1>
            <p class="page-subtitle">KK: {{ $kk->kk_nomor }} - {{ $anggota->warga->nama }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="anggota-card">
                    <div class="anggota-card-header">
                        <div class="anggota-avatar">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="anggota-info">
                            <div class="anggota-name">Form Edit Anggota Keluarga</div>
                            <div class="anggota-kk">Perbarui data anggota</div>
                        </div>
                    </div>

                    <div class="anggota-card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-1"></i>Terjadi Kesalahan:</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-circle-exclamation me-1"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('anggota.update', $anggota->anggota_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-user me-1"></i>Nama Anggota</label>
                                <input type="text" class="form-control search-box"
                                       value="{{ $anggota->warga->nama }}" disabled>
                                <div class="form-text"><i class="fas fa-info-circle me-1"></i>Nama tidak dapat diubah</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-link me-1"></i>Hubungan</label>
                                <input type="text" name="hubungan" class="form-control search-box"
                                       value="{{ old('hubungan', $anggota->hubungan_keluarga) }}"
                                       placeholder="Contoh: Anak, Istri, Suami, Cucu" required>
                            </div>

                            <div class="anggota-card-footer">
                                <a href="{{ route('anggota.index', $kk->kk_id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div class="action-buttons">
                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-save me-1"></i>Update Anggota
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

