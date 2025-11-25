<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        // Gunakan scope dari model untuk search dan filter
        $warga = Warga::searchAndFilter($request->search, $request->only(['jenis_kelamin', 'agama', 'pekerjaan']))
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('pages.warga.index', compact('warga'));
    }

    // METHOD LAINNYA TETAP SAMA, TIDAK DIUBAH
    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp|size:16',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|string|max:20',
            'pekerjaan'     => 'required|string|max:50',
            'telp'          => 'required|string|max:15',
            'email'         => 'nullable|email',
            'alamat'        => 'nullable|string',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil disimpan!');
    }

    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id|size:16',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|string|max:20',
            'pekerjaan'     => 'required|string|max:50',
            'telp'          => 'required|string|max:15',
            'email'         => 'nullable|email',
            'alamat'        => 'nullable|string',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy(Warga $warga)
    {
        try {
            $warga->delete();
            return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('warga.index')
                    ->with('error', 'Data warga tidak dapat dihapus karena masih digunakan sebagai kepala keluarga!');
            }

            return redirect()->route('warga.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data warga.');
        }
    }
}
