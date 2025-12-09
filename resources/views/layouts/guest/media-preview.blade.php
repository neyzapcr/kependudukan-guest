{{-- GLOBAL MEDIA PREVIEW MODAL --}}
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen</h5>
                <button type="button"
                        class="btn-close btn-close-preview"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Gambar --}}
                <img id="previewImage" class="img-fluid d-none" alt="Preview dokumen">

                {{-- PDF --}}
                <iframe id="previewPdf"
                        class="w-100 d-none"
                        style="height:60vh;"
                        frameborder="0"></iframe>

                {{-- Unsupported --}}
                <div id="previewUnsupported" class="text-muted d-none">
                    Tidak dapat menampilkan preview untuk tipe file ini. Silakan unduh dokumennya.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewModalEl = document.getElementById('previewModal');
    if (!previewModalEl) return;

    const img = document.getElementById('previewImage');
    const pdf = document.getElementById('previewPdf');
    const unsupported = document.getElementById('previewUnsupported');

    let modalInstance = null;
    if (window.bootstrap && bootstrap.Modal) {
        modalInstance = new bootstrap.Modal(previewModalEl);
    }

    function resetPreview() {
        img.classList.add('d-none');
        pdf.classList.add('d-none');
        unsupported.classList.add('d-none');
        img.src = '';
        pdf.src = '';
    }

    // Klik apa pun yang punya class .preview-file
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.preview-file');
        if (!link) return;

        e.preventDefault();

        const url  = link.dataset.url;
        const type = link.dataset.type || 'other';

        resetPreview();

        if (type === 'image') {
            img.src = url;
            img.classList.remove('d-none');
        } else if (type === 'pdf') {
            pdf.src = url;
            pdf.classList.remove('d-none');
        } else {
            unsupported.classList.remove('d-none');
        }

        if (modalInstance) {
            modalInstance.show();
        } else {
            // fallback kalau bootstrap JS belum ke-load
            previewModalEl.classList.add('show');
            previewModalEl.style.display = 'block';
            previewModalEl.removeAttribute('aria-hidden');
            document.body.classList.add('modal-open');
        }
    });

    // Tombol X
    const closeBtn = previewModalEl.querySelector('.btn-close-preview');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            if (modalInstance) {
                modalInstance.hide();
            } else {
                previewModalEl.classList.remove('show');
                previewModalEl.style.display = 'none';
                previewModalEl.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('modal-open');
            }
            resetPreview();
        });
    }

    // Klik area gelap di luar kotak modal → tutup
    previewModalEl.addEventListener('click', function (e) {
        const dialog = previewModalEl.querySelector('.modal-dialog');
        if (!dialog) return;

        if (!dialog.contains(e.target)) {
            if (modalInstance) {
                modalInstance.hide();
            } else {
                previewModalEl.classList.remove('show');
                previewModalEl.style.display = 'none';
                previewModalEl.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('modal-open');
            }
            resetPreview();
        }
    });

    // Kalau pakai Bootstrap: bersihin saat modal ditutup
    previewModalEl.addEventListener('hidden.bs.modal', function () {
        resetPreview();
    });
});
</script>
