@extends('layouts.guest.app')

@section('title', 'Detail Data Pindah | Sistem Kependudukan')

@section('content')
    <div class="main-content pindah-show-page">
        <div class="container">

            {{-- PAGE HEADER --}}
            <div class="page-header mb-4 text-center">
                <h1 class="page-title mb-1">
                    <i class="fas fa-route me-2"></i>Detail Data Pindah
                </h1>
                <p class="page-subtitle mb-0 text-muted">
                    Informasi lengkap data kepindahan warga.
                </p>
            </div>

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @php
                $namaWarga = $pindah->warga->nama ?? 'NN';
                $parts = explode(' ', trim($namaWarga));
                $inisial = strtoupper(
                    substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : '')
                );
            @endphp

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="warga-card">

                        {{-- HEADER --}}
                        <div class="warga-card-header d-flex align-items-center gap-3">
                            <div class="warga-avatar flex-shrink-0">
                                {{ $inisial }}
                            </div>

                            <div class="warga-info">
                                <div class="warga-name fw-bold fs-5 d-flex align-items-center">
                                    <i class="fas fa-user me-2"></i>
                                    {{ $pindah->warga->nama ?? 'Nama Tidak Ada' }}
                                </div>
                                <div class="warga-nik small d-flex align-items-center mt-1 text-light">
                                    <i class="fas fa-file-alt me-2"></i>
                                    No. Surat Pindah:
                                    <span class="ms-1 fw-semibold text-light">
                                        {{ $pindah->no_surat ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- BODY --}}
                        <div class="warga-card-body">

                            <div class="row g-4">

                                {{-- KOLOM KIRI: INFO PINDAH --}}
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-3">Informasi Pindah</h5>

                                    <div class="row g-2 align-items-start mb-2">
                                        <div class="col-12 col-sm-5 text-muted fw-semibold">
                                            <i class="fas fa-calendar me-1"></i>Tanggal Pindah
                                        </div>
                                        <div class="col-12 col-sm-7">
                                            {{ \Carbon\Carbon::parse($pindah->tgl_pindah)->format('d/m/Y') }}
                                        </div>
                                    </div>

                                    <div class="row g-2 align-items-start mb-2">
                                        <div class="col-12 col-sm-5 text-muted fw-semibold">
                                            <i class="fas fa-map-marker-alt me-1"></i>Alamat Tujuan
                                        </div>
                                        <div class="col-12 col-sm-7">
                                            {{ $pindah->alamat_tujuan }}
                                        </div>
                                    </div>

                                    <div class="row g-2 align-items-start">
                                        <div class="col-12 col-sm-5 text-muted fw-semibold">
                                            <i class="fas fa-list me-1"></i>Alasan Pindah
                                        </div>
                                        <div class="col-12 col-sm-7">
                                            {{ $pindah->alasan }}
                                        </div>
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: DATA WARGA --}}
                                <div class="col-12 col-md-6">
                                    <h5 class="mb-3">Data Warga</h5>

                                    <div class="row g-2 align-items-start mb-2">
                                        <div class="col-12 col-sm-5 text-muted fw-semibold">
                                            <i class="fas fa-id-card me-1"></i>NIK
                                        </div>
                                        <div class="col-12 col-sm-7">
                                            {{ $pindah->warga->no_ktp ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="row g-2 align-items-start mb-2">
                                        <div class="col-12 col-sm-5 text-muted fw-semibold">
                                            <i class="fas fa-venus-mars me-1"></i>Jenis Kelamin
                                        </div>
                                        <div class="col-12 col-sm-7">
                                            @if (isset($pindah->warga->jenis_kelamin))
                                                {{ $pindah->warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>

                                    @if (isset($pindah->warga->alamat))
                                        <div class="row g-2 align-items-start">
                                            <div class="col-12 col-sm-5 text-muted fw-semibold">
                                                <i class="fas fa-home me-1"></i>Alamat Asal
                                            </div>
                                            <div class="col-12 col-sm-7">
                                                {{ $pindah->warga->alamat }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            {{-- DOKUMEN --}}
                            @php
                                $mediaItems =
                                    $media instanceof \Illuminate\Support\Collection
                                        ? $media
                                        : collect($media ? [$media] : []);
                            @endphp

                            <div class="pt-3 mt-4 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Dokumen Pendukung</h5>
                                    <small class="text-muted">{{ $mediaItems->count() }} file</small>
                                </div>

                                @if ($mediaItems->count())
                                    <div class="row g-3">
                                        @foreach ($mediaItems as $item)
                                            @php
                                                $url = asset('storage/uploads/dokumen/' . $item->file_name);
                                                $ext = strtolower(pathinfo($item->file_name, PATHINFO_EXTENSION));
                                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                $isPdf = $ext === 'pdf';
                                                $isPreviewable = $isImage || $isPdf;
                                                $displayName = $item->original_name ?? $item->file_name;
                                            @endphp

                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div
                                                    class="border rounded-3 px-3 py-2 h-100 d-flex align-items-center shadow-sm">

                                                    {{-- ICON / THUMB KECIL --}}
                                                    <div class="flex-shrink-0 me-2">
                                                        @if ($isImage)
                                                            <img src="{{ $url }}" class="rounded"
                                                                 style="width:32px;height:32px;object-fit:cover;">
                                                        @elseif($isPdf)
                                                            <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                                        @else
                                                            <i class="fas fa-file-alt fa-lg text-secondary"></i>
                                                        @endif
                                                    </div>

                                                    {{-- NAMA FILE (TRUNCATE) --}}
                                                    <div class="flex-grow-1 me-2" style="min-width:0; max-width:220px;">
                                                        @if ($isPreviewable)
                                                            <a href="#"
                                                               class="fw-semibold text-decoration-none d-block text-truncate preview-file"
                                                               data-url="{{ $url }}"
                                                               data-type="{{ $isImage ? 'image' : ($isPdf ? 'pdf' : 'other') }}">
                                                                {{ $displayName }}
                                                            </a>
                                                        @else
                                                            <span class="fw-semibold d-block text-truncate">
                                                                {{ $displayName }}
                                                            </span>
                                                        @endif

                                                        <small class="text-muted d-block">
                                                            {{ strtoupper($ext) }}
                                                        </small>
                                                    </div>

                                                    {{-- ICON DOWNLOAD --}}
                                                    <a href="{{ route('pindah.downloadFile', $item->media_id) }}"
                                                       class="btn btn-sm btn-link text-primary p-0 flex-shrink-0"
                                                       title="Download file">
                                                        <i class="fas fa-download"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted mb-2">
                                        Belum ada dokumen / file pendukung yang diunggah.
                                    </div>
                                    <div class="d-flex justify-content-center">
                                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="Placeholder dokumen"

                                                style="width:120px;height:120px;object-fit:contain;opacity:.75;background:transparent;box-shadow:none;">
                                        </div>
                                @endif
                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div
                            class="warga-card-footer d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Ditambahkan: {{ $pindah->created_at->format('d/m/Y') }}
                            </small>

                            <div class="action-buttons d-flex gap-2 flex-wrap">
                                <a href="{{ route('pindah.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali
                                </a>

                                @if (session('is_logged_in'))
                                    <a href="{{ route('pindah.edit', $pindah->pindah_id) }}"
                                       class="btn btn-edit btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>

                                    <form action="{{ route('pindah.destroy', $pindah->pindah_id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus data pindah ini beserta dokumennya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete btn-sm">
                                            <i class="fas fa-trash me-1"></i>Hapus Data
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
