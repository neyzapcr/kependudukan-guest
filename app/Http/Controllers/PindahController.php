<?php

namespace App\Http\Controllers;

use App\Models\Pindah;
use App\Models\Media;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pindah = Pindah::with(['warga'])
            ->search($request->search)
            ->filter($request->only(['alamat_tujuan', 'tahun', 'bulan']))
            ->orderBy('tgl_pindah', 'desc')
            ->paginate(10);

        foreach ($pindah as $item) {
            $item->media = Media::where('ref_table', 'peristiwa_pindah')
                ->where('ref_id', $item->pindah_id)
                ->first();
        }

        return view('pages.pindah.index', compact('pindah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::orderBy('nama')->get();

        return view('pages.pindah.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'        => 'required|exists:warga,warga_id',
            'tgl_pindah'      => 'required|date',
            'alamat_tujuan'   => 'required|string',
            'alasan'          => 'required|string|max:100',
            'no_surat'        => 'nullable|string|max:50',

            // Media (opsional)
            'dokumen_pindah'   => 'nullable|array',
            'dokumen_pindah.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
        ]);

        try {
            // Simpan data pindah
            $pindah = Pindah::create([
                'warga_id'      => $request->warga_id,
                'tgl_pindah'    => $request->tgl_pindah,
                'alamat_tujuan' => $request->alamat_tujuan,
                'alasan'        => $request->alasan,
                'no_surat'      => $request->no_surat,
            ]);

            // Handle upload dokumen pindah ke tabel media (jika ada)
            if ($request->hasFile('dokumen_pindah')) {
                $files = $request->file('dokumen_pindah');

                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    $fileName = 'pindah_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan ke storage/app/public/uploads/dokumen
                    $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'peristiwa_pindah',
                        'ref_id'     => $pindah->pindah_id,
                        'file_name'  => $fileName,
                        'caption'    => 'Dokumen Pindah - ' . ($pindah->no_surat ?? $pindah->pindah_id),
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => 1,
                    ]);
                }
            }

            return redirect()->route('pindah.index')
                ->with('success', 'Data pindah berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pindah $pindah)
    {
        // Ambil semua media terkait pindah ini
        $media = Media::where('ref_table', 'peristiwa_pindah')
            ->where('ref_id', $pindah->pindah_id)
            ->get();

        $pindah->load(['warga']);

        return view('pages.pindah.show', compact('pindah', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pindah $pindah)
    {
        $media = Media::where('ref_table', 'peristiwa_pindah')
            ->where('ref_id', $pindah->pindah_id)
            ->get();

        $warga = Warga::orderBy('nama')->get();

        return view('pages.pindah.edit', compact('pindah', 'warga', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pindah $pindah)
    {
        $request->validate([
            'warga_id'        => 'required|exists:warga,warga_id',
            'tgl_pindah'      => 'required|date',
            'alamat_tujuan'   => 'required|string',
            'alasan'          => 'required|string|max:100',
            'no_surat'        => 'nullable|string|max:50',

            'dokumen_pindah'   => 'nullable|array',
            'dokumen_pindah.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
        ]);

        try {
            // Update data pindah
            $pindah->update([
                'warga_id'      => $request->warga_id,
                'tgl_pindah'    => $request->tgl_pindah,
                'alamat_tujuan' => $request->alamat_tujuan,
                'alasan'        => $request->alasan,
                'no_surat'      => $request->no_surat,
            ]);

            // Upload dokumen pindah baru (boleh lebih dari satu)
            if ($request->hasFile('dokumen_pindah')) {
                $files = $request->file('dokumen_pindah');

                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    $fileName = 'pindah_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'peristiwa_pindah',
                        'ref_id'     => $pindah->pindah_id,
                        'file_name'  => $fileName,
                        'caption'    => 'Dokumen Pindah - ' . ($pindah->no_surat ?? $pindah->pindah_id),
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => 1,
                    ]);
                }
            }

            return redirect()->route('pindah.index')
                ->with('success', 'Data pindah berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pindah $pindah)
    {
        try {
            $mediaList = Media::where('ref_table', 'peristiwa_pindah')
                ->where('ref_id', $pindah->pindah_id)
                ->get();

            foreach ($mediaList as $media) {
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);
                $media->delete();
            }

            $pindah->delete();

            return redirect()->route('pindah.index')
                ->with('success', 'Data pindah berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus dokumen / file pindah saja (tidak hapus data pindah).
     */
    public function hapusFoto($id)
    {
        try {
            // Cari media berdasarkan media_id
            $media = Media::where('ref_table', 'peristiwa_pindah')
                ->where('media_id', $id)
                ->first();

            if ($media) {
                // Hapus file fisik
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);

                // Hapus row di tabel media
                $media->delete();

                return redirect()->back()
                    ->with('success', 'Dokumen / file pindah berhasil dihapus.');
            }

            return redirect()->back()
                ->with('error', 'Dokumen / file pindah tidak ditemukan.');
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
            ->where('ref_table', 'peristiwa_pindah')
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
            ->where('ref_table', 'peristiwa_pindah')
            ->firstOrFail();

        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath, $media->file_name);
        }

        abort(404, 'File tidak ditemukan');
    }
}
