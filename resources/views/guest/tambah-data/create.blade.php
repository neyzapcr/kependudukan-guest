<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - Sistem Kependudukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
        }
        .option-card {
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px dashed #dee2e6;
        }
        .option-card:hover {
            background-color: #fff;
            border-color: #0b57a8;
            transform: scale(1.05);
        }
        .option-card h3 {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">Tambah Data Baru</h2>
    <div class="row g-4 justify-content-center mt-4">
    <div class="col-md-3">
        <a href="{{ route('keluarga.create') }}" class="text-decoration-none text-dark">
            <div class="option-card">
                <i class="fas fa-home fa-3x text-primary"></i>
                <h3>Tambah Keluarga</h3>
                <small>Input data keluarga baru</small>
            </div>
        </a>
    </div>
    {{-- <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <a href="{{ route('kelahiran.create') }}" class="text-decoration-none text-dark">
                <div class="option-card">
                    <i class="fas fa-baby fa-3x text-success"></i>
                    <h3>Kelahiran</h3>
                    <small>Lapor kelahiran bayi baru</small>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('kematian.create') }}" class="text-decoration-none text-dark">
                <div class="option-card">
                    <i class="fas fa-cross fa-3x text-dark"></i>
                    <h3>Kematian</h3>
                    <small>Lapor kematian penduduk</small>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('pindah.create') }}" class="text-decoration-none text-dark">
                <div class="option-card">
                    <i class="fas fa-walking fa-3x text-warning"></i>
                    <h3>Pindah</h3>
                    <small>Lapor perpindahan penduduk</small>
                </div>
            </a>
        </div>
    </div>
</div> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
