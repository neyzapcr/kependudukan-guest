<!-- resources/views/keluarga/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Daftar Keluarga</h2>

    <!-- Popup sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('keluarga.create') }}" class="btn btn-primary mb-3">Tambah Keluarga</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID KK</th>
                <th>No. KK</th>
                <th>Kepala Keluarga</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>RW</th>
                <th>Anggota</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keluarga as $kk)
                <tr>
                    <td>{{ $kk->kk_id }}</td>
                    <td>{{ $kk->kk_nomor }}</td>
                    <td>{{ $kk->kepalaKeluarga->nama ?? '-' }}</td>
                    <td>{{ $kk->alamat }}</td>
                    <td>{{ $kk->rt }}</td>
                    <td>{{ $kk->rw }}</td>
                    <td>
                        {{-- @foreach($kk->anggotaKeluarga as $anggota)
                            {{ $anggota->nama }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $kk->created_at }}</td>
                </tr>
            @empty --}}
            <a href="{{ route('guest.keluarga.anggota', $kk->kk_id) }}" class="btn btn-sm btn-info">
                            Lihat Anggota
                        </a>
                    </td>
                    <td>{{ $kk->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data keluarga</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
