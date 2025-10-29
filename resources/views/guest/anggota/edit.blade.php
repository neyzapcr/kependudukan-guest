@extends('layouts.app')

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
                                <h5 class="alert-heading">Terjadi Kesalahan:</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('anggota.update', $anggota->anggota_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control search-box"
                                       value="{{ $anggota->warga->nama }}" disabled>
                                <div class="form-text">Nama tidak dapat diubah</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Hubungan</label>
                                <input type="text" name="hubungan" class="form-control search-box"
                                       value="{{ old('hubungan', $anggota->hubungan_keluarga) }}"
                                       placeholder="Contoh: Anak, Istri, Suami, Cucu" required>
                            </div>

                            <div class="anggota-card-footer">
                                <a href="{{ route('anggota.index', $kk->kk_id) }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                                <div class="action-buttons">
                                    <button type="submit" class="btn-edit">
                                        Update Anggota
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
