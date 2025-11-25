<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
{
    if (!session('is_logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $search = $request->search;

    $sort = $request->sort;
    $sortBy = null;
    $sortOrder = null;

    if ($sort) {
        $parts = explode('_', $sort);
        $sortOrder = array_pop($parts);   // ambil paling belakang: asc/desc
        $sortBy = implode('_', $parts);   // sisanya jadi field (created_at)
    }

    // optional guard biar aman
    $allowedSortBy = ['created_at', 'name', 'email'];
    $allowedOrder  = ['asc', 'desc'];

    if (!in_array($sortBy, $allowedSortBy) || !in_array($sortOrder, $allowedOrder)) {
        $sortBy = null;
        $sortOrder = null;
    }

    $users = User::searchAndFilter($search)
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed|regex:/[A-Z]/',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 3 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'password.regex' => 'Password harus mengandung huruf kapital',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login setelah registrasi
        Auth::login($user);

        // Set session
        session(['is_logged_in' => true, 'username' => $user->name, 'email' => $user->email]);

        return redirect()->route('pages.dashboard.index')->with([
            'success' => 'Registrasi berhasil! Selamat datang.',
            'username' => $user->name
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
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($request->filled('password')) {
            $passwordValidator = Validator::make($request->all(), [
                'password' => 'string|min:3|confirmed|regex:/[A-Z]/',
            ], [
                'password.min' => 'Password minimal 3 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'password.regex' => 'Password harus mengandung huruf kapital',
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

        $user->name = $request->name;
        $user->email = $request->email;

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
}
