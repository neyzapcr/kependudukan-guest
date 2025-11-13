@extends('layouts.guest.app')

@section('title', 'Edit Data Kartu Keluarga')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
            <h1 class="page-title">Edit Data Kartu Keluarga</h1>
            <p class="page-subtitle">Perbarui data kartu keluarga: {{ $keluarga->kk_nomor }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="keluarga-card">
                    <div class="keluarga-card-header">
                        <div class="keluarga-avatar">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="keluarga-info">
                            <div class="keluarga-name">Form Edit Kartu Keluarga</div>
                            <div class="keluarga-nomor">No. KK: {{ $keluarga->kk_nomor }}</div>
                        </div>
                    </div>

                    <div class="keluarga-card-body">
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

                        <form method="POST" action="{{ route('keluarga.update', $keluarga->kk_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-id-card me-1"></i>Nomor KK</label>
                                    <input type="text" name="kk_nomor" class="form-control search-box"
                                           value="{{ old('kk_nomor', $keluarga->kk_nomor) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-user me-1"></i>Kepala Keluarga</label>
                                    <select name="kepala_keluarga_warga_id" class="form-control search-box" required>
                                        <option value="">-- Pilih Kepala Keluarga --</option>
                                        @foreach($warga as $w)
                                            <option value="{{ $w->warga_id }}"
                                                {{ old('kepala_keluarga_warga_id', $keluarga->kepala_keluarga_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i>Alamat</label>
                                <textarea name="alamat" class="form-control search-box" rows="3" required>{{ old('alamat', $keluarga->alamat) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label"><i class="fas fa-home me-1"></i>RT</label>
                                    <input type="text" name="rt" class="form-control search-box"
                                           value="{{ old('rt', $keluarga->rt) }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label"><i class="fas fa-home me-1"></i>RW</label>
                                    <input type="text" name="rw" class="form-control search-box"
                                           value="{{ old('rw', $keluarga->rw) }}" required>
                                </div>
                            </div>

                            <div class="keluarga-card-footer">
                                <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div class="action-buttons">
                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-save me-1"></i>Update Data
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

