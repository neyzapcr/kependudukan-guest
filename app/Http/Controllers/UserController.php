<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the userss.
     */
    public function index(Request $request)
{
    if (! session('is_logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // ambil variabel pencarian
    $search = $request->search;

    // ambil filter status
    $filters = [
        'status' => $request->status,
        'role'   => $request->role,
    ];

    // handle sorting
    $sort      = $request->sort;
    $sortBy    = null;
    $sortOrder = null;

    if ($sort) {
        $parts     = explode('_', $sort);
        $sortOrder = array_pop($parts);
        $sortBy    = implode('_', $parts);
    }

    $allowedSortBy = ['created_at', 'name', 'email'];
    $allowedOrder  = ['asc', 'desc'];

    if (! in_array($sortBy, $allowedSortBy) || ! in_array($sortOrder, $allowedOrder)) {
        $sortBy    = null;
        $sortOrder = null;
    }

    // 🔥 gunakan scopeSearchAndFilter + sort
    $users = User::searchAndFilter($search, $filters)
        ->sort($sortBy, $sortOrder)
        ->paginate(9)
        ->withQueryString();

    return view('pages.user.index', compact('users'));
}

    /**
     * Show the form for creating a new user (Registration Form).
     */
    public function create()
    {
        return view('pages.auth.register-form');
    }

    /**
     * Store a newly created user in storage (Handle Registration).
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'      => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:users',
        'password'  => 'required|string|min:3|confirmed|regex:/[A-Z]/',
        'role'      => 'nullable|in:super-admin,administrator,admin,petugas,warga',
        'is_active' => 'nullable|boolean',

        // foto profil (optional)
        'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ], [
        // ... pesan error kamu boleh tetap
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = [
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'role'      => $request->role ?? 'warga',
        'is_active' => $request->is_active ?? 1,
    ];

    if ($request->hasFile('photo_profile')) {
        $path = $request->file('photo_profile')->store('user-photos', 'public');
        $data['photo_profile'] = $path;
    }

    $user = User::create($data);

    Auth::login($user);
    session(['is_logged_in' => true, 'username' => $user->name, 'email' => $user->email]);

    return redirect()->route('pages.dashboard.index')->with([
        'success'  => 'Registrasi berhasil! Selamat datang.',
        'username' => $user->name,
    ]);
}


    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
{
    if (!session('is_logged_in')) {
        return redirect()->route('login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }

    /**
     * =====================================================
     * VALIDASI DASAR (SEMUA USER)
     * =====================================================
     */
    $validator = Validator::make($request->all(), [
        'name'  => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ], [
        'name.required'  => 'Nama lengkap harus diisi',
        'email.required' => 'Email harus diisi',
        'email.email'    => 'Format email tidak valid',
        'email.unique'   => 'Email sudah terdaftar',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    /**
     * =====================================================
     * VALIDASI PASSWORD (JIKA DIISI)
     * =====================================================
     */
    if ($request->filled('password')) {
        $passwordValidator = Validator::make($request->all(), [
            'password' => 'string|min:3|confirmed|regex:/[A-Z]/',
        ], [
            'password.min'       => 'Password minimal 3 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.regex'     => 'Password harus mengandung huruf kapital',
        ]);

        if ($passwordValidator->fails()) {
            return back()->withErrors($passwordValidator)->withInput();
        }
    }

    /**
     * =====================================================
     * VALIDASI KHUSUS SUPER-ADMIN
     * =====================================================
     */
    if (auth()->user()->role === 'super-admin') {
        $adminValidator = Validator::make($request->all(), [
            'role'      => 'required|in:super-admin,administrator,admin,petugas,warga',
            'is_active' => 'required|boolean',
        ], [
            'role.required'      => 'Role harus dipilih',
            'role.in'            => 'Role tidak valid',
            'is_active.required' => 'Status harus dipilih',
            'is_active.boolean'  => 'Status tidak valid',
        ]);

        if ($adminValidator->fails()) {
            return back()->withErrors($adminValidator)->withInput();
        }
    }

    /**
     * =====================================================
     * UPDATE DATA USER
     * =====================================================
     */
    $user->name  = $request->name;
    $user->email = $request->email;

    // hanya super-admin boleh ubah role & status
    if (auth()->user()->role === 'super-admin') {
        $user->role      = $request->role;
        $user->is_active = $request->is_active;
    }

    // update password jika diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    /**
     * =====================================================
     * UPLOAD FOTO PROFIL
     * =====================================================
     */
    if ($request->hasFile('photo_profile')) {
        if ($user->photo_profile) {
            Storage::disk('public')->delete($user->photo_profile);
        }

        $path = $request->file('photo_profile')
            ->store('user-photos', 'public');

        $user->photo_profile = $path;
    }

    $user->save();

    return redirect()
        ->route('user.index')
        ->with('success', 'Data user berhasil diperbarui.');
}


    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('user.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function editProfile()
{
    $user = Auth::user(); // ambil user yang lagi login
    return view('pages.user.edit', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
        'name'  => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        // ✅ TAMBAHKAN VALIDASI FOTO
        'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->filled('password')) {
        $passwordValidator = Validator::make($request->all(), [
            'password' => 'string|min:3|confirmed|regex:/[A-Z]/',
        ]);

        if ($passwordValidator->fails()) {
            return back()->withErrors($passwordValidator)->withInput();
        }
    }

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // update data dasar
    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // ✅ LOGIC UPLOAD FOTO (INI YANG KURANG)
    if ($request->hasFile('photo_profile')) {
        // hapus foto lama
        if ($user->photo_profile) {
            Storage::disk('public')->delete($user->photo_profile);
        }

        $path = $request->file('photo_profile')
            ->store('user-photos', 'public');

        $user->photo_profile = $path;
    }

    $user->save();

    return redirect()
        ->route('user.profile.edit')
        ->with('success', 'Profil berhasil diperbarui.');
}

public function deletePhoto(User $user)
{
    if ($user->photo_profile) {
        Storage::disk('public')->delete($user->photo_profile);
        $user->photo_profile = null;
        $user->save();
    }

    return back()->with('success', 'Foto profil berhasil dihapus.');
}

public function deleteOwnPhoto()
{
    $user = Auth::user();

    if ($user->photo_profile) {
        Storage::disk('public')->delete($user->photo_profile);
        $user->photo_profile = null;
        $user->save();
    }

    return back()->with('success', 'Foto profil berhasil dihapus.');
}

}
