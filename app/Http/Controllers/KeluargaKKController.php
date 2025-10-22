<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;

class KeluargaKKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data KK dari session
        $keluarga = Keluarga::with('kepalaKeluarga', 'anggotaKeluarga')->get();
        return view('guest.keluarga.index', compact('keluarga'));
    }
    /**
     * Tampilkan form tambah KK
     */ 
    public function create()
    {
        return view('guest.keluarga.create'); // form tambah KK + anggota
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kk_nomor'             => 'required|string|max:20',
            'kepala_keluarga'      => 'required|string|max:100',
            'kepala_no_ktp'        => 'required|string|max:16',
            'kepala_jenis_kelamin' => 'required|in:L,P',
            'kepala_agama'         => 'required|string|max:20',
            'kepala_pekerjaan'     => 'nullable|string|max:50',
            'kepala_telp'          => 'nullable|string|max:15',
            'kepala_email'         => 'nullable|email',
            'alamat'               => 'required|string',
            'rt'                   => 'required|string|max:3',
            'rw'                   => 'required|string|max:3',
            'anggota.*.nama'       => 'required|string|max:100',
            'anggota.*.hubungan'   => 'required|string|max:50',
        ]);

        // 1. Simpan kepala keluarga ke tabel warga
        $kepala = Warga::create([
            'nama'          => $request->kepala_keluarga,
            'no_ktp'        => $request->kepala_no_ktp,
            'jenis_kelamin' => $request->kepala_jenis_kelamin,
            'agama'         => $request->kepala_agama,
            'pekerjaan'     => $request->kepala_pekerjaan,
            'telp'          => $request->kepala_telp,
            'email'         => $request->kepala_email,
            'alamat'        => $request->alamat,
        ]);

        // 2. Simpan KK
        $kk = Keluarga::create([
            'kk_nomor'                 => $request->kk_nomor,
            'kepala_keluarga_warga_id' => $kepala->warga_id,
            'alamat'                   => $request->alamat,
            'rt'                       => $request->rt,
            'rw'                       => $request->rw,
        ]);

        // 3. Simpan kepala ke tabel anggota_keluarga
        AnggotaKeluarga::create([
            'kk_id'    => $kk->kk_id,
            'warga_id' => $kepala->warga_id,
            'hubungan' => 'Kepala Keluarga',
        ]);

        // 4. Simpan anggota lain
        if ($request->anggota) {
            foreach ($request->anggota as $anggota) {
                $w = Warga::create([
                    'nama'          => $anggota['nama'],
                    'no_ktp'        => $anggota['no_ktp'] ?? substr ('UNIQ' . uniqid(), 0, 16),
                    'jenis_kelamin' => $anggota['jenis_kelamin'] ?? 'L',
                    'agama'         => $anggota['agama'] ?? 'Islam',
                    'pekerjaan'     => $anggota['pekerjaan'] ?? 'Tidak Bekerja',
                    'telp'          => $anggota['telp'] ?? '-',
                    'email'         => $anggota['email'] ?? '-',
                    'alamat'        => $request->alamat,
                ]);

                AnggotaKeluarga::create([
                    'kk_id'    => $kk->kk_id,
                    'warga_id' => $w->warga_id,
                    'hubungan' => $anggota['hubungan'],
                ]);
            }
        }

        return redirect()->route('keluarga.index')->with('success', 'KK dan anggota berhasil ditambahkan!');
    }

    public function showAnggota($kk_id)
    {
        $kk = Keluarga::with('anggotaKeluarga')->findOrFail($kk_id);

        return view('guest.keluarga.anggota', compact('kk'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
