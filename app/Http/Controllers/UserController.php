<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
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

            // role & status OPTIONAL
            'role'      => 'nullable|in:super-admin,administrator,admin,petugas,warga',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required'      => 'Nama lengkap harus diisi',
            'email.required'     => 'Email harus diisi',
            'email.email'        => 'Format email tidak valid',
            'email.unique'       => 'Email sudah terdaftar',
            'password.required'  => 'Password harus diisi',
            'password.min'       => 'Password minimal 3 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.regex'     => 'Password harus mengandung huruf kapital',

            'role.in'            => 'Role tidak valid',
            'is_active.boolean'  => 'Status tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            // kalau role gak dikirim, default = warga
            'role'      => $request->role ?? 'warga',

            // kalau status gak dikirim, default aktif
            'is_active' => $request->is_active ?? 1,
        ]);

        // Auto login setelah registrasi
        Auth::login($user);

        // Set session
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
        if (! session('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'      => 'required|in:super-admin,administrator,admin,petugas,warga',
            'is_active' => 'required|boolean',
        ], [
            'name.required'      => 'Nama lengkap harus diisi',
            'email.required'     => 'Email harus diisi',
            'email.email'        => 'Format email tidak valid',
            'email.unique'       => 'Email sudah terdaftar',
            'role.required'      => 'Role harus dipilih',
            'role.in'            => 'Role tidak valid',
            'is_active.required' => 'Status harus dipilih',
            'is_active.boolean'  => 'Status tidak valid',
        ]);

        if ($request->filled('password')) {
            $passwordValidator = Validator::make($request->all(), [
                'password' => 'string|min:3|confirmed|regex:/[A-Z]/',
            ], [
                'password.min'       => 'Password minimal 3 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'password.regex'     => 'Password harus mengandung huruf kapital',
            ]);

            if ($passwordValidator->fails()) {
                return redirect()->back()
                    ->withErrors($passwordValidator)
                    ->withInput();
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->role      = $request->role;
        $user->is_active = $request->is_active;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')
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
    $user = Auth::user(); // user yang lagi login

    $validator = Validator::make($request->all(), [
        'name'  => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
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

    // update hanya profil dasar
    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // role & status TIDAK DIUBAH di sini
    $user->save();

    return redirect()->route('user.profile.edit')
        ->with('success', 'Profil berhasil diperbarui.');
}
}
