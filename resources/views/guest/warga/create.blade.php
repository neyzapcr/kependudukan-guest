@extends('layouts.guest.app')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="page-header mb-4">
            <h1 class="page-title">Tambah Data Warga Baru</h1>
            <p class="page-subtitle">Isi form berikut dengan data warga yang valid</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="warga-card">
                    <div class="warga-card-header">
                        <div class="warga-avatar">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="warga-info">
                            <div class="warga-name">Form Pendaftaran Warga</div>
                            <div class="warga-nik">Lengkapi semua data dengan benar</div>
                        </div>
                    </div>

                    <div class="warga-card-body">
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

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('warga.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-id-card me-1"></i>No. KTP</label>
                                    <input type="text" name="no_ktp" class="form-control search-box"
                                           value="{{ old('no_ktp') }}" maxlength="16" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-user me-1"></i>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control search-box"
                                           value="{{ old('nama') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-venus-mars me-1"></i>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control search-box" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-praying-hands me-1"></i>Agama</label>
                                    <select name="agama" class="form-control search-box" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-briefcase me-1"></i>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control search-box"
                                           value="{{ old('pekerjaan') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fas fa-phone me-1"></i>No. Telp</label>
                                    <input type="text" name="telp" class="form-control search-box"
                                           value="{{ old('telp') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-envelope me-1"></i>Email</label>
                                <input type="email" name="email" class="form-control search-box"
                                       value="{{ old('email') }}">
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i>Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control search-box" rows="3">{{ old('alamat') }}</textarea>
                            </div>

                            <div class="warga-card-footer">
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>
                                <div class="action-buttons">
                                    <button type="submit" class="btn-edit">
                                        <i class="fas fa-save me-1"></i>Simpan Data Warga
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

