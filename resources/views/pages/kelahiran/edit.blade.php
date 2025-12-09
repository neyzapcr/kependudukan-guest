@extends('layouts.guest.app')

@section('title', 'Edit Data Kelahiran | Sistem Kependudukan')

@section('content')
    <div class="main-content">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-4">
                <h1 class="page-title">
                    Edit Data Kelahiran
                </h1>
                <p class="page-subtitle">
                    Perbarui data kelahiran: {{ $kelahiran->warga->nama ?? '-' }}
                </p>
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
                                <div class="warga-name">Form Edit Data Kelahiran</div>
                                <div class="warga-nik">
                                    Perbarui informasi kelahiran dengan data yang valid
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
                                          action="{{ route('kelahiran.hapusFoto', $item->media_id) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            @endif

                            <form method="POST" action="{{ route('kelahiran.update', $kelahiran->kelahiran_id) }}"
                                enctype="multipart/form-data" id="formEdit">
                                @csrf
                                @method('PUT')

                                {{-- NAMA ANAK (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-child me-1"></i>Nama Anak
                                    </label>
                                    <input type="text" class="form-control search-box"
                                        value="{{ $kelahiran->warga->nama ?? '-' }}" readonly>
                                </div>

                                <div class="row">
                                    {{-- NAMA AYAH --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-male me-1"></i>Nama Ayah
                                        </label>
                                        <select name="ayah_warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Ayah --</option>
                                            @foreach ($ayah as $data)
                                                <option value="{{ $data->warga_id }}"
                                                    {{ old('ayah_warga_id', $kelahiran->ayah_warga_id) == $data->warga_id ? 'selected' : '' }}>
                                                    {{ $data->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- NAMA IBU --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-female me-1"></i>Nama Ibu
                                        </label>
                                        <select name="ibu_warga_id" class="form-control search-box" required>
                                            <option value="">-- Pilih Ibu --</option>
                                            @foreach ($ibu as $data)
                                                <option value="{{ $data->warga_id }}"
                                                    {{ old('ibu_warga_id', $kelahiran->ibu_warga_id) == $data->warga_id ? 'selected' : '' }}>
                                                    {{ $data->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- NO AKTA --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-id-card me-1"></i>No. Akta
                                        </label>
                                        <input type="text" name="no_akta" class="form-control search-box"
                                            value="{{ old('no_akta', $kelahiran->no_akta) }}" required>
                                    </div>

                                    {{-- TEMPAT LAHIR --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt me-1"></i>Tempat Lahir
                                        </label>
                                        <input type="text" name="tempat_lahir" class="form-control search-box"
                                            value="{{ old('tempat_lahir', $kelahiran->tempat_lahir) }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- TANGGAL LAHIR --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Lahir
                                        </label>
                                        <input type="date" name="tgl_lahir" class="form-control search-box"
                                            value="{{ old('tgl_lahir', \Carbon\Carbon::parse($kelahiran->tgl_lahir)->format('Y-m-d')) }}"
                                            required>
                                    </div>

                                    {{-- DOKUMEN / FOTO AKTA --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-file me-1"></i>Dokumen / Foto Akta
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
                                                                    href="{{ route('kelahiran.downloadFile', $item->media_id) }}">
                                                                    <i class="fas fa-file me-1"></i>
                                                                    {{ $item->original_name ?: $item->file_name }}
                                                                </a>
                                                            @endif
                                                        </div>

                                                        {{-- tombol hapus dokumen ini saja --}}
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="hapusDokumen({{ $item->media_id }})">
                                                            <i class="fas fa-trash me-1"></i>Hapus
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-muted mb-2">Belum ada dokumen / foto akta yang diunggah.</div>
                                        @endif

                                        {{-- INPUT UNTUK TAMBAH DOKUMEN BARU --}}
                                        <input type="file" name="foto_akta[]" class="form-control"
                                            accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"
                                            multiple>

                                        <small class="text-muted">
                                            Tambahkan dokumen baru jika diperlukan. File lama tidak akan terhapus
                                            kecuali kamu klik tombol "Hapus". Maks 5 MB per file.
                                        </small>
                                    </div>
                                </div>

                                {{-- FOOTER FORM --}}
                                <div class="warga-card-footer">
                                    <a href="{{ route('kelahiran.index') }}" class="btn btn-secondary">
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

    {{-- OPTIONAL: Modal hapus data kelahiran (kalau mau pakai) --}}
    <div class="modal fade" id="deleteKelahiranModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-1"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data kelahiran:</p>
                    <p><strong>{{ $kelahiran->warga->nama ?? '-' }}</strong></p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Data yang dihapus tidak dapat dikembalikan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form action="{{ route('kelahiran.destroy', $kelahiran->kelahiran_id) }}" method="POST">
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

@push('scripts')
<script>
    function hapusDokumen(mediaId) {
        if (confirm('Hapus dokumen ini?')) {
            // Submit form hapus dokumen yang spesifik
            document.getElementById('hapusDokumen' + mediaId).submit();
        }
    }
</script>
@endpush
