@extends('layouts.guest.app')

@section('title', 'Tambah Data Pindah | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="page-header mb-4">
                <h1 class="page-title">Tambah Data Pindah Baru</h1>
                <p class="page-subtitle">Isi form berikut dengan data kepindahan yang valid</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="warga-card">

                        {{-- HEADER CARD --}}
                        <div class="warga-card-header">
                            <div class="warga-avatar">
                                <i class="fas fa-route"></i>
                            </div>
                            <div class="warga-info">
                                <div class="warga-name">Form Data Pindah</div>
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
                            <form method="POST" action="{{ route('pindah.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- WARGA YANG PINDAH --}}
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

                                    {{-- NO SURAT PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt me-1"></i>No. Surat Pindah
                                        </label>
                                        <input type="text" name="no_surat" class="form-control search-box"
                                            value="{{ old('no_surat') }}">
                                        <small class="text-muted">Opsional, isi jika ada nomor surat resmi.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- TANGGAL PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Pindah
                                        </label>
                                        <input type="date" name="tgl_pindah" class="form-control search-box"
                                            value="{{ old('tgl_pindah') }}" required>
                                    </div>

                                    {{-- ALASAN PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-info-circle me-1"></i>Alasan Pindah
                                        </label>
                                        <input type="text" name="alasan" class="form-control search-box"
                                            value="{{ old('alasan') }}" required
                                            placeholder="Misal: Pekerjaan, Pendidikan, Keluarga, dll">
                                    </div>
                                </div>

                                {{-- ALAMAT TUJUAN --}}
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i>Alamat Tujuan
                                    </label>
                                    <textarea name="alamat_tujuan" class="form-control search-box" rows="3" required>{{ old('alamat_tujuan') }}</textarea>
                                    <small class="text-muted">
                                        Tulis alamat lengkap tujuan pindah (jalan, RT/RW, kelurahan, kecamatan, kota/kabupaten).
                                    </small>
                                </div>

                                {{-- DOKUMEN / SURAT PINDAH --}}
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-paperclip me-1"></i>Dokumen Pendukung (Opsional)
                                    </label>
                                    <input type="file" name="dokumen_pindah[]" class="form-control search-box"
                                        accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                        multiple>
                                    <small class="text-muted">
                                        Bisa upload beberapa file. Maks 5 MB per file.
                                    </small>
                                </div>

                                {{-- FOOTER --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('pindah.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>

                                    <div class="action-buttons">
                                        <button type="submit" class="btn-edit">
                                            <i class="fas fa-save me-1"></i>Simpan Data Pindah
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
