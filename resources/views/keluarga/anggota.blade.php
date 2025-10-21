<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Anggota Keluarga - {{ $kk->kk_nomor }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2>Anggota Keluarga KK: {{ $kk->kk_nomor }}</h2>

        <!-- Popup sukses -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('keluarga.index') }}" class="btn btn-secondary mb-3">Kembali</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama</th>
                    <th>No. KTP</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Hubungan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kk->anggotaKeluarga as $anggota)
                    <tr>
                        <td>{{ $anggota->warga_id }}</td>
                        <td>{{ $anggota->warga->nama }}</td>
                        <td>{{ $anggota->warga->no_ktp }}</td>
                        <td>{{ $anggota->warga->jenis_kelamin }}</td>
                        <td>{{ $anggota->warga->agama }}</td>
                        <td>{{ $anggota->warga->pekerjaan }}</td>
                        <td>{{ $anggota->warga->telp }}</td>
                        <td>{{ $anggota->warga->email }}</td>
                        <td>{{ $anggota->hubungan }}</td>
                        <td>
                            <a href="{{ route('keluarga.anggota.edit', ['id' => $kk->kk_id, 'anggota_id' => $anggota->warga_id]) }}"
                                class="btn btn-sm btn-warning">Edit</a>

                            <form
                                action="{{ route('keluarga.anggota.destroy', ['id' => $kk->kk_id, 'anggota_id' => $anggota->warga_id]) }}"
                                method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus anggota ini?')">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada anggota</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
