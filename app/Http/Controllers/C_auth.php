<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // pastikan model User di-import

class C_auth extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'kepala_sekolah' => redirect()->route('kepala.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                default => abort(403, 'Unauthorized'),
            };
        }

        return view('auth.v_login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Ambil user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Cek jika user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Cek jika status user tidak aktif
        if ($user->status !== 'aktif') {
            return back()->with('error', 'Akun Anda tidak aktif. Silakan hubungi admin.');
        }

        // Lanjutkan proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
             // ✅ Tambahkan flash session di sini
        \Log::info('Login Success Session Set');
        $request->session()->flash('loginSuccess', true);

            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'kepala_sekolah' => redirect()->route('kepala.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                default => abort(403, 'Unauthorized'),
            };
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
