@extends('layouts.guest.app')

@section('title', 'Tambah Data Kelahiran | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <h1 class="page-title">Tambah Data Kelahiran Baru</h1>
                <p class="page-subtitle">Isi form berikut dengan data kelahiran yang valid</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="warga-card">

                        {{-- HEADER CARD --}}
                        <div class="warga-card-header">
                            <div class="warga-avatar">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="warga-info">
                                <div class="warga-name">Form Data Kelahiran</div>
                                <div class="warga-nik">Lengkapi semua data dengan benar</div>
                            </div>
                        </div>

                        <div class="warga-card-body">

                            {{-- ERROR ALERT --}}
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

                            {{-- SUCCESS --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- FORM --}}
                            <form method="POST" action="{{ route('kelahiran.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- ANAK --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-child me-1"></i>Nama Anak
                                        </label>
                                        <select name="warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Anak --</option>
                                            @foreach ($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- NO AKTA --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-id-card me-1"></i>No. Akta Kelahiran
                                        </label>
                                        <input type="text" name="no_akta" class="form-control search-box"
                                            value="{{ old('no_akta') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- TEMPAT LAHIR --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Tempat Lahir
                                        </label>
                                        <input type="text" name="tempat_lahir" class="form-control search-box"
                                            value="{{ old('tempat_lahir') }}" required>
                                    </div>

                                    {{-- TANGGAL LAHIR --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Lahir
                                        </label>
                                        <input type="date" name="tgl_lahir" class="form-control search-box"
                                            value="{{ old('tgl_lahir') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- AYAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-male me-1"></i>Nama Ayah
                                        </label>
                                        <select name="ayah_warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Ayah --</option>
                                            @foreach ($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ old('ayah_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- IBU --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-female me-1"></i>Nama Ibu
                                        </label>
                                        <select name="ibu_warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Ibu --</option>
                                            @foreach ($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ old('ibu_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- FOTO AKTA --}}
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-camera me-1"></i>Foto Akta (Opsional)
                                    </label>
                                    <input type="file" name="foto_akta[]" class="form-control search-box"  accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" multiple>
                                    <small class="text-muted">Format: JPG / PNG, maksimal 2MB.</small>
                                </div>

                                {{-- FOOTER --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('kelahiran.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>

                                    <div class="action-buttons">
                                        <button type="submit" class="btn-edit">
                                            <i class="fas fa-save me-1"></i>Simpan Data Kelahiran
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div> {{-- end card-body --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
