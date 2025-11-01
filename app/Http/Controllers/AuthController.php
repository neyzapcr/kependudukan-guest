<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display login form
     */
    public function index()
    {
        return view('guest.auth.login-form');
    }

    /**
     * Show the form for creating a new resource (register form)
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource (handle register)
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => ['required', 'min:3', 'regex:/[A-Z]/'],
    ]);

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Check password
    if ($user && Hash::check($request->password, $user->password)) {
        \Log::info('=== LOGIN SUCCESS ===');
        \Log::info('User: ' . $user->email);

        // **PERBAIKAN: Gunakan Auth::login() untuk session Laravel**
        Auth::login($user);

        // **OPTIONAL: Tambahkan session manual jika masih perlu**
        session([
            'is_logged_in' => true,
            'username' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id
        ]);

        \Log::info('Session after login:', session()->all());
        \Log::info('Auth check: ' . (Auth::check() ? 'true' : 'false'));
        \Log::info('Auth user: ' . (Auth::user() ? Auth::user()->name : 'null'));

        // Test redirect langsung
        \Log::info('Redirecting to: ' . route('guest.dashboard.index'));

        return redirect()->route('guest.dashboard.index')->with([
            'success' => 'Login berhasil! Selamat datang ' . $user->name,
            'username' => $user->name
        ]);
    }

    // Login failed
    return redirect('/login')->withErrors([
        'email' => 'Email atau password tidak sesuai.',
    ])->withInput($request->only('email'));
}

    /**
     * Handle logout request
     */
    public function logout(Request $request)
{
    \Log::info('=== LOGOUT PROCESS ===');
    \Log::info('Before logout - Auth check: ' . (Auth::check() ? 'true' : 'false'));

    // Logout dari Auth
    Auth::logout();

    // Hapus session manual
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    \Log::info('After logout - Auth check: ' . (Auth::check() ? 'true' : 'false'));

    return redirect('/login')->with('success', 'Logout berhasil!');
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

    /**
     * Handle logout request
     */
}
