<?php

namespace App\Http\Controllers;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\Kelahiran;
use App\Models\Kematian;
use App\Models\Pindah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalWarga = 0;
        $kelahiranTahunIni = 0;
        $kematianTahunIni = 0;
        $pindahTahunIni = 0;

        // Data list kosong (biar nggak error di foreach)
        $laporanTerbaru = [];
        $sebaranDusun = [];
        $pengumuman = [];

        // Data dummy kosong buat grafik
        $grafikKelahiran = [];
        $grafikGender = ['L' => 0, 'P' => 0];
        $grafikPertumbuhan = [];

        // kirim semuanya ke view
        return view('dashboard', compact(
            'totalWarga',
            'kelahiranTahunIni',
            'kematianTahunIni',
            'pindahTahunIni',
            'laporanTerbaru',
            'sebaranDusun',
            'pengumuman',
            'grafikKelahiran',
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
