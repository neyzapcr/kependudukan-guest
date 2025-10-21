<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Keluarga - Sistem Kependudukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .card { border-radius: 15px; padding: 20px; }
        .remove-btn { cursor: pointer; color: red; }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">Tambah Data Keluarga</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('keluarga.store') }}" method="POST">
        @csrf
        <div class="card mb-4">
            <h5>Data Kartu Keluarga</h5>
            <div class="mb-3">
                <label>Nomor KK</label>
                <input type="text" name="kk_nomor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kepala Keluarga</label>
                <input type="text" name="kepala_keluarga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No. KTP Kepala</label>
                <input type="text" name="kepala_no_ktp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="kepala_jenis_kelamin" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Agama</label>
                <input type="text" name="kepala_agama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="kepala_pekerjaan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Telp</label>
                <input type="text" name="kepala_telp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="kepala_email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label>RT</label>
                    <input type="text" name="rt" class="form-control" required>
                </div>
                <div class="col">
                    <label>RW</label>
                    <input type="text" name="rw" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <h5>Anggota Keluarga</h5>
            <div id="anggota-wrapper">
                <div class="anggota mb-3 row">
                    <div class="col-md-4">
                        <input type="text" name="anggota[0][nama]" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="anggota[0][hubungan]" class="form-control" placeholder="Hubungan" required>
                    </div>
                    <div class="col-md-2">
                        <span class="remove-btn" onclick="removeAnggota(this)">❌</span>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="tambahAnggota()">Tambah Anggota</button>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Keluarga</button>
        <a href="{{ route('keluarga.index') }}" class="btn btn-light">Kembali</a>
    </form>
</div>

<script>
function tambahAnggota() {
    const wrapper = document.getElementById('anggota-wrapper');
    const index = wrapper.children.length;
    const div = document.createElement('div');
    div.classList.add('anggota', 'mb-3', 'row');
    div.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="anggota[${index}][nama]" class="form-control" placeholder="Nama" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="anggota[${index}][hubungan]" class="form-control" placeholder="Hubungan" required>
        </div>
        <div class="col-md-2">
            <span class="remove-btn" onclick="removeAnggota(this)">❌</span>
        </div>
    `;
    wrapper.appendChild(div);
}

function removeAnggota(el) {
    el.closest('.anggota').remove();
}
</script>
</body>
</html>
