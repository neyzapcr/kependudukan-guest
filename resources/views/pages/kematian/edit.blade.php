@extends('layouts.guest.app')

@section('title', 'Edit Data Kematian | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-4">
                <h1 class="page-title">
                    Edit Data Kematian
                </h1>
                <p class="page-subtitle">
                    Perbarui data kematian: {{ $kematian->warga->nama ?? '-' }}
                </p>
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
                                <div class="warga-name">Form Edit Data Kematian</div>
                                <div class="warga-nik">
                                    Perbarui informasi kematian dengan data yang valid
                                </div>
                            </div>
                        </div>

                        <div class="warga-card-body">

                            {{-- ALERT ERROR --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Terjadi Kesalahan:
                                    </h5>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- FORM HAPUS DOKUMEN (DILUAR FORM EDIT) --}}
                            @if ($media->count())
                                @foreach ($media as $item)
                                    <form id="hapusDokumen{{ $item->media_id }}"
                                        action="{{ route('kematian.hapusFoto', $item->media_id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            @endif

                            <form method="POST" action="{{ route('kematian.update', $kematian->kematian_id) }}"
                                enctype="multipart/form-data" id="formEdit">
                                @csrf
                                @method('PUT')

                                {{-- NAMA WARGA (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i>Nama Warga
                                    </label>
                                    <input type="text" class="form-control search-box"
                                        value="{{ $kematian->warga->nama ?? '-' }}" readonly>
                                    {{-- tetap kirim warga_id ke controller --}}
                                    <input type="hidden" name="warga_id"
                                        value="{{ old('warga_id', $kematian->warga_id) }}">
                                </div>

                                <div class="row">
                                    {{-- NO SURAT KEMATIAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt me-1"></i>No. Surat Kematian
                                        </label>
                                        <input type="text" name="no_surat" class="form-control search-box"
                                            value="{{ old('no_surat', $kematian->no_surat) }}">
                                    </div>

                                    {{-- TANGGAL MENINGGAL --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Meninggal
                                        </label>
                                        <input type="date" name="tgl_meninggal" class="form-control search-box"
                                            value="{{ old('tgl_meninggal', \Carbon\Carbon::parse($kematian->tgl_meninggal)->format('Y-m-d')) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- LOKASI --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Lokasi Meninggal
                                        </label>
                                        <input type="text" name="lokasi" class="form-control search-box"
                                            value="{{ old('lokasi', $kematian->lokasi) }}" required>
                                    </div>

                                    {{-- SEBAB KEMATIAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-heartbeat me-1"></i>Sebab Kematian
                                        </label>
                                        <input type="text" name="sebab" class="form-control search-box"
                                            value="{{ old('sebab', $kematian->sebab) }}" required
                                            placeholder="Misal: Sakit, Kecelakaan, Usia lanjut, dll">
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- DOKUMEN PENDUKUNG --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file me-1"></i>Dokumen Pendukung
                                        </label>

                                        {{-- LIST DOKUMEN YANG SUDAH TERUPLOAD --}}
                                        @if ($media->count())
                                            <div class="list-group mb-2">
                                                @foreach ($media as $item)
                                                    @php
                                                        $url = asset('storage/uploads/dokumen/' . $item->file_name);
                                                        $ext = strtolower(
                                                            pathinfo($item->file_name, PATHINFO_EXTENSION),
                                                        );
                                                        $isImage = in_array($ext, [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                        $isPdf = $ext === 'pdf';
                                                    @endphp

                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center gap-2">
                                                            {{-- preview kecil kalau gambar --}}
                                                            @if ($isImage)
                                                                <img src="{{ $url }}"
                                                                    style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
                                                            @endif

                                                            {{-- nama file / tombol lihat --}}
                                                            @if ($isPdf)
                                                                <a href="{{ $url }}" target="_blank">
                                                                    <i class="fas fa-file-pdf me-1 text-danger"></i>
                                                                    {{ $item->original_name ?: $item->file_name }}
                                                                </a>
                                                            @elseif($isImage)
                                                                <a href="{{ $url }}" target="_blank">
                                                                    {{ $item->original_name ?: $item->file_name }}
                                                                </a>
                                                            @else
                                                                <a
                                                                    href="{{ route('kematian.downloadFile', $item->media_id) }}">
                                                                    <i class="fas fa-file me-1"></i>
                                                                    {{ $item->original_name ?: $item->file_name }}
                                                                </a>
                                                            @endif
                                                        </div>

                                                        {{-- tombol hapus dokumen ini saja --}}
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="if (confirm('Hapus dokumen ini?')) document.getElementById('hapusDokumen{{ $item->media_id }}').submit();">
                                                            <i class="fas fa-trash me-1"></i>Hapus
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-muted mb-2">
                                                Belum ada dokumen pendukung yang diunggah.
                                            </div>
                                        @endif

                                        {{-- INPUT UNTUK TAMBAH DOKUMEN BARU --}}
                                        <input type="file" name="dokumen_kematian[]" class="form-control"
                                            accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                            multiple>

                                        <small class="text-muted"> Maks 5 MB per file. </small>
                                    </div>
                                </div>

                                {{-- FOOTER FORM --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('kematian.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>
                                    <div class="action-buttons">
                                        <button type="submit" class="btn-edit">
                                            <i class="fas fa-save me-1"></i>Simpan Perubahan
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

    {{-- OPTIONAL: Modal hapus data kematian (kalau mau pakai) --}}
    <div class="modal fade" id="deleteKematianModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-1"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data kematian:</p>
                    <p><strong>{{ $kematian->warga->nama ?? '-' }}</strong></p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Data yang dihapus tidak dapat dikembalikan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form action="{{ route('kematian.destroy', $kematian->kematian_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash me-1"></i>Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
