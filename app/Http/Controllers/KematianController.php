<?php
namespace App\Http\Controllers;

use App\Models\Kematian;
use App\Models\Media;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kematian = Kematian::with(['warga'])
            ->search($request->search)
            ->filter($request->only(['lokasi', 'tahun', 'bulan']))
            ->orderBy('tgl_meninggal', 'desc')
            ->paginate(10);

        // ambil satu media tiap record
        foreach ($kematian as $item) {
            $item->media = Media::where('ref_table', 'peristiwa_kematian')
                ->where('ref_id', $item->kematian_id)
                ->first();
        }

        return view('pages.kematian.index', compact('kematian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::orderBy('nama')->get();

        return view('pages.kematian.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'           => 'required|exists:warga,warga_id',
            'tgl_meninggal'      => 'required|date',
            'sebab'              => 'required|string|max:100',
            'lokasi'             => 'required|string|max:100',
            'no_surat'           => 'nullable|string|max:50',
            // Media (opsional)
            'dokumen_kematian'   => 'nullable|array',
            'dokumen_kematian.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
        ]);

        try {
            // Simpan data kematian
            $kematian = Kematian::create([
                'warga_id'      => $request->warga_id,
                'tgl_meninggal' => $request->tgl_meninggal,
                'sebab'         => $request->sebab,
                'lokasi'        => $request->lokasi,
                'no_surat'      => $request->no_surat,
            ]);

            // Handle upload dokumen kematian ke tabel media (jika ada)
            if ($request->hasFile('dokumen_kematian')) {
                $files = $request->file('dokumen_kematian');

                if (! is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    $fileName = 'kematian_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan ke storage/app/public/uploads/dokumen
                    $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'peristiwa_kematian',
                        'ref_id'     => $kematian->kematian_id,
                        'file_name'  => $fileName,
                        'caption'    => 'Dokumen Kematian - ' . ($kematian->no_surat ?? $kematian->kematian_id),
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => 1,
                    ]);
                }
            }

            return redirect()->route('kematian.index')
                ->with('success', 'Data kematian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kematian $kematian)
    {
        $media = Media::where('ref_table', 'peristiwa_kematian')
            ->where('ref_id', $kematian->kematian_id)
            ->get();

        $kematian->load(['warga']);

        return view('pages.kematian.show', compact('kematian', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kematian $kematian)
    {
        $media = Media::where('ref_table', 'peristiwa_kematian')
            ->where('ref_id', $kematian->kematian_id)
            ->get();

        $warga = Warga::orderBy('nama')->get();

        return view('pages.kematian.edit', compact('kematian', 'warga', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kematian $kematian)
    {
        $request->validate([
            'warga_id'           => 'required|exists:warga,warga_id',
            'tgl_meninggal'      => 'required|date',
            'sebab'              => 'required|string|max:100',
            'lokasi'             => 'required|string|max:100',
            'no_surat'           => 'nullable|string|max:50',
            'dokumen_kematian'   => 'nullable|array',
            'dokumen_kematian.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
        ]);

        try {
            // Update data kematian
            $kematian->update([
                'warga_id'      => $request->warga_id,
                'tgl_meninggal' => $request->tgl_meninggal,
                'sebab'         => $request->sebab,
                'lokasi'        => $request->lokasi,
                'no_surat'      => $request->no_surat,
            ]);

            // Upload dokumen kematian baru (boleh lebih dari satu)
            if ($request->hasFile('dokumen_kematian')) {
                $files = $request->file('dokumen_kematian');

                if (! is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    $fileName = 'kematian_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'peristiwa_kematian',
                        'ref_id'     => $kematian->kematian_id,
                        'file_name'  => $fileName,
                        'caption'    => 'Dokumen Kematian - ' . ($kematian->no_surat ?? $kematian->kematian_id),
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => 1,
                    ]);
                }
            }

            return redirect()->route('kematian.index')
                ->with('success', 'Data kematian berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kematian $kematian)
    {
        try {
            $mediaList = Media::where('ref_table', 'peristiwa_kematian')
                ->where('ref_id', $kematian->kematian_id)
                ->get();

            foreach ($mediaList as $media) {
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);
                $media->delete();
            }

            $kematian->delete();

            return redirect()->route('kematian.index')
                ->with('success', 'Data kematian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus dokumen/foto kematian saja (tidak hapus data kematian).
     */
    public function hapusFoto($id)
    {
        try {
            // Cari media berdasarkan media_id
            $media = Media::where('ref_table', 'peristiwa_kematian')
                ->where('media_id', $id)
                ->first();

            if ($media) {
                // Hapus file fisik
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);

                // Hapus row di tabel media
                $media->delete();

                return redirect()->back()
                    ->with('success', 'Dokumen / foto kematian berhasil dihapus.');
            }

            return redirect()->back()
                ->with('error', 'Dokumen / foto kematian tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Preview / tampilkan file di browser.
     */
    public function previewFile($id)
    {
        $media = Media::where('media_id', $id)
            ->where('ref_table', 'peristiwa_kematian')
            ->firstOrFail();

        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File tidak ditemukan');
    }

    /**
     * Download file.
     */
    public function downloadFile($id)
    {
        $media = Media::where('media_id', $id)
            ->where('ref_table', 'peristiwa_kematian')
            ->firstOrFail();

        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath, $media->file_name);
        }

        abort(404, 'File tidak ditemukan');
    }
}
