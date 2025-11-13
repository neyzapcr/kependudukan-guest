<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $warga = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('pages.warga.index', compact('warga'));
    }

    public function create()
    {
        // Cek apakah user sudah login
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu untuk menambah data warga.'
            ]);
        }

        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        // Cek apakah user sudah login
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu untuk menyimpan data warga.'
            ]);
        }

        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|size:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'required|string|max:15',
            'email' => 'nullable|email',
            'alamat' => 'nullable|string',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil disimpan!');
    }

    public function edit(Warga $warga)
    {
        // Cek apakah user sudah login
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu untuk mengedit data warga.'
            ]);
        }

        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        // Cek apakah user sudah login
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu untuk mengupdate data warga.'
            ]);
        }

        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id|size:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'required|string|max:15',
            'email' => 'nullable|email',
            'alamat' => 'nullable|string',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy(Warga $warga)
    {
        // Cek apakah user sudah login
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu untuk menghapus data warga.'
            ]);
        }

        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
