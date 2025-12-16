@extends('layouts.guest.app')

@section('title', 'Detail Data Kelahiran | Sistem Kependudukan')

@section('content')
    <div class="kelahiran-show-page">
        <div class="main-content">
            <div class="container">

                {{-- PAGE HEADER --}}
                <div class="page-header mb-4 text-center">
                    <h1 class="page-title mb-1">
                        <i class="fas fa-baby me-2"></i>Detail Data Kelahiran
                    </h1>
                    <p class="page-subtitle mb-0 text-muted">
                        Informasi lengkap data kelahiran anak.
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
                    $namaAnak = $kelahiran->warga->nama ?? 'NN';
                    $parts = explode(' ', trim($namaAnak));
                    $inisial = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
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
                                        <i class="fas fa-baby me-2"></i>
                                        {{ $kelahiran->warga->nama ?? 'Nama Tidak Ada' }}
                                    </div>
                                    <div class="warga-nik small d-flex align-items-center mt-1 text-light">
                                        <i class="fas fa-id-card me-2"></i>
                                        No. Akta:
                                        <span class="ms-1 fw-semibold text-light">{{ $kelahiran->no_akta }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- BODY --}}
                            <div class="warga-card-body">

                                <div class="row g-4">

                                    {{-- KOLOM KIRI: INFO KELAHIRAN --}}
                                    <div class="col-12 col-md-6">
                                        <h5 class="mb-3 kelahiran-section-title">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Kelahiran
                                        </h5>

                                        <div class="row g-2 align-items-start mb-2">
                                            <div class="col-12 col-sm-5 text-muted fw-semibold">
                                                <i class="fas fa-calendar me-1"></i>Tanggal Lahir
                                            </div>
                                            <div class="col-12 col-sm-7">
                                                {{ \Carbon\Carbon::parse($kelahiran->tgl_lahir)->format('d/m/Y') }}
                                            </div>
                                        </div>

                                        <div class="row g-2 align-items-start">
                                            <div class="col-12 col-sm-5 text-muted fw-semibold">
                                                <i class="fas fa-map-marker-alt me-1"></i>Tempat Lahir
                                            </div>
                                            <div class="col-12 col-sm-7">
                                                {{ $kelahiran->tempat_lahir }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- KOLOM KANAN: ORANG TUA --}}
                                    <div class="col-12 col-md-6">
                                        <h5 class="mb-3 kelahiran-section-title">
                                            <i class="fas fa-users me-2"></i>Orang Tua
                                        </h5>

                                        <div class="row g-2 align-items-start mb-2">
                                            <div class="col-12 col-sm-5 text-muted fw-semibold">
                                                <i class="fas fa-male me-1"></i>Nama Ayah
                                            </div>
                                            <div class="col-12 col-sm-7">
                                                {{ $kelahiran->ayah->nama ?? '-' }}
                                            </div>
                                        </div>

                                        <div class="row g-2 align-items-start">
                                            <div class="col-12 col-sm-5 text-muted fw-semibold">
                                                <i class="fas fa-female me-1"></i>Nama Ibu
                                            </div>
                                            <div class="col-12 col-sm-7">
                                                {{ $kelahiran->ibu->nama ?? '-' }}
                                            </div>
                                        </div>
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
                                        <h5 class="mb-0 kelahiran-section-title">
                                            <i class="fas fa-file-alt me-2"></i>Dokumen Akta
                                        </h5>
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
                                                    $displayName = $item->original_name ?: $item->file_name;
                                                @endphp

                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="kelahiran-doc-card d-flex align-items-center h-100">

                                                        {{-- ICON / THUMB --}}
                                                        <div class="flex-shrink-0 me-2">
                                                            @if ($isImage)
                                                                <img src="{{ $url }}" class="rounded"
                                                                    style="width:34px;height:34px;object-fit:cover;">
                                                            @elseif($isPdf)
                                                                <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                                            @else
                                                                <i class="fas fa-file-alt fa-lg text-secondary"></i>
                                                            @endif
                                                        </div>

                                                        {{-- NAMA FILE --}}
                                                        <div class="flex-grow-1 me-2" style="min-width:0;">
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

                                                        {{-- DOWNLOAD --}}
                                                        <a href="{{ route('kelahiran.downloadFile', $item->media_id) }}"
                                                            class="btn btn-sm btn-link text-primary p-0 flex-shrink-0"
                                                            title="Download file">
                                                            <i class="fas fa-download"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-muted mb-2">Belum ada dokumen / foto akta yang diunggah.</div>

                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('assets/images/placeholder.png') }}"
                                                alt="Placeholder dokumen"
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
                                    Ditambahkan: {{ $kelahiran->created_at->format('d/m/Y') }}
                                </small>

                                <div class="action-buttons d-flex gap-2 flex-wrap">
                                    <a href="{{ route('kelahiran.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>

                                    @if (session('is_logged_in'))
                                        <a href="{{ route('kelahiran.edit', $kelahiran->kelahiran_id) }}"
                                            class="btn btn-edit btn-sm">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>

                                        <form action="{{ route('kelahiran.destroy', $kelahiran->kelahiran_id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Hapus data kelahiran ini beserta dokumennya?')">
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
    </div>
@endsection
