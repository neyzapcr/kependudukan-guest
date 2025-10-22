<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;

class AnggotaKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($keluargaId, $anggotaId)
    {
        $kk      = Keluarga::findOrFail($keluargaId);
        $anggota = AnggotaKeluarga::with('warga')->where('warga_id', $anggotaId)->firstOrFail();
        return view('guest.keluarga.edit_anggota', compact('kk', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $anggota_id)
    {
        // Validasi input
        $request->validate([
            'nama'          => 'required|string|max:100',
            'no_ktp'        => 'required|string|max:20',
            'jenis_kelamin' => 'required|string|max:1',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
            'hubungan'      => 'required|string|max:50',
        ]);

        // Ambil data anggota + relasi warga
        $anggota = AnggotaKeluarga::with('warga')
            ->where('kk_id', $id)
            ->where('warga_id', $anggota_id)
            ->firstOrFail();

        // Update data di tabel warga
        $anggota->warga->update([
            'nama'          => $request->nama,
            'no_ktp'        => $request->no_ktp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'pekerjaan'     => $request->pekerjaan,
            'telp'          => $request->telp,
            'email'         => $request->email,
        ]);

        // Update hubungan di tabel anggota_keluarga
        $anggota->update([
            'hubungan' => $request->hubungan,
        ]);

        // Redirect balik ke daftar anggota
        return redirect()->route('guest.keluarga.anggota', $id)
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kk_id, $warga_id)
    {
        // Cari data anggota berdasarkan ID KK dan ID Warga
        $anggota = AnggotaKeluarga::where('kk_id', $kk_id)
            ->where('warga_id', $warga_id)
            ->first();

        if (! $anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // Hapus juga data warga kalau kamu mau
        $anggota->warga()->delete();

        // Hapus data anggota dari tabel pivot/relasi
        $anggota->delete();

        return redirect()->route('guest.keluarga.anggota', $kk_id)
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}
