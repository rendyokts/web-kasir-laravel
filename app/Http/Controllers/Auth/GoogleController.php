<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user(); //Gunakan stateless()->user() hanya untuk API atau situasi khusus dimana session tidak tersedia atau tidak diperlukan.

            $find_user = User::where('email', $user->email)->first();

            if ($find_user) {

                if ($find_user->status != 1) {
                    return redirect()->route('login')->withErrors(['Akun Anda belum di aktifkan oleh admin. Silahkan hubungi admin']);
                }
                Auth::login($find_user);
            } else {
                $new_user = [
                    'name'            => $user->name,
                    'username'        => explode('@', $user->email)[0],
                    'email'           => $user->email,
                    'email_verified_at' => now(),
                    'telp'            => '',
                    'google_id'       => $user->id,
                    'password'        => Hash::make('my-google'),
                    'status'          => 2,
                    'regist_by_google' => 2,
                ];
                User::create($new_user);
                // Auth::login($new_user);
                return redirect()->route('login')->with('info', 'Akun anda telah dibuat. Silahkan tunggu persetujuan admin');
            }
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['Terjadi kesalahan saat login dengan Google. Silahkan coba lagi.']);
        }
    }
}
