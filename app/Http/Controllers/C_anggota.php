<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class C_anggota extends Controller
{
    public function index()
    {
        $anggota = User::get();
        return view('admin.v_anggota', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nis' => 'nullable',
            'kelas' => 'nullable',
            'kontak' => 'nullable',
            'status' => 'required|in:aktif,nonaktif', // ✅ Validasi status
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nis' => $request->nis,
            'kelas' => $request->kelas, 
            'kontak' => $request->kontak,
            'status' => $request->status ?? 'aktif', // ✅ Simpan status (default 'aktif' jika tidak ada)
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$anggota->id,
            'nis' => 'nullable',
            'kelas' => 'nullable',
            'kontak' => 'nullable',
            'status' => 'required|in:aktif,nonaktif', // ✅ Validasi status
        ]);

        $anggota->update([
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'kontak' => $request->kontak,
             'status' => $request->status ?? 'aktif', // ✅ Simpan status (default 'aktif' jika tidak ada)
        ]);

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus.');
    }
}