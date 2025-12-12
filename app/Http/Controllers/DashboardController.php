<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Kelahiran;
use App\Models\Kematian;
use App\Models\Pindah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = now()->year;

        // ===============================
        // 1. TOTAL WARGA & GENDER
        // ===============================
        $totalWarga       = Warga::count();
        $jumlahLaki       = Warga::where('jenis_kelamin', 'L')->count();
        $jumlahPerempuan  = Warga::where('jenis_kelamin', 'P')->count();

        // ===============================
        // 2. PERISTIWA TAHUN INI
        // ===============================
        $kelahiranTahunIni = Kelahiran::whereYear('tgl_lahir', $tahun)->count();
        $kematianTahunIni  = Kematian::whereYear('tgl_meninggal', $tahun)->count();
        $pindahTahunIni    = Pindah::whereYear('tgl_pindah', $tahun)->count();

        // 3. GRAFIK KELAHIRAN PER BULAN
        // ===============================
        $kelahiranPerBulan = Kelahiran::select(
                DB::raw('MONTH(tgl_lahir) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tgl_lahir', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Fix bulan kosong
        $grafikKelahiran = [];
        for ($i = 1; $i <= 12; $i++) {
            $grafikKelahiran[$i] = $kelahiranPerBulan[$i] ?? 0;
        }

        // ===============================
        // 4. GRAFIK GENDER
        // ===============================
        $grafikGender = [
            'Laki-laki'  => $jumlahLaki,
            'Perempuan'  => $jumlahPerempuan,
        ];

        // ===============================
        // 5. TREN DATA 5 TAHUN
        // ===============================
        $tahunGrafik      = [];
        $grafikPenduduk   = [];
        $grafikLahir      = [];
        $grafikMati       = [];
        $grafikPindah     = [];

        for ($i = $tahun - 4; $i <= $tahun; $i++) {

            $tahunGrafik[]    = $i;
            $grafikPenduduk[] = Warga::whereYear('created_at', '<=', $i)->count();
            $grafikLahir[]    = Kelahiran::whereYear('tgl_lahir', $i)->count();
            $grafikMati[]     = Kematian::whereYear('tgl_meninggal', $i)->count();
            $grafikPindah[]   = Pindah::whereYear('tgl_pindah', $i)->count();
        }

        // ===============================
        // 6. PENGUMUMAN
        // ===============================
        $pengumuman = [
            "Pendataan ulang warga akan dimulai minggu depan.",
            "Pastikan data keluarga telah diperbarui sebelum akhir bulan.",
        ];

        return view("pages.dashboard", compact(
            "totalWarga",
            "jumlahLaki",
            "jumlahPerempuan",
            "kelahiranTahunIni",
            "kematianTahunIni",
            "pindahTahunIni",
            "grafikKelahiran",
            "grafikGender",
            "tahunGrafik",
            "grafikPenduduk",
            "grafikLahir",
            "grafikMati",
            "grafikPindah",
            "pengumuman"
        ));
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
