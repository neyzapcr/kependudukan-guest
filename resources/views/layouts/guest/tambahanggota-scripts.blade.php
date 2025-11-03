{{-- resources/views/layouts/guest/tambahscript.blade.php --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('anggota-container');
        const tambahBtn = document.getElementById('tambah-anggota-btn');

        if (!container || !tambahBtn) return;

        let anggotaCount = 0;

        tambahBtn.addEventListener('click', function() {
            anggotaCount++;

            const anggotaDiv = document.createElement('div');
            anggotaDiv.className = 'anggota-field mb-3 p-3 border rounded';
            anggotaDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Pilih Anggota Keluarga</label>
                    <select name="anggota[${anggotaCount}][warga_id]" class="form-control search-box" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}">{{ $w->nama }} (NIK: {{ $w->no_ktp }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hubungan Keluarga</label>
                    <select name="anggota[${anggotaCount}][hubungan]" class="form-control search-box" required>
                        <option value="">-- Pilih Hubungan --</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Menantu">Menantu</option>
                        <option value="Cucu">Cucu</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Mertua">Mertua</option>
                        <option value="Famili Lain">Famili Lain</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger btn-sm hapus-anggota">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

            container.appendChild(anggotaDiv);

            anggotaDiv.querySelector('.hapus-anggota').addEventListener('click', function() {
                anggotaDiv.remove();
            });
        });
    });
</script>
