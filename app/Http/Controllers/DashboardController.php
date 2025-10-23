<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunSekarang = now()->year;

        // Total warga
        $totalWarga = Warga::count();

        // Kelahiran, kematian, pindah (dummy untuk sementara)
        $kelahiranTahunIni = Warga::whereYear('created_at', $tahunSekarang)->count();
        $kematianTahunIni = 0;
        $pindahTahunIni = 0;

        // Grafik kelahiran per bulan (berdasarkan data warga baru)
        $grafikKelahiran = Warga::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', $tahunSekarang)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Pastikan semua bulan ada walau 0
        $grafikLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $grafikLengkap[$i] = $grafikKelahiran[$i] ?? 0;
        }

        // Grafik gender (ambil langsung dari warga)
        $grafikGender = [
            'L' => Warga::where('jenis_kelamin', 'L')->count(),
            'P' => Warga::where('jenis_kelamin', 'P')->count(),
        ];

        // Grafik pertumbuhan penduduk (5 tahun terakhir)
        $grafikPertumbuhan = [];
        for ($i = $tahunSekarang - 4; $i <= $tahunSekarang; $i++) {
            $grafikPertumbuhan[$i] = Warga::whereYear('created_at', '<=', $i)->count();
        }

        // Data terbaru (5 warga terakhir)
        $laporanTerbaru = Warga::latest()->take(5)->get();

        // Sebaran per dusun (kalau ada kolom 'dusun')
        // $sebaranDusun = Warga::select('dusun', DB::raw('COUNT(*) as jumlah'))
        //     ->groupBy('dusun')
        //     ->get()
        //     ->map(fn($item) => [
        //         'wilayah' => $item->dusun ?? 'Tidak diketahui',
        //         'jumlah' => $item->jumlah
        //     ]);
            $sebaranDusun = collect();

        // Pengumuman dummy
        $pengumuman = [
            'Pendataan ulang warga dimulai minggu depan.',
            'Perbarui data keluarga sebelum akhir bulan.'
        ];

        return view('dashboard', compact(
            'totalWarga',
            'kelahiranTahunIni',
            'kematianTahunIni',
            'pindahTahunIni',
            'laporanTerbaru',
            'sebaranDusun',
            'pengumuman',
            'grafikLengkap',
            'grafikGender',
            'grafikPertumbuhan'
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
