<?php
namespace App\Http\Controllers;

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
        $search = $request->input('search');

        $query = Keluarga::with('kepalaKeluarga', 'anggotaKeluarga');

        // Jika ada pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kk_nomor', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('rt', 'like', "%{$search}%")
                  ->orWhere('rw', 'like', "%{$search}%")
                  ->orWhereHas('kepalaKeluarga', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $kk = $query->get();

        return view('guest.keluarga.index', compact('kk', 'search'));
    }

    /**
     * Tampilkan form create KK
     */
    public function create()
    {
        // Check jika belum login
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambah data KK.');
        }

        $warga = Warga::all();
        return view('guest.keluarga.create', compact('warga'));
    }

    /**
     * Simpan KK baru
     */
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
        ]);

        Keluarga::create($validated);

        return redirect()->route('keluarga.index')->with('success', 'Data KK berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit KK
     */
    public function edit($kk_id)
    {
        // Check jika belum login
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengedit data KK.');
        }

        $keluarga = Keluarga::findOrFail($kk_id);
        $warga    = Warga::all();
        return view('guest.keluarga.edit', compact('keluarga', 'warga'));
    }

    /**
     * Update data KK
     */
    public function update(Request $request, $kk_id)
    {
        // Check jika belum login
        if (!session('is_logged_in')) {
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
        if (!session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $keluarga = Keluarga::findOrFail($kk_id);
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data KK berhasil dihapus!');
    }
}
