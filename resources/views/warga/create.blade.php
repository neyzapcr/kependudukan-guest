<form method="POST" action="{{ route('warga.store') }}">
    @csrf

    <div class="mb-3">
        <label>No. KTP</label>
        <input type="text" name="no_ktp" class="form-control" maxlength="16" required>
    </div>

    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Agama</label>
        <input type="text" name="agama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>No. Telp</label>
        <input type="text" name="telp" class="form-control" maxlength="15" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
</form>
