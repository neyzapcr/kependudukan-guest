<?php
namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;

class AnggotaKeluargaController extends Controller
{
    public function index(Request $request, $kk_id)
    {
        $kk = Keluarga::findOrFail($kk_id);

        $search  = $request->search;
        $filters = $request->only(['hubungan', 'jenis_kelamin', 'agama', 'pekerjaan']);

        $anggota = AnggotaKeluarga::with('warga')
            ->where('kk_id', $kk_id)
            ->searchAndFilter($search, $filters)
            ->paginate(6)
            ->withQueryString();

        $hasIstri = $kk->hasIstri();
        $hasSuami = $kk->hasSuami();

        return view('pages.anggota.index', compact('kk', 'anggota', 'hasIstri', 'hasSuami'));
    }

    public function create($kk_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambah anggota keluarga.');
        }

        $kk = Keluarga::findOrFail($kk_id);

        // Hanya tampilkan warga yang BELUM menjadi anggota di keluarga ini
        $warga = Warga::whereNotIn('warga_id', function ($query) use ($kk_id) {
            $query->select('warga_id')
                ->from('anggota_keluarga')
                ->where('kk_id', $kk_id);
        })->get();

        return view('pages.anggota.create', compact('kk', 'warga'));
    }

    // Di AnggotaKeluargaController - store method
    public function store(Request $request, $kk_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'warga_id' => 'required|exists:warga,warga_id',
            'hubungan' => 'required|string|max:50',
        ]);

        // Cek apakah warga sudah menjadi anggota di keluarga ini
        $existing = AnggotaKeluarga::where('kk_id', $kk_id)
            ->where('warga_id', $request->warga_id)
            ->exists();

        if ($existing) {
            return back()->with('error', 'Warga ini sudah menjadi anggota keluarga!');
        }

        AnggotaKeluarga::create([
            'kk_id'    => $kk_id,
            'warga_id' => $request->warga_id,
            'hubungan' => $request->hubungan,
        ]);

        return redirect()->route('anggota.index', $kk_id)
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit($anggota_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengedit anggota keluarga.');
        }

        $anggota = AnggotaKeluarga::with(['warga', 'keluarga'])->findOrFail($anggota_id);
        $kk      = $anggota->keluarga;
        $warga   = Warga::all();

        return view('pages.anggota.edit', compact('kk', 'anggota', 'warga'));
    }

    public function update(Request $request, $anggota_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'hubungan' => 'required|string|max:50',
        ]);

        $anggota = AnggotaKeluarga::with('warga')->findOrFail($anggota_id);

        $anggota->update([
            'hubungan' => $request->hubungan,
        ]);

        return redirect()->route('anggota.index', $anggota->kk_id)
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($anggota_id)
    {
        // Check jika belum login
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            $anggota          = AnggotaKeluarga::with(['warga', 'keluarga'])->findOrFail($anggota_id);
            $isKepalaKeluarga = $anggota->hubungan == 'Kepala Keluarga';
            $namaAnggota      = $anggota->warga->nama ?? 'Anggota';
            $kk_id            = $anggota->kk_id;

            if ($isKepalaKeluarga) {
                $keluarga = $anggota->keluarga;

                $keluarga->anggotaKeluarga()->delete();

                $keluarga->delete();

                return redirect()->route('keluarga.index')
                    ->with('success', "Keluarga $namaAnggota dan semua anggota berhasil dihapus!");
            } else {
                $anggota->delete();

                return redirect()->route('anggota.index', $kk_id)
                    ->with('success', "Data anggota $namaAnggota berhasil dihapus.");
            }

        } catch (\Exception $e) {
            return redirect()->route('anggota.index', $anggota->kk_id ?? $kk_id)
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
