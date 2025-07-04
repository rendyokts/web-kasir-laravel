<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.indexProfile', [
            'user' => auth()->user()
        ]);
    }

    public function edit()
    {
        return view('profil.editProfile', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'telepon' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['name', 'email', 'telepon']));
        
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function showChangePasswordForm()
    {
        return view('profil.passwordProfile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::delete($user->foto_profil);
            }
            
            $path = $request->file('foto_profil')->store('profil');
            $user->update(['foto_profil' => $path]);
        }

        return back()->with('success', 'Foto profil berhasil diupload');
    }
}