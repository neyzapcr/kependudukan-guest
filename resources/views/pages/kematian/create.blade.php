@extends('layouts.guest.app')

@section('title', 'Tambah Data Kematian | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <h1 class="page-title">Tambah Data Kematian Baru</h1>
                <p class="page-subtitle">Isi form berikut dengan data kematian yang valid</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="warga-card">

                        {{-- HEADER CARD --}}
                        <div class="warga-card-header">
                            <div class="warga-avatar">
                                <i class="fas fa-book-dead"></i>
                            </div>
                            <div class="warga-info">
                                <div class="warga-name">Form Data Kematian</div>
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
                            <form method="POST" action="{{ route('kematian.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- WARGA YANG MENINGGAL --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-user me-1"></i>Nama Warga
                                        </label>
                                        <select name="warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Warga --</option>
                                            @foreach ($warga as $w)
                                                <option value="{{ $w->warga_id }}"
                                                    {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} (NIK: {{ $w->no_ktp }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- NO SURAT KEMATIAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt me-1"></i>No. Surat Kematian
                                        </label>
                                        <input type="text" name="no_surat" class="form-control search-box"
                                            value="{{ old('no_surat') }}">
                                        <small class="text-muted">Opsional, isi jika ada nomor surat resmi.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- TANGGAL MENINGGAL --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Meninggal
                                        </label>
                                        <input type="date" name="tgl_meninggal" class="form-control search-box"
                                            value="{{ old('tgl_meninggal') }}" required>
                                    </div>

                                    {{-- LOKASI --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi Meninggal
                                        </label>
                                        <input type="text" name="lokasi" class="form-control search-box"
                                            value="{{ old('lokasi') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- SEBAB KEMATIAN --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-heartbeat me-1"></i>Sebab Kematian
                                        </label>
                                        <input type="text" name="sebab" class="form-control search-box"
                                            value="{{ old('sebab') }}" required
                                            placeholder="Misal: Sakit, Kecelakaan, Usia lanjut, dll">
                                    </div>
                                </div>

                                {{-- DOKUMEN / SURAT KEMATIAN --}}
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-paperclip me-1"></i>Dokumen Pendukung (Opsional)
                                    </label>
                                    <input type="file" name="dokumen_kematian[]" class="form-control search-box"
                                        accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                        multiple>
                                    <small class="text-muted">
                                        Bisa Maks 5 MB per file.
                                    </small>
                                </div>

                                {{-- FOOTER --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('kematian.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>

                                    <div class="action-buttons">
                                        <button type="submit" class="btn-edit">
                                            <i class="fas fa-save me-1"></i>Simpan Data Kematian
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
