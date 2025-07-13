<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\MasterUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // dd($user);
        return view(
            'profil.indexProfile',
            compact('user')
        );
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
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
        $user = auth()->user();

        if ($user->regist_by_google === 2) {
            $request->validate([
                'password_baru' => 'required|string|min:8|confirmed',
            ], [
                'password_baru.required' => 'Tidak boleh kosong',
                'password_baru.min' => 'Masih kurang',
            ]);
        } else {
            $request->validate([
                'password_lama' => 'required',
                'password_baru' => 'required|string|min:8|confirmed',
            ], [
                'password_lama.required' => 'Password lama tidak boleh kosong',
                'password_baru.required' => 'Password baru tidak boleh kosong',
                'password_baru.min' => 'Masih kurang karakter',
            ]);
            
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->with('error', 'Password lama tidak sesuai');
            }
        }



        $user->update([
            'password' => Hash::make($request->password_baru),
            'regist_by_google' => 1
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
