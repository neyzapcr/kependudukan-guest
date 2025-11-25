<?php
namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;

class KeluargaKKController extends Controller
{
    /**
     * Tampilkan daftar KK
     */
    public function index(Request $request)
{
    $search  = $request->search;
    $filters = $request->only(['rt','rw','anggota_range']);
    $sort    = $request->sort;

    $sortBy = null;
    $sortOrder = null;

    if ($sort) {
        $parts = explode('_', $sort);
        $sortOrder = array_pop($parts);
        $sortBy = implode('_', $parts);
    }

    $kk = Keluarga::with('kepalaKeluarga','anggotaKeluarga')
            ->searchAndFilter($search, $filters)
            ->sort($sortBy, $sortOrder)   // sorting tetap boleh dipakai opsional
            ->paginate(6)
            ->withQueryString();

    return view('pages.keluarga.index', compact('kk', 'search'));
}



    /**
     * Tampilkan form create KK
     */
    public function create()
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambah data KK.');
        }

        $warga = Warga::all();
        return view('pages.keluarga.create', compact('warga'));
    }

    /**
     * Simpan KK baru
     */
    // Di KeluargaKKController - store method
    public function store(Request $request)
{
    // Check jika belum login
    if (!session('is_logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $validated = $request->validate([
        'kk_nomor'                 => 'required|string|max:30|unique:keluarga_kk,kk_nomor',
        'kepala_keluarga_warga_id' => 'required|exists:warga,warga_id',
        'alamat'                   => 'required|string',
        'rt'                       => 'required|string|max:3',
        'rw'                       => 'required|string|max:3',
        'anggota'                  => 'sometimes|array',
        'anggota.*.warga_id'       => 'required_with:anggota|exists:warga,warga_id',
        'anggota.*.hubungan'       => 'required_with:anggota|string|max:50',
    ]);

     try {
        // 1. Simpan data keluarga
        $keluarga = Keluarga::create($validated);

        // 2. Otomatis tambah kepala keluarga sebagai anggota pertama
        AnggotaKeluarga::create([
            'kk_id' => $keluarga->kk_id,
            'warga_id' => $validated['kepala_keluarga_warga_id'],
            'hubungan' => 'Kepala Keluarga',
        ]);

        // 3. Tambah anggota lainnya jika ada (input manual)
        if ($request->has('anggota')) {
            foreach ($request->anggota as $anggotaData) {
                // Skip jika warga_id kosong
                if (empty($anggotaData['warga_id'])) {
                    continue;
                }

                // Cek agar tidak duplikat dengan kepala keluarga
                if ($anggotaData['warga_id'] != $validated['kepala_keluarga_warga_id']) {
                    AnggotaKeluarga::create([
                        'kk_id' => $keluarga->kk_id,
                        'warga_id' => $anggotaData['warga_id'],
                        'hubungan' => $anggotaData['hubungan'],
                    ]);
                }
            }
        }

        $message = 'Data KK berhasil ditambahkan!';
        if ($request->has('anggota')) {
            $anggotaCount = count(array_filter($request->anggota, function($a) {
                return !empty($a['warga_id']);
            }));
            if ($anggotaCount > 0) {
                $message .= " $anggotaCount anggota berhasil ditambahkan.";
            }
        }

        return redirect()->route('keluarga.index')->with('success', $message);

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}

    /**
     * Tampilkan form edit KK
     */
    public function edit($kk_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengedit data KK.');
        }

        $keluarga = Keluarga::findOrFail($kk_id);
        $warga    = Warga::all();
        return view('pages.keluarga.edit', compact('keluarga', 'warga'));
    }

    /**
     * Update data KK
     */
    public function update(Request $request, $kk_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keluarga = Keluarga::findOrFail($kk_id);

        $validated = $request->validate([
            'kk_nomor'                 => 'required|string|max:30|unique:keluarga_kk,kk_nomor,' . $keluarga->kk_id . ',kk_id',
            'kepala_keluarga_warga_id' => 'required|exists:warga,warga_id',
            'alamat'                   => 'required|string',
            'rt'                       => 'required|string|max:3',
            'rw'                       => 'required|string|max:3',
        ]);

        $keluarga->update($validated);

        return redirect()->route('keluarga.index')->with('success', 'Data KK berhasil diperbarui!');
    }

    /**
     * Hapus KK
     */
    public function destroy($kk_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keluarga = Keluarga::findOrFail($kk_id);
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data KK berhasil dihapus!');
    }
}
