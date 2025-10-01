<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluargaKKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = [
            'kk_id'   => '001',
            'kk_nomor' => '1234',
            'kepala_keluarga_warga_id' => '012',
            'alamat' => 'Jalan Umban Sari',
            'rt'     => '012',
            'rw'     => '010'
        ];

        return view('keluarga', $data);
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
