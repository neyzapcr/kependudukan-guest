@extends('layouts.guest.app')

@section('title', 'Edit Data Pindah | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-4">
                <h1 class="page-title">
                    Edit Data Pindah
                </h1>
                <p class="page-subtitle">
                    Perbarui data kepindahan: {{ $pindah->warga->nama ?? '-' }}
                </p>
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
                                <div class="warga-name">Form Edit Data Pindah</div>
                                <div class="warga-nik">
                                    Perbarui informasi kepindahan dengan data yang valid
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
                                          action="{{ route('pindah.hapusFoto', $item->media_id) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            @endif

                            <form method="POST"
                                  action="{{ route('pindah.update', $pindah->pindah_id) }}"
                                  enctype="multipart/form-data"
                                  id="formEdit">
                                @csrf
                                @method('PUT')

                                {{-- NAMA WARGA (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i>Nama Warga
                                    </label>
                                    <input type="text" class="form-control search-box"
                                           value="{{ $pindah->warga->nama ?? '-' }}" readonly>
                                    {{-- tetap kirim warga_id ke controller --}}
                                    <input type="hidden" name="warga_id"
                                           value="{{ old('warga_id', $pindah->warga_id) }}">
                                </div>

                                <div class="row">
                                    {{-- NO SURAT PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt me-1"></i>No. Surat Pindah
                                        </label>
                                        <input type="text" name="no_surat" class="form-control search-box"
                                               value="{{ old('no_surat', $pindah->no_surat) }}">
                                    </div>

                                    {{-- TANGGAL PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Pindah
                                        </label>
                                        <input type="date" name="tgl_pindah" class="form-control search-box"
                                               value="{{ old('tgl_pindah', \Carbon\Carbon::parse($pindah->tgl_pindah)->format('Y-m-d')) }}"
                                               required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- ALAMAT TUJUAN --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Alamat Tujuan
                                        </label>
                                        <textarea name="alamat_tujuan" class="form-control search-box" rows="3" required>{{ old('alamat_tujuan', $pindah->alamat_tujuan) }}</textarea>
                                    </div>

                                    {{-- ALASAN PINDAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-info-circle me-1"></i>Alasan Pindah
                                        </label>
                                        <input type="text" name="alasan" class="form-control search-box"
                                               value="{{ old('alasan', $pindah->alasan) }}" required
                                               placeholder="Misal: Pekerjaan, Pendidikan, Keluarga, dll">
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
                                                        $ext = strtolower(pathinfo($item->file_name, PATHINFO_EXTENSION));
                                                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                                        $isPdf = $ext === 'pdf';
                                                    @endphp

                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
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
                                                                <a href="{{ route('pindah.downloadFile', $item->media_id) }}">
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
                                        <input type="file" name="dokumen_pindah[]" class="form-control"
                                               accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                               multiple>

                                        <small class="text-muted"> Maks 5 MB per file. </small>
                                    </div>
                                </div>

                                {{-- FOOTER FORM --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('pindah.index') }}" class="btn btn-secondary">
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

    {{-- OPTIONAL: Modal hapus data pindah (kalau mau pakai) --}}
    <div class="modal fade" id="deletePindahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-1"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data kepindahan:</p>
                    <p><strong>{{ $pindah->warga->nama ?? '-' }}</strong></p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Data yang dihapus tidak dapat dikembalikan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form action="{{ route('pindah.destroy', $pindah->pindah_id) }}" method="POST">
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
