<?php
// app/Http/Controllers/KelahiranController.php

namespace App\Http\Controllers;

use App\Models\Kelahiran;
use App\Models\Media;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelahiran = Kelahiran::with(['warga', 'ayah', 'ibu'])
            ->search($request->search)
            ->filter($request->only(['tempat_lahir', 'tahun', 'bulan']))
            ->orderBy('tgl_lahir', 'desc')
            ->paginate(10);

        foreach ($kelahiran as $item) {
            $item->media = Media::where('ref_table', 'peristiwa_kelahiran')
                ->where('ref_id', $item->kelahiran_id)
                ->first();
        }

        return view('pages.kelahiran.index', compact('kelahiran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $warga = Warga::whereNotIn('warga_id', function ($query) {
            $query->select('warga_id')->from('peristiwa_kelahiran');
        })->get();

        $ayah = Warga::where('jenis_kelamin', 'L')->get();

        $ibu = Warga::where('jenis_kelamin', 'P')->get();

        return view('pages.kelahiran.create', compact('warga', 'ayah', 'ibu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'      => 'required|exists:warga,warga_id',
            'tgl_lahir'     => 'required|date',
            'tempat_lahir'  => 'required|string|max:100',
            'ayah_warga_id' => 'required|exists:warga,warga_id',
            'ibu_warga_id'  => 'required|exists:warga,warga_id',
            'no_akta'       => 'required|unique:peristiwa_kelahiran,no_akta',
            'foto_akta'     => 'nullable|array',
            'foto_akta.*'   => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',
        ]);

        try {
            // Create data kelahiran
            $kelahiran = Kelahiran::create([
                'warga_id'      => $request->warga_id,
                'tgl_lahir'     => $request->tgl_lahir,
                'tempat_lahir'  => $request->tempat_lahir,
                'ayah_warga_id' => $request->ayah_warga_id,
                'ibu_warga_id'  => $request->ibu_warga_id,
                'no_akta'       => $request->no_akta,
            ]);

            // Handle upload foto akta ke tabel media (jika ada)
            if ($request->hasFile('foto_akta')) {
                $files = $request->file('foto_akta');
                if (! is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    $fileName = 'akta_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'peristiwa_kelahiran',
                        'ref_id'     => $kelahiran->kelahiran_id,
                        'file_name'  => $fileName,
                        'caption'    => 'Akta Kelahiran - ' . $kelahiran->no_akta,
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => 1,
                    ]);
                }
            }
            return redirect()->route('kelahiran.index')
                ->with('success', 'Data kelahiran berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelahiran $kelahiran)
    {
        // Ambil semua media terkait kelahiran ini
        $media = Media::where('ref_table', 'peristiwa_kelahiran')
            ->where('ref_id', $kelahiran->kelahiran_id)
            ->get();

        $kelahiran->load(['warga', 'ayah', 'ibu']);

        return view('pages.kelahiran.show', compact('kelahiran', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelahiran $kelahiran)
    {
        // Ambil SEMUA media terkait kelahiran ini
        $media = Media::where('ref_table', 'peristiwa_kelahiran')
            ->where('ref_id', $kelahiran->kelahiran_id)
            ->get();

        // Data dropdown
        $warga = Warga::all();
        // Ambil old value jika exist, kalau tidak pakai value dari database
        $selectedAyah = old('ayah_warga_id', $kelahiran->ayah_warga_id);
        $selectedIbu  = old('ibu_warga_id', $kelahiran->ibu_warga_id);

// Ambil daftar ayah & ibu (tetap laki/perempuan)
        $ayah = Warga::where('jenis_kelamin', 'L')->get();
        $ibu  = Warga::where('jenis_kelamin', 'P')->get();

// Kirim juga selected ke blade
        return view('pages.kelahiran.edit', compact('kelahiran', 'warga', 'ayah', 'ibu', 'media', 'selectedAyah', 'selectedIbu'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelahiran $kelahiran)
    {
        $request->validate([
            'tgl_lahir'     => 'required|date',
            'tempat_lahir'  => 'required|string|max:100',
            'ayah_warga_id' => 'required|exists:warga,warga_id',
            'ibu_warga_id'  => 'required|exists:warga,warga_id',
            'no_akta'       => 'required|unique:peristiwa_kelahiran,no_akta,' . $kelahiran->kelahiran_id . ',kelahiran_id',
            'foto_akta'     => 'nullable|array',
            'foto_akta.*'   => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:5120',

        ]);

        try {
            // Update data kelahiran
            $kelahiran->update([
                'tgl_lahir'     => $request->tgl_lahir,
                'tempat_lahir'  => $request->tempat_lahir,
                'ayah_warga_id' => $request->ayah_warga_id,
                'ibu_warga_id'  => $request->ibu_warga_id,
                'no_akta'       => $request->no_akta,
            ]);

            // Handle upload foto akta baru (boleh lebih dari satu)
            if ($request->hasFile('foto_akta')) {
                foreach ($request->file('foto_akta') as $file) {
                    $fileName = 'akta_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('uploads/dokumen', $fileName, 'public');

                    Media::create([
                        'ref_table'     => 'peristiwa_kelahiran',
                        'ref_id'        => $kelahiran->kelahiran_id,
                        'file_name'     => $fileName,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type'     => $file->getMimeType(),
                        'sort_order'    => 1,
                    ]);
                }
            }

            return redirect()->route('kelahiran.index')
                ->with('success', 'Data kelahiran berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelahiran $kelahiran)
    {
        try {
            // Hapus file media terkait (jika ada)
            $media = Media::where('ref_table', 'peristiwa_kelahiran')
                ->where('ref_id', $kelahiran->kelahiran_id)
                ->first();

            if ($media) {
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);
                $media->delete();
            }

            // Hapus data kelahiran
            $kelahiran->delete();

            return redirect()->route('kelahiran.index')
                ->with('success', 'Data kelahiran berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus foto akta saja (tidak hapus data kelahiran)
     */
    public function hapusFoto($id)
    {
        try {
            // Cari media berdasarkan media_id
            $media = Media::where('ref_table', 'peristiwa_kelahiran')
                ->where('media_id', $id)
                ->first();

            if ($media) {
                // Hapus file fisik
                Storage::disk('public')->delete('uploads/dokumen/' . $media->file_name);

                // Hapus row di tabel media
                $media->delete();

                return redirect()->back()
                    ->with('success', 'Dokumen / foto akta berhasil dihapus.');
            }

            return redirect()->back()
                ->with('error', 'Dokumen / foto akta tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Preview/Download file
     */
    public function previewFile($id)
    {
        $media = Media::where('media_id', $id)
            ->where('ref_table', 'peristiwa_kelahiran')
            ->firstOrFail();

        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, 'File tidak ditemukan');
    }

    /**
     * Download file
     */
    public function downloadFile($id)
    {
        $media = Media::where('media_id', $id)
            ->where('ref_table', 'peristiwa_kelahiran')
            ->firstOrFail();

        $filePath = storage_path('app/public/uploads/dokumen/' . $media->file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath, $media->file_name);
        }

        abort(404, 'File tidak ditemukan');
    }
}
