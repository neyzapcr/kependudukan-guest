<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Edit Anggota Keluarga</h2>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guest.keluarga.anggota.update', [$kk->kk_id, $anggota->warga_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $anggota->warga->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_ktp" class="form-label">No. KTP</label>
            <input type="text" name="no_ktp" id="no_ktp" class="form-control" value="{{ old('no_ktp', $anggota->warga->no_ktp) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="L" {{ $anggota->warga->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $anggota->warga->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" name="agama" id="agama" class="form-control" value="{{ old('agama', $anggota->warga->agama) }}" required>
        </div>

        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ old('pekerjaan', $anggota->warga->pekerjaan) }}">
        </div>

        <div class="mb-3">
            <label for="telp" class="form-label">Telepon</label>
            <input type="text" name="telp" id="telp" class="form-control" value="{{ old('telp', $anggota->warga->telp) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $anggota->warga->email) }}">
        </div>

        <div class="mb-3">
            <label for="hubungan" class="form-label">Hubungan</label>
            <input type="text" name="hubungan" id="hubungan" class="form-control" value="{{ old('hubungan', $anggota->hubungan) }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('guest.keluarga.anggota', $kk->kk_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
